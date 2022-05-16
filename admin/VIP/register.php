<?php
    session_start();
    require_once '../config.php';
    if(isset($_SESSION['user'])){
        if($_SESSION['user']['permission'] == 2){
            header('Location: ../index.php');
        } else {
            header('Location: '.DOMAIN.'/trang-chu.html');
        }
    }
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NĐN | Đăng ký tài khoản</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/all.min.css" rel="stylesheet">
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        #message-success{
            display: none;
        }
    </style>
</head>
<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

            <h1 class="logo-name"><i class="fas fa-sign-in-alt"></i></h1>

            </div>
            <h3>Đăng ký tài khoản</h3>
            <p>ASSIGNMENT WEB2013 - NGUYỄN ĐĂNG NHẬT
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <div id="message-success" class="alert alert-success alert-dismissable">
                Đăng ký thành công ! Vui lòng kiểm tra email và xác minh tài khoản !<br>
                Tài khoản sẽ bị xóa sau 24h nếu không xác minh !
            </div>
            <form class="m-t" role="form" id="formSignup">
                <div class="form-group">
                    <input type="text" class="form-control" name="fullname" placeholder="Họ và tên" required>
                    <span class="form-text error fullname m-b-none"></span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" required>
                    <span class="form-text error username m-b-none"></span>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    <span class="form-text error email m-b-none"></span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="Địa chỉ" required>
                    <span class="form-text error address m-b-none"></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                    <span class="form-text error password m-b-none"></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm-password" placeholder="Nhập lại mật khẩu" required>
                    <span class="form-text error confirm-password m-b-none"></span>
                </div>
                <div class="form-group">
                    <select class="form-control m-b" name="permission">
                        <option value="2">Quản trị</option>
                    </select>
                    <span class="form-text error permission m-b-none"></span>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        <input id="logo" onchange="loadFile(event)" name="avatar" accept="image/*" type="file" class="custom-file-input">
                        <label for="logo" class="custom-file-label">Chọn file ảnh...</label>
                    </div> 
                    <span class="form-text error avatar m-b-none"></span>
                </div>
                <div class="form-group">
                    <img class="output-image" style="width: 150px;height:150px;object-fit:cover">
                </div>
                <span class="form-text error send-mail m-b-none"></span>
                <span class="form-text error system m-b-none"></span>
                <div class="g-recaptcha" data-sitekey="<?=SITEKEY?>"></div>
                <span class="form-text error recaptcha m-b-none"></span>
                <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Đăng ký</button>

                <p class="text-muted text-center"><small>Bạn đã có tài khoản?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login.php">Đăng nhập ngay</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/bootstrap.js"></script>
    
    <!-- iCheck -->
    <script src="../js/plugins/iCheck/icheck.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function loadFile(event){
                $('.output-image').show();
                $('.output-image').attr('src', URL.createObjectURL(event.target.files[0]));
        }
        $(document).ready(function(){
            $('.output-image').hide();
            $('#message-success').hide();
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
        });
        $('#formSignup').submit(function(e){
            $('span.error').each(function(index, value){
                $(value).text('');
            });
            e.preventDefault();
            var dataForm = new FormData(this);
            dataForm.append('action', 'register');
            dataForm.append('captcha', grecaptcha.getResponse())
            $.ajax({
                url         : '../../api/register/',
                type        : 'POST',
                dataType    : 'json',
                data        : dataForm,
                contentType : false,
                processData : false,
                beforeSend  : function(){
                    $('button[type="submit"]').html('<i class="fas fa-spinner fa-spin"></i> Đang đăng ký');
                },
                success     : function(data){
                    setTimeout(function(){
                        if(data.status == 'success'){
                            $('#formSignup').hide();
                            $('#message-success').slideDown("slow");
                        } else {
                            grecaptcha.reset()
                            $('button[type="submit"]').html('Đăng ký');
                            $.each(data.message, function(index, value){
                                $('span.error.' + index).html(value);
                            });
                        }
                    },1000);
                }
            });
        });
    </script>
</body>

</html>
