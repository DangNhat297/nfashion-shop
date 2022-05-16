<?php
    require_once '../../admin/config.php';
    require_once '../../incfiles/functions.php';
    require_once '../../lib/PHPMailer/class.phpmailer.php';
    require_once '../../lib/PHPMailer/class.smtp.php';
    $status     = 'error';
    $error      = array();
    $captcha    = $_POST['captcha'];
    $date       = new DateTime();
    $createAt   = $date->format("Y-m-d H:i:s");
    $verifyCode = randomStr();
    if(isset($_POST['action']) && $_POST['action'] == 'register'){
        $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRETKEY."&response={$captcha}");
        $captcha_success=json_decode($verify);
        if (!$captcha_success->success) {
            $error['recaptcha'] = 'Lỗi xác thực captcha, vui lòng thử lại';
        }
        if(trim($_POST['fullname']) == ''){
            $error['fullname'] = 'Họ và tên không được để trống';
        } else if(!checkLength(trim($_POST['fullname']), 11, 255)){
            $error['fullname'] = 'Họ và tên phải trên 10 kí tự';
        }
        if(trim($_POST['username']) == ''){
            $error['username'] = 'Tên đăng nhập không được để trống';
        } else if(!checkLength($_POST['username'], 5, 255)){
            $error['username'] = 'Tên đăng nhập phải lớn hơn 5 kí tự';
        } else if(preg_match("#\W#", $_POST['username'])){
            $error['username'] = 'Tên đăng nhập không được chứa kí tự đặc biệt';
        }
        if($_POST['password'] == ''){
            $error['password'] = 'Mật khẩu không được để trống';
        } else if(!preg_match("#(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z]{6,255}#", $_POST['password'])){
            $error['password'] = 'Mật khẩu chứa ít nhất 1 kí tự số, 1 chữ hoa, 1 chữ thường, từ 6 kí tự trở lên';
        }
        if($_POST['password'] != $_POST['confirm-password']){
            $error['confirm-password'] = 'Mật khẩu không chính xác, vui lòng thử lại';
        }
        if($_FILES['avatar']['size'] > 0){
            if(!checkExtension($_FILES['avatar']['name'])){
                $error['avatar'] = 'Định dạng file ảnh không chính xác';
            } else {
                $fileExtension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $fileName = randomStr().'-'.date("d-m-Y").'.'.$fileExtension;
            }
        } else {
            $fileName = 'default.png';
        }
        $fullname   = validField($_POST['fullname']);
        $username   = validField($_POST['username']);
        $password   = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $email      = validField($_POST['email']);
        $address    = validField($_POST['address']);
        $permission = validField($_POST['permission']);
        if($permission < 1 || $permission > 2){
            $error['permission'] = 'Loại thành viên không chính xác';
        }
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0){
            $error['username'] = 'Tên đăng nhập đã tồn tại';
        }
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0){
            $error['email'] = 'Email đã được đăng ký';
        }
        if(count($error) == 0){
            try{
                // start mailer 
                $mail = new PHPMailer();
                $mail->CharSet = "UTF-8";
                $message = file_get_contents('../../email_template/email.html');
                $message = str_replace('%fullname%',$fullname,$message);
                $message = str_replace('%urlverify%',DOMAIN."/kich-hoat/?username=$username&verifycode=".md5($verifyCode),$message);
                $mail->IsSMTP(); // set mailer to use SMTP
                $mail->Host = "smtp.gmail.com"; // specify main and backup server
                $mail->Port = 465; // set the port to use
                $mail->SMTPAuth = true; // turn on SMTP authentication
                $mail->SMTPSecure = 'ssl';
                $mail->Username = ""; // your SMTP username or your gmail username
                $mail->Password = ""; // your SMTP password or your gmail password
                $from   = "admin@nfashion.com"; // Reply to this email
                $to     = $email; // Recipients email ID
                $name="NFashion"; // Recipient's name
                $mail->From = $from;
                $mail->FromName = "NFashion"; // Name to indicate where the email came from when the recepient received
                $mail->AddAddress($to,$name);
                $mail->WordWrap = 50; // set word wrap
                $mail->IsHTML(true); // send as HTML
                $mail->Subject = "Xác nhận đăng ký tài khoản";
                $mail->MsgHTML($message);
                //$mail->SMTPDebug = 2;
                if(!$mail->Send())
                {
                    $error['send-email'] = 'Lỗi gửi mail đăng ký';
                }
                if(count($error) == 0){
                    if($_FILES['avatar']['size'] > 0){
                        move_uploaded_file($_FILES['avatar']['tmp_name'], '../../assets/img/avatar/'. $fileName);
                    }
                    $sql    = "INSERT INTO users VALUES (null, '$fullname', '$username', '$password', '$email', '$fileName', 0, '$address', $permission, '$verifyCode', '$createAt')";
                    $stmt   = $conn->prepare($sql);
                    $stmt->execute();
                }
            } catch(PDOException $e){
                $error['system'] = 'Không thể đăng ký, vui lòng thử lại sau';
            }
        }
        if(count($error) == 0) $status = 'success';
    }
    $data = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>