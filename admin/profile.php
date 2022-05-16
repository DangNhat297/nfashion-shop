<?php 
    require_once 'incfiles/head.php';
?>
<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Thông Tin Tài Khoản</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form id="update-current-user">
                            <div class="form-group row"><label for="fullname" class="col-lg-2 col-form-label">Họ và tên</label>
                            <div class="col-lg-10"><input type="text" name="fullname" id="fullname" placeholder="Nhập họ và tên" class="form-control" required>
                            <span class="error fullname"></span>
                            </div>
                            </div>
                            <div class="form-group row"><label for="username" class="col-lg-2 col-form-label">Tên đăng nhập</label>
                            <div class="col-lg-10"><input type="text" id="username" placeholder="Tên đăng nhập" class="form-control" disabled>
                            </div>
                            </div>
                            <div class="form-group row"><label for="email" class="col-lg-2 col-form-label">Email</label>
                            <div class="col-lg-10"><input type="email" id="email" placeholder="Email" class="form-control" disabled>
                            </div>
                            </div>
                            <div class="form-group row"><label for="address" class="col-lg-2 col-form-label">Địa chỉ</label>
                            <div class="col-lg-10"><input type="text" name="address" id="address" placeholder="Địa chỉ" class="form-control" required>
                            </div>
                            </div>
                            <div class="form-group row"><label for="permission" class="col-lg-2 col-form-label">Chức vụ</label>
                            <div class="col-lg-10"><input type="text" id="permission" placeholder="Chức vụ" class="form-control" disabled>
                            </div>
                            </div>
                            <div class="form-group row"><label for="created" class="col-lg-2 col-form-label">Ngày đăng ký</label>
                            <div class="col-lg-10"><input type="text" id="created" placeholder="Ngày đăng ký" class="form-control" disabled>
                            </div>
                            </div>
                            <div class="form-group row"><label for="" class="col-lg-2 col-form-label">Avatar</label>
                                <div class="col-lg-10">
                                    <img src="" id="avatar" style="width: auto;height: 100px;object-fit:cover">
                                </div>
                            </div>
                            <div class="form-group row"><label for="product-image" class="col-lg-2 col-form-label">Tải logo mới</label>
                            <div class="col-lg-10">
                                <div class="custom-file">
                                    <input id="product-image" name="avatar" type="file" accept=".png, .jpg, .jpeg, .jfif" class="custom-file-input">
                                    <label for="product-image" class="custom-file-label">Chọn tệp...</label>
                                </div>
                                <span class="form-text error image m-b-none"></span>
                            </div>
                            </div>
                            <div class="form-group row previewimage"><label for="" class="col-lg-2 col-form-label">Xem trước logo website</label>
                                <div class="col-lg-10 preview-image">
                                </div>
                            </div>
                            <input type="hidden" name="id">
                            <div class="form-group row">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary" type="submit">Cập nhật</button>
                                    <a href="change-password.php"><button type="button" class="btn btn-sm btn-success">Đổi mật khẩu</button></a>
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
            function getUserInfo(){
                $.ajax({
                    url         : '../api/GET/user/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {get: 'user-information'},
                    success     : function(data){
                        console.log(data)
                        $('#fullname').val(data.fullname)
                        $('#username').val(data.username)
                        $('#email').val(data.email)
                        $('#permission').val((data.permission == 1) ? 'Thành Viên' : 'Quản Trị Viên')
                        $('#created').val(data.created)
                        $('#address').val(data.address)
                        $('#avatar').attr('src', '../assets/img/avatar/' + data.avatar)
                        $('input[name="id"]').val(data.id)
                    }
                })
            }
            getUserInfo();
            // preview image
            $('.previewimage').hide();
            $("#product-image").on('change',function(){
                $(".preview-image").empty();//you can remove this code if you want previous user input
                for(let i=0;i<this.files.length;++i){
                    let filereader = new FileReader();
                    let $img=jQuery.parseHTML("<img src='' style='width: auto;height: 100px;object-fit:cover;border:1px solid #1ab394'>");
                    filereader.onload = function(){
                        $img[0].src=this.result;
                    };
                    filereader.readAsDataURL(this.files[i]);
                    $(".preview-image").append($img);
                }
            });
            // xử lý preview image
            $('.custom-file-input').on('change', function() {
                $(this).next('.custom-file-label').addClass("selected").html('Đã tải lên ' + this.files.length + ' tệp');
                if(this.files.length === 0){
                    $('.previewimage').hide();
                } else {
                    $('.previewimage').show();
                }
            });
            // update current user
            $('input').blur(function(){
                if(!/\b/.test($(this).val())){
                    $(this).val('');
                }
            });
            $('#update-current-user').submit(function(e){
                e.preventDefault();
                var data = new FormData(this);
                data.append('action', 'update-current-user');
                $.ajax({
                    url         : '../api/MANAGE/user/',
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
                                swal("Thành công", "Cập nhật tài khoản công", "success");
                            } else {
                                $.each(data.message, function(index, value){
                                    $('span.error.' + index).html(value);
                                });
                                swal("Thất bại", "Cập nhật thất bại. Vui lòng thử lại", "error");
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