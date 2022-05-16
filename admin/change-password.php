<?php
    require_once 'incfiles/head.php';
?>
        <div class="wrapper wrapper-content">
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Thay đổi mật khẩu</h5>
                        </div>
                        <div class="ibox-content">
                            <form id="change-password">
                                <div class="form-group row"><label for="oldpass" class="col-lg-2 col-form-label">Mật khẩu cũ</label>
                                <div class="col-lg-10"><input type="password" id="oldpass" placeholder="Mật khẩu cũ" class="form-control" required>
                                <span class="form-text error oldpass m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="newpass" class="col-lg-2 col-form-label">Mật khẩu mới</label>
                                    <div class="col-lg-10"><input type="password" id="newpass" placeholder="Mật khẩu mới" class="form-control" required>
                                    <span class="form-text error newpass m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="repass" class="col-lg-2 col-form-label">Nhập lại mật khẩu mới</label>
                                    <div class="col-lg-10"><input type="password" id="confirm-password" placeholder="Nhập lại mật khẩu" class="form-control" required>
                                    <span class="form-text error confirmpass m-b-none"></span>
                                </div>
                                </div>
                                <input type="hidden" id="user-id" value="<?=$_SESSION['user']['id']?>">
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary" type="submit">Thay đổi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    include 'incfiles/foot.php';
?>
    <script>
        $(document).ready(function(){
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
                    url         : '../api/MANAGE/user/',
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
                                swal("Thành công", "Cập nhật thành công", "success");
                            } else {
                                $.each(data.message, function(index, value){
                                    $('span.error.' + index).html(value);
                                });
                                swal("Thất bại", "Cập nhật thất bại. Vui lòng thử lại", "error");
                                $('button[type="submit"]').html('Thay đổi');
                            }
                        },1000);
                    }
                })
            })
        });
    </script>
</body>
</html>
