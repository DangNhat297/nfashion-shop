<?php
    require_once 'incfiles/header.php';
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">Đổi Mật Khẩu</p>
            <div><a href="index.html">Trang Chủ</a> / Đổi Mật Khẩu</div>
        </div>
        <div class="login-page container-custom">
            <form id="change-password">
                <div class="group-form">
                    <label>Mật khẩu cũ:</label>
                    <input type="password" class="form-input password" id="oldpass" placeholder="Mật khẩu cũ..." required>
                    <button type="button" class="togglepass">
                        <i class="far fa-eye-slash"></i>
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <span class="error oldpass"></span>
                <div class="group-form">
                    <label>Mật khẩu mới:</label>
                    <input type="password" class="form-input password" id="newpass" placeholder="Mật khẩu mới..." required>
                    <button type="button" class="togglepass">
                        <i class="far fa-eye-slash"></i>
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <span class="error newpass"></span>
                <div class="group-form">
                    <label>Xác nhận mật khẩu:</label>
                    <input type="password" class="form-input password" id="confirm-password" placeholder="Xác nhận mật khẩu mới..." required>
                    <button type="button" class="togglepass">
                        <i class="far fa-eye-slash"></i>
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <input type="hidden" id="user-id" value="<?=$_SESSION['user']['id']?>">
                <span class="error confirmpass"></span>
                <button type="submit" class="form-submit"><i class="fas fa-exchange-alt"></i> Thay đổi</button>
            </form>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            setTitle("Đổi Mật Khẩu - <?=WEBSITE_NAME?>");
            $('input').blur(function(){
                if(!/\b/.test($(this).val())){
                    $(this).val('');
                }
            });
            $('#change-password').submit(function(e){
                e.preventDefault();
                $('span.error').html('');
                var oldPass = $('#oldpass').val();
                var newPass = $('#newpass').val();
                var confirmPass = $('#confirm-password').val();
                var id = $('#user-id').val();
                $.ajax({
                    url         : '<?=DOMAIN?>/api/MANAGE/user/',
                    type        : 'POST',
                    data        : {oldpass: oldPass, newpass: newPass, confirmpass: confirmPass, user: id, action: 'change-password'},
                    dataType    : 'json',
                    beforeSend  : function(){
                            $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang cập nhật');
                    },
                    success     : function(data){
                        console.log(data)
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $('button[type="submit"]').html('<i class="fas fa-check"></i> Cập nhật thành công').attr("disabled","disabled");
                                $('input').attr('disabled','disabled');
                                toastr["success"]("Thay đổi mật khẩu thành công !", "Thành công");
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
        });
    </script>
</body>
</html>