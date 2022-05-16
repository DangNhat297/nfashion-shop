<?php
    require_once 'incfiles/header.php';
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">Đăng nhập</p>
            <div><a href="index.html">Trang Chủ</a> / Đăng Nhập</div>
        </div>
        <div class="login-page container-custom">
            <form id="login">
                <div class="group-form">
                    <label>Tên đăng nhập:</label>
                    <input type="text" name="username" value="<? echo (isset($_COOKIE['username'])) ? $_COOKIE['username'] : ''; ?>" class="form-input username" placeholder="Tên đăng nhập..." required>
                </div>
                <span class="error username"></span>
                <div class="group-form">
                    <label>Mật khẩu:</label>
                    <input type="password" name="password" value="<? echo (isset($_COOKIE['password'])) ? $_COOKIE['password'] : ''; ?>" class="form-input password" placeholder="Mật khẩu..." required>
                    <button type="button" class="togglepass">
                        <i class="far fa-eye-slash"></i>
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <span class="error password"></span>
                <div class="group-form" style="flex-direction: row;column-gap: 7px;">
                    <input type="checkbox" id="remember" <? echo (isset($_COOKIE['remember'])) ? 'checked' : ''; ?>><label for="remember">Nhớ mật khẩu</label>
                </div>
                <span class="error active"></span>
                <div class="g-recaptcha" data-sitekey="<?=SITEKEY?>"></div>
                <span class="error recaptcha"></span>
                <button type="submit" class="form-submit"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
                <div class="abcxyz"><span>hoặc</span></div>
                <div style="text-align: center;"><a href="<?=DOMAIN?>/quen-mat-khau/">Quên mật khẩu?</a></div>
                <div style="text-align: center;">Bạn chưa có tài khoản? <a href="<?=DOMAIN?>/dang-ky/">Đăng ký</a></div>
            </form>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            setTitle("Đăng Nhập - <?=WEBSITE_NAME?>");
            $('#login').submit(function(e){
                $('span.error').html('');
                e.preventDefault();
                var username        = $('input[name="username"]').val();
                var password        = $('input[name="password"]').val();
                var remember        = '';
                if($('#remember').is(':checked')){
                    remember = 'yes';
                } else {
                    remember = 'no';
                }
                $.ajax({
                    url         : '<?=DOMAIN?>/api/login/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {username: username, password: password, remember: remember, captcha: grecaptcha.getResponse()},
                    beforeSend  : function(){
                        $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang đăng nhập')
                    },  
                    success     : function(data){
                        console.log(data);
                        setTimeout(function(){
                            if(data.status == 'success'){
                                toastr["success"]("Đăng nhập thành công !", "Thành công");
                                $('button[type="submit"]').html('<i class="fas fa-check"></i> Đăng nhập thành công');
                                $('input,button').attr("disabled", "disabled");
                                setTimeout(function(){
                                    window.location.href="<?=DOMAIN?>/trang-chu.html";
                                },1000)
                            } else {
                                grecaptcha.reset();
                                $.each(data.message, function(index, value){
                                    $('span.error.' + index).html(value);
                                })
                                toastr["error"]("Đăng nhập thất bại, vui lòng kiểm tra lại!", "Thất bại");
                                $('button[type="submit"]').html('<i class="fas fa-sign-in-alt"></i> Đăng nhập');
                            }
                        },1000)
                    }
                })
            })
        })
    </script>
</body>
</html>