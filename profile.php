<?php
    require_once 'incfiles/header.php';
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">Tài Khoản</p>
            <div><a href="<?=DOMAIN?>/index.php">Trang Chủ</a> / Tài Khoản</div>
        </div>
        <div class="login-page container-custom">
            <form id="update-current-user">
                <div class="group-form">
                    <label>Họ tên:</label>
                    <input type="text" class="form-input" id="fullname" name="fullname" placeholder="Họ và tên..." required>
                </div>
                <span class="error fullname"></span>
                <div class="group-form">
                    <label>Địa chỉ:</label>
                    <input type="text" class="form-input" id="address" name="address" placeholder="Địa chỉ..." required>
                </div>
                <div class="group-form">
                    <label>Tên đăng nhập:</label>
                    <input type="text" class="form-input" id="username" placeholder="Tên đăng nhập..." disabled>
                </div>
                <div class="group-form">
                    <label>Email:</label>
                    <input type="email" class="form-input" id="email" placeholder="Địa chỉ email..." disabled>
                </div>
                <div class="group-form">
                    <label>Chức vụ:</label>
                    <input type="text" class="form-input" id="permission" placeholder="Chức vụ" disabled>
                </div>
                <div class="group-form">
                    <label>Ngày đăng ký:</label>
                    <input type="text" class="form-input" id="created" placeholder="Ngày tạo tài khoản" disabled>
                </div>
                <div class="group-form">
                    <label>Ảnh đại diện:</label>
                    <div class="custom-input-row">
                        <img style="margin: 0 auto;width: 150px;height: 150px;object-fit: cover;border-radius: 50%;display: block;border: 0.5px solid var(--blue);" id="avatar">
                    </div>
                </div>
                <div class="group-form">
                    <label>Ấn vào đây nếu muốn thay đổi ảnh đại diện:</label>
                    <div class="custom-input-row">
                        <input onchange="loadFile(event)" accept="image/*" type="file" class="custom-file-input" name="avatar" id="inputfile" hidden>
                        <label for="inputfile" class="label-file-custom"><i class="fas fa-file-upload"></i> Chưa có tệp được chọn...</label>
                    </div>
                </div>
                <span class="error avatar"></span>
                <div class="group-form">
                    <img class="output-image">
                </div>
                <input type="hidden" name="id">
                <button type="submit" class="form-submit"><i class="fas fa-sign-in-alt"></i> Cập nhật</button>
            </form>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            setTitle("Thông Tin Tài Khoản - <?=WEBSITE_NAME?>");
            function getUserInfo(){
                $.ajax({
                    url         : '<?=DOMAIN?>/api/GET/user/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {get: 'user-information'},
                    success     : function(data){
                        console.log(data)
                        $('#fullname').val(data.fullname)
                        $('#username').val(data.username)
                        $('#email').val(data.email)
                        $('#permission').val((data.permission == 1) ? 'Thành Viên' : (data.permission == 2) ? 'Quản Trị Viên' : 'Không Xác Định')
                        $('#created').val(data.created)
                        $('#address').val(data.address)
                        $('#avatar').attr('src', '<?=DOMAIN?>/assets/img/avatar/' + data.avatar)
                        $('input[name="id"]').val(data.id)
                    }
                })
            }
            getUserInfo();
            $('input').blur(function(){
                if(!/\b/.test($(this).val())){
                    $(this).val('');
                }
            });
            $('#update-current-user').submit(function(e){
                e.preventDefault();
                var data = new FormData(this);
                $('span.error').html('');
                data.append('action', 'update-current-user');
                $.ajax({
                    url         : '<?=DOMAIN?>/api/MANAGE/user/',
                    type        : 'POST',
                    dataType    : 'json',
                    contentType : false,
                    processData : false,
                    data        : data,
                    beforeSend  : function(){
                            $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang cập nhật');
                        },
                    success     : function(data){
                        console.log(data);
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $('button[type="submit"]').html('<i class="fas fa-check"></i> Cập nhật thành công').attr("disabled","disabled");
                                $('input').attr('disabled','disabled');
                                toastr["success"]("Cập nhật tài khoản thành công !", "Thành công");
                            } else {
                                $.each(data.message, function(index, value){
                                    $('span.error.' + index).html(value);
                                })
                                toastr["error"]("Cập nhật thất bại, vui lòng kiểm tra lại!", "Thất bại");
                                $('button[type="submit"]').html('Cập nhật');
                            }
                        },1000);
                    }
                });
            });
        });
    </script>
</body>
</html>