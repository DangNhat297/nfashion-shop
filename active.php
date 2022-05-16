<?php
    require_once 'admin/config.php';
    require_once 'incfiles/functions.php';
    if(isset($_GET['username']) && isset($_GET['verifycode'])){
        $username = $_GET['username'];
        $verifyCode = $_GET['verifycode'];
        $sql = "SELECT * FROM users WHERE username = '$username' and active = 0";
        $query = $conn->prepare($sql);
        $query->execute();
        if($query->rowCount() > 0){
            $result = $query->fetch();
            if($verifyCode == md5($result['verify_code'])){
                $newCode = randomStr();
                $sql = "UPDATE users SET active = 1 WHERE username = '$username'";
                $query = $conn->prepare($sql);
                $query->execute();
                $sql = "UPDATE users SET verify_code = '$newCode' WHERE username = '$username'";
                $query = $conn->prepare($sql);
                $query->execute();
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kích Hoạt Tài Khoản</title>
    <link rel="icon" href="https://icon-library.com/images/letter-n-icon/letter-n-icon-15.jpg" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=DOMAIN?>/assets/css/main.css">
</head>
<body id="style-5">
        <div class="active-page">
            <img src="https://i.imgur.com/m4exqlz.png">
            <p>Đăng ký tài khoản thành công!</p>
            <p>Tự động chuyển về trang đăng nhập sau <span class="counttime">5</span> giây !</p>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        var i = 4;
       setInterval(function(){
           if(i == 0) window.location.href="<?=DOMAIN?>/dang-nhap/";
            $('.counttime').text(i);
            i--;     
       },1000); 
    </script>
</body>
</html>
<?php
    } else {
        header('Location: '.DOMAIN.'/404.php');
    }
    } else {
        header('Location: '.DOMAIN.'/404.php');
    }
    } else {
        header('Location: '.DOMAIN.'/404.php');
    }
?>