<?php
    session_start();
    require_once '../../../admin/config.php';
    require_once '../../../incfiles/functions.php';
    require_once '../../../lib/PHPMailer/class.phpmailer.php';
    require_once '../../../lib/PHPMailer/class.smtp.php';
    $status = 'error';
    $error  = array();
    if(isset($_POST['action']) && $_POST['action'] == 'update-current-user'){
        $fullname = validField($_POST['fullname']);
        if(strlen($fullname) < 5){
            $error['fullname'] = 'Họ và tên phải lớn hơn 5 kí tự';
        }
        $address = validField($_POST['address']);
        $userID = (int)$_POST['id'];
        if($_FILES['avatar']['size'] > 0){
            if(!checkExtension($_FILES['avatar']['name'])){
                $error['avatar'] = 'Định dạng file ảnh không chính xác';
            } else {
                $fileExtension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $fileName = randomStr().'-'.date("d-m-Y").'.'.$fileExtension;
            }
        }
        if(count($error) == 0){
            try{
                $sql = "UPDATE users SET fullname = '$fullname', address = '$address' WHERE user_id = $userID";
                $query = $conn->prepare($sql);
                $query->execute();
                if($_FILES['avatar']['size'] > 0){
                    try{
                        $sql = "UPDATE users SET avatar = '$fileName' WHERE user_id = $userID";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        move_uploaded_file($_FILES['avatar']['tmp_name'], '../../../assets/img/avatar/' . $fileName);
                    } catch (PDOException $e){
                        $error[] = $e->getMessage();
                    }
                }
            } catch (PDOException $e){
                $error[] = $e->getMessage();
            }
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_SESSION['user']) && isset($_POST['action']) && $_POST['action'] == 'change-password'){
        $id      = (int)$_POST['user'];
        $oldPass = $_POST['oldpass'];
        $newPass = $_POST['newpass'];
        $confirmPass = $_POST['confirmpass'];
        $user = getQueryValueRecord("SELECT * FROM users WHERE user_id = $id");
        $currentPass = $user['password'];
        if(!password_verify($oldPass, $currentPass)){
            $error['oldpass'] = 'Mật khẩu cũ không chính xác';
        } else {
            if(!preg_match("#(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z]{6,255}#", $newPass)){
                $error['newpass'] = 'Mật khẩu chứa ít nhất 1 kí tự số, 1 chữ hoa, 1 chữ thường, từ 6 kí tự trở lên';
            } else if($newPass != $confirmPass){
                $error['confirmpass'] = 'Xác nhận mật khẩu không đúng';
            }
        }
        if(count($error) == 0){
            $password   = password_hash($newPass, PASSWORD_BCRYPT);
            queryExecute("UPDATE users SET password = '$password' WHERE user_id = $id");
            $status = 'success';
        }
    }
    if(isset($_POST['action']) && $_POST['action'] == 'forgot-password'){
        $email = validField($_POST['email']);
        $issetAccount = issetRecordQuery("SELECT * FROM users WHERE email = '$email'");
        if(!$issetAccount){
            $error['email'] = 'Email không tồn tại, vui lòng kiểm tra lại';
        } else {
            $user = getQueryValueRecord("SELECT * FROM users WHERE email = '$email'");
            $fullname = $user['fullname'];
            $verifyCode = $user['verify_code'];
            $mail = new PHPMailer();
            $mail->CharSet = "UTF-8";
            $message = file_get_contents('../../../email_template/recovery.html');
            $message = str_replace('%fullname%',$fullname,$message);
            $message = str_replace('%urlverify%',DOMAIN."/khoi-phuc-mat-khau/?email=$email&code=".md5($verifyCode),$message);
            $mail->IsSMTP(); // set mailer to use SMTP
            $mail->Host = "smtp.gmail.com"; // specify main and backup server
            $mail->Port = 465; // set the port to use
            $mail->SMTPAuth = true; // turn on SMTP authentication
            $mail->SMTPSecure = 'ssl';
            $mail->Username = "vinhmatic5x@gmail.com"; // your SMTP username or your gmail username
            $mail->Password = "yyrlddnaqdoapaxh"; // your SMTP password or your gmail password
            $from   = "admin@nfashion.com"; // Reply to this email
            $to     = $email; // Recipients email ID
            $name="NFashion"; // Recipient's name
            $mail->From = $from;
            $mail->FromName = "NFashion"; // Name to indicate where the email came from when the recepient received
            $mail->AddAddress($to,$name);
            $mail->WordWrap = 50; // set word wrap
            $mail->IsHTML(true); // send as HTML
            $mail->Subject = "Khôi phục tài khoản NFashion";
            $mail->MsgHTML($message);
            //$mail->SMTPDebug = 2;
            if(!$mail->Send())
            {
                $error['send-email'] = 'Lỗi gửi mail đăng ký';
            }
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['action']) && $_POST['action'] == 'recovery-password'){
        $id      = (int)$_POST['user'];
        $newPass = $_POST['newpass'];
        $confirmPass = $_POST['confirmpass'];
        if(!preg_match("#(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z]{6,255}#", $newPass)){
            $error['newpass'] = 'Mật khẩu chứa ít nhất 1 kí tự số, 1 chữ hoa, 1 chữ thường, từ 6 kí tự trở lên';
        } else if($newPass != $confirmPass){
            $error['confirmpass'] = 'Xác nhận mật khẩu không đúng';
        }
        if(count($error) == 0){
            $password   = password_hash($newPass, PASSWORD_BCRYPT);
            $newCode = randomStr();
            queryExecute("UPDATE users SET password = '$password' WHERE user_id = $id");
            queryExecute("UPDATE users SET verify_code = '$newCode' WHERE user_id = $id");
            $status = 'success';
        }
    }
    $data = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>