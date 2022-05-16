<?php
    session_start();
    require_once '../../admin/config.php';
    require_once '../../incfiles/functions.php';
    require_once '../../lib/PHPMailer/class.phpmailer.php';
    require_once '../../lib/PHPMailer/class.smtp.php';
    $status     = 'error';
    $error      = array();
    $username   = validField($_POST['username']);
    $captcha    = $_POST['captcha'];
    $password   = $_POST['password'];
    if(preg_match("#\W#", $_POST['username'])){
        $error['username'] = 'Tên đăng nhập không được chứa kí tự đặc biệt';
    } else if(!checkLength($_POST['username'], 5, 255)){
        $error['username'] = 'Tên đăng nhập phải lớn hơn 5 kí tự';
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->prepare($sql);
            $result->execute();
            if($result->rowCount() == 0){
                $error['username'] = 'Tên đăng nhập không tồn tại';
        }
    }
    $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRETKEY."&response={$captcha}");
    $captcha_success=json_decode($verify);
    if (!$captcha_success->success) {
        $error['recaptcha'] = 'Lỗi xác thực captcha, vui lòng thử lại';
    }
    if(count($error) == 0){
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->prepare($sql);
        $result->execute();
        $user = $result->fetch();
        if(!password_verify($password, $user['password'])){
            $error['password'] = 'Mật khẩu không chính xác';
        } else if($user['active'] == 0){
            $error['active'] = 'Tài khoản chưa được kích hoạt';
        } else {
            if(isset($_POST['loginpage']) && $_POST['loginpage'] == 'admin'){
                if($user['permission'] != 2){
                    $error['username'] = 'Bạn không có quyền truy cập vào trang quản trị';
                }
            }
        }
        if(count($error) == 0){
            $status = 'success';
            $_SESSION['user']               = array();
            $_SESSION['user']['login']      = true;
            $_SESSION['user']['id']         = $user['user_id'];
            $_SESSION['user']['fullname']   = $user['fullname'];
            $_SESSION['user']['username']   = $user['username'];
            $_SESSION['user']['permission'] = $user['permission'];
            $_SESSION['user']['avatar']     = $user['avatar'];
            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                foreach($_SESSION['cart'] as $productID => $cart){
                    $userID = $user['user_id'];
                    $quantity = $cart['quantity'];
                    $price = $cart['productprice'];
                    if(issetRecordQuery("SELECT * FROM cart WHERE user_id = $userID AND product_id = $productID")){
                        queryExecute("UPDATE cart SET cart_quantity = cart_quantity + $quantity WHERE user_id = $userID AND product_id = $productID");
                    } else {
                        queryExecute("INSERT INTO cart VALUES(null, $userID, $productID, $quantity, $price)");
                    }
                }
                unset($_SESSION['cart']);
            }
            if($_POST['remember'] == 'yes'){
                setcookie('username', $username, time() + 86400, "/");
                setcookie('password', $password, time() + 86400, "/");
                setcookie('remember', true, time() + 86400, "/");
            } else {
                setcookie('username', "", time()-360, "/");
                setcookie('password', "", time()-360, "/");
                setcookie('remember', "", time()-360, "/");
            }
        }
    }
    $data = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>