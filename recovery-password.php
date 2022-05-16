<?php
    require_once 'admin/config.php';
    require_once 'incfiles/functions.php';
    if(!empty($_GET['email']) && !empty($_GET['code'])){
        $email = validField($_GET['email']);
        $verifyCode = validField($_GET['code']);
        $issetAccount = issetRecordQuery("SELECT * FROM users WHERE email = '$email'");
        if($issetAccount){
            $user = getQueryValueRecord("SELECT * FROM users WHERE email = '$email'");
            if($verifyCode == md5($user['verify_code'])){
?>          
<?php
    require_once 'incfiles/header.php';
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">Khôi Phục Mật Khẩu</p>
            <div><a href="index.html">Trang Chủ</a> / Khôi Phục Mật Khẩu</div>
        </div>
        <div class="login-page container-custom">
            <form id="recovery-password">
                <div class="group-form">
                    <label>Mật khẩu mới:</label>
                    <input type="password" id="new-password" class="form-input" placeholder="Mật khẩu..." required>
                    <button type="button" class="togglepass">
                        <i class="far fa-eye-slash"></i>
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <span class="error newpass"></span>
                <div class="group-form">
                    <label>Xác nhận mật khẩu:</label>
                    <input type="password" id="confirm-password" class="form-input" placeholder="Mật khẩu..." required>
                    <button type="button" class="togglepass">
                        <i class="far fa-eye-slash"></i>
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <span class="error confirmpass"></span>
                <input type="hidden" id="user-id" value="<?=$user['user_id']?>">
                <button type="submit" class="form-submit"><i class="fas fa-sign-in-alt"></i> Xác nhận</button>
            </form>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            setTitle("Khôi Phục Mật Khẩu");
            $('#recovery-password').submit(function(e){
                var _this = $(this);
                $('span.error').html('');
                e.preventDefault();
                var user = $('#user-id').val();
                var newPass = $('#new-password').val();
                var confirmPass = $('#confirm-password').val();
                $.ajax({
                    url         : '<?=DOMAIN?>/api/MANAGE/user/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {user: user, newpass: newPass, confirmpass: confirmPass, action: 'recovery-password'},
                    beforeSend  : function(){
                            $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang cập nhật');
                    },
                    success     : function(data){
                        console.log(data)
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $('button[type="submit"]').html('<i class="fas fa-check"></i> Cập nhật thành công').attr("disabled","disabled");
                                $('input').attr('disabled','disabled');
                                $(_this).find("*").slideUp("slow");
                                $(_this).html("Thay đổi mật khẩu thành công, tự động chuyển về trang đăng nhập sau 3 giây nữa !");
                                toastr["success"]("Thay đổi mật khẩu thành công !", "Thành công");
                                setTimeout(function(){
                                    window.location.href="<?=DOMAIN?>/dang-nhap/";
                                },3000)
                            } else {
                                $.each(data.message, function(index, value){
                                    $('span.error.' + index).html(value);
                                });
                                toastr["error"]("Thay đổi mật khẩu thất bại, vui lòng kiểm tra lại!", "Thất bại");
                                $('button[type="submit"]').html('<i class="fas fa-exchange-alt"></i> Thay đổi');
                            }
                        },1000);
                    }
                })
            })
        })
    </script>
</body>
</html>
<?php } else {
                header('Location: '.DOMAIN.'/404.php');
            }
        } else {
            header('Location: '.DOMAIN.'/404.php');
        }
    } else {
        header('Location: '.DOMAIN.'/404.php');
    }
?>