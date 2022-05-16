<?php
    require_once 'incfiles/header.php';
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">Đăng ký</p>
            <div><a href="<?=DOMAIN?>/index.php">Trang Chủ</a> / Đăng Ký</div>
        </div>
        <div class="login-page container-custom">
            <form id="register">
                <div class="group-form">
                    <label>Họ tên: *</label>
                    <input type="text" class="form-input" name="fullname" placeholder="Họ và tên..." required>
                </div>
                <span class="error fullname"></span>
                <div class="group-form">
                    <label>Tên đăng nhập: *</label>
                    <input type="text" class="form-input" name="username" placeholder="Tên đăng nhập..." required>
                </div>
                <span class="error username"></span>
                <div class="group-form">
                    <label>Email để kích hoạt tài khoản *</label>
                    <input type="email" class="form-input" name="email" placeholder="Địa chỉ email..." required>
                </div>
                <span class="error email"></span>
                <div class="group-form">
                    <label>Địa chỉ: *</label>
                    <input type="text" class="form-input" name="address" placeholder="Địa chỉ..." required>
                </div>
                <span class="error address"></span>
                <div class="group-form">
                    <label>Mật khẩu: *</label>
                    <input type="password" class="form-input" name="password" placeholder="Mật khẩu..." required>
                    <button type="button" class="togglepass">
                        <i class="far fa-eye-slash"></i>
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <span class="error password"></span>
                <div class="group-form">
                    <label>Xác nhận mật khẩu: *</label>
                    <input type="password" class="form-input" name="confirm-password" placeholder="Xác nhận mật khẩu..." required>
                    <button type="button" class="togglepass">
                        <i class="far fa-eye-slash"></i>
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <span class="error confirm-password"></span>
                <!-- <div class="group-form">
                    <label>Quyền hạn: *</label>
                    <select name="permission" class="form-input">
                        <option disabled selected>Chọn phân quyền:</option>
                        <option value="1">Thành Viên</option>
                        <option value="2">Quản Trị Viên</option>
                    </select>
                </div> -->
                <input type="hidden" name="permission" value="1">
                <span class="error permission"></span>
                <div class="group-form">
                    <label>Ảnh đại diện:</label>
                    <div class="custom-input-row">
                        <input onchange="loadFile(event)" accept="image/*" type="file" class="custom-file-input" name="avatar" id="inputfile" hidden>
                        <label for="inputfile" class="label-file-custom"><i class="fas fa-file-upload"></i> Chưa có tệp được chọn...</label>
                    </div>
                </div>
                <span class="error avatar"></span>
                <div class="group-form">
                    <img class="output-image">
                </div>
                <span class="error send-email"></span>
                <span class="error system"></span>
                <div class="g-recaptcha" data-sitekey="<?=SITEKEY?>"></div>
                <span class="error recaptcha"></span>
                <button type="submit" class="form-submit"><i class="fas fa-sign-in-alt"></i> Đăng ký</button>
                <div class="abcxyz"><span>hoặc</span></div>
                <div style="text-align: center;"><a href="<?=DOMAIN?>/quen-mat-khau/">Quên mật khẩu?</a></div>
                <div style="text-align: center;">Bạn đã có tài khoản? <a href="<?=DOMAIN?>/dang-nhap/">Đăng nhập</a></div>
            </form>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            setTitle("Đăng Ký - <?=WEBSITE_NAME?>");
            // Display an info toast with no title
            $('input').blur(function(){
                if(!/\b/.test($(this).val())){
                    $(this).val('');
                }
            });
            $('#register').submit(function(e){
                $('span.error').html('');
                e.preventDefault();
                var _this = $(this);
                var error = [];
                var data  = new FormData(this);
                data.append('action', 'register');
                if(!data.get('permission')){
                    $('span.error.permission').html('Vui lòng chọn phân quyền');
                    error.push('permission');
                    $('input[name="permission"]').change(function(){
                        $('span.error.permission').html('');
                    });
                }
                var fullName = data.get('fullname');
                fullName = fullName.trim().toLowerCase();
                var arr = fullName.split(" ");
                for (var i = 0; i < arr.length; i++) {
                    arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
                }
                fullName = arr.join(" ");
                data.set('fullname', fullName);
                data.append('captcha', grecaptcha.getResponse());
                if(error.length == 0){
                    $.ajax({
                        url         : '<?=DOMAIN?>/api/register/',
                        type        : 'POST',
                        dataType    : 'json',
                        data        : data,
                        processData : false,
                        contentType : false,
                        beforeSend  : function(){
                            $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang đăng ký')
                        },  
                        success     : function(data){
                            console.log(data);
                            setTimeout(function(){
                                if(data.status == 'success'){
                                    toastr["success"]("Đăng ký thành công, vui lòng kiểm tra email để xác minh tài khoản !", "Thành công");
                                    $('button[type="submit"]').html('<i class="fas fa-check"></i> Đăng ký thành công');
                                    $('input, select').attr("disabled", "disabled");
                                    $(_this).find('*').slideDown("slow");
                                    $(_this).html('Đăng ký thành công, vui lòng kiểm tra email để xác minh tài khoản. Xin cảm ơn !');
                                } else {
                                    grecaptcha.reset();
                                    $.each(data.message, function(index, value){
                                        $('span.error.' + index).html(value);
                                    })
                                    toastr["error"]("Đăng ký thất bại, vui lòng thử lại!", "Thất bại");
                                    $('button[type="submit"]').html('<i class="fas fa-sign-in-alt"></i> Đăng ký');
                                }
                            },1000)
                        }
                    })
                }
            })
        });
    </script>
</body>
</html>