<?php
    require_once 'incfiles/header.php';
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">quên mật khẩu</p>
            <div><a href="<?=DOMAIN?>/trang-chu.html">Trang Chủ</a> / Quên mật khẩu</div>
        </div>
        <div class="login-page container-custom">
            <form id="forgot-password">
                <div class="group-form">
                    <label>Địa chỉ email:</label>
                    <input type="email" id="email" class="form-input email" placeholder="Nhập email để khôi phục mật khẩu..." required>
                </div>
                <span class="error email"></span>
                <button type="submit" class="form-submit"><i class="far fa-envelope-open"></i> Xác nhận</button>
                <div class="abcxyz"><span>hoặc</span></div>
                <div style="text-align: center;">Bạn chưa có tài khoản? <a href="<?=DOMAIN?>/dang-ky/">Đăng ký</a> hoặc <a href="<?=DOMAIN?>/dang-nhap/">Đăng nhập</a></div>
            </form>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            setTitle("Quên Mật Khẩu - <?=WEBSITE_NAME?>");
            $('#forgot-password').submit(function(e){
                $('span.error').html('');
                e.preventDefault();
                var _this = $(this);
                var email = $('#email').val();
                $.ajax({
                    url         : '<?=DOMAIN?>/api/MANAGE/user/',
                    type        : 'POST',
                    data        : {email: email, action: 'forgot-password'},
                    dataType    : 'json',
                    beforeSend  : function(){
                            $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang cập nhật');
                    },
                    success     : function(data){
                        console.log(data)
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $(_this).find("*").slideUp("slow");
                                $(_this).html('Chúng tôi vừa gửi tới email của bạn thư khôi phục mật khẩu, vui lòng kiểm tra email để xác nhận ! Xin cảm ơn.')
                                toastr["success"]("Vui lòng kiểm tra email để khôi phục mật khẩu !", "Thành công");
                            } else {
                                $.each(data.message, function(index, value){
                                    $('span.error.' + index).html(value);
                                });
                                toastr["error"]("Thay đổi mật khẩu thất bại, vui lòng kiểm tra lại!", "Thất bại");
                                $('button[type="submit"]').html('<i class="far fa-envelope-open"></i> Xác nhận');
                            }
                        },1000);
                    }

                })
            })
        })
    </script>
</body>
</html>