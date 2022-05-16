<?php 
    require_once 'incfiles/head.php';
?>
<div class="wrapper wrapper-content">
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Thêm Người Dùng</h5>
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
                            <form id="add-user">
                                <div class="form-group row"><label for="fullname" class="col-lg-2 col-form-label">Họ và tên</label>
                                <div class="col-lg-10"><input type="text" name="fullname" id="fullname" placeholder="Nhập họ và tên..." class="form-control" required>
                                <span class="form-text error fullname m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="username" class="col-lg-2 col-form-label">Tên đăng nhập</label>
                                <div class="col-lg-10"><input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập..." class="form-control" required>
                                <span class="form-text error username m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="email" class="col-lg-2 col-form-label">Email</label>
                                <div class="col-lg-10"><input type="email" name="email" id="email" placeholder="Nhập địa chỉ email..." class="form-control" required>
                                <span class="form-text error email m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="password" class="col-lg-2 col-form-label">Mật khẩu</label>
                                <div class="col-lg-10"><input type="password" name="password" id="password" placeholder="Nhập mật khẩu..." class="form-control" required>
                                <span class="form-text error password m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="address" class="col-lg-2 col-form-label">Địa chỉ</label>
                                <div class="col-lg-10"><input type="text" name="address" id="address" placeholder="Nhập địa chỉ..." class="form-control" required>
                                <span class="form-text error address m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="permission" class="col-lg-2 col-form-label">Quyền</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-b" id="permission" name="permission">
                                        <option selected disabled>Chọn quyền</option>
                                        <option value="1">Thành Viên</option>
                                        <option value="2">Quản Trị Viên</option>
                                    </select>
                                <span class="form-text error permission m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="product-image" class="col-lg-2 col-form-label">Ảnh đại diện</label>
                                <div class="col-lg-10">
                                    <div class="custom-file">
                                        <input id="product-image" type="file" accept=".png, .jpg, .jpeg, .jfif" name="avatar" class="custom-file-input" multiple>
                                        <label for="product-image" class="custom-file-label">Chọn tệp...</label>
                                    </div>
                                    <span class="form-text error image m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row previewimage"><label for="" class="col-lg-2 col-form-label">Ảnh đại diện</label>
                                    <div class="col-lg-10 preview-image"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary" type="submit">Thêm người dùng</button>
                                        <a href="list-user.php"><button type="button" class="btn btn-sm btn-success">Danh sách người dùng</button></a>
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
            // preview image
            $('.previewimage').hide();
            $("#product-image").on('change',function(){
                $(".preview-image").empty();//you can remove this code if you want previous user input
                for(let i=0;i<this.files.length;++i){
                    let filereader = new FileReader();
                    let $img=jQuery.parseHTML("<img src='' style='width: 130px;height: 140px;object-fit:cover;border:1px solid #1ab394'>");
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
            $('#username').blur(function(){
                if(!/\b/.test($(this).val())){
                    $(this).val('');
                }
            });
            $('#fullname').blur(function(){
                if(!/\b/.test($(this).val())){
                    $(this).val('');
                }
            });
            $('#address').blur(function(){
                if(!/\b/.test($(this).val())){
                    $(this).val('');
                }
            });
            // submit add user
            $('#add-user').submit(function(e){
                e.preventDefault();
                $('span.error').html('');
                var data = new FormData(this);
                var error = [];
                data.append('action', 'add-user');
                data.append('confirm-password', data.get('password'));
                if(!data.get('permission')){
                    $('span.error.permission').html('Vui lòng chọn quyền');
                    error.push('permission');
                    $('#permission').change(function(){
                        $('span.error.permission').html('');
                    });
                }
                if(error.length == 0){
                    $.ajax({
                        url         : 'api/MANAGE/user/',
                        type        : 'POST',
                        processData : false,
                        contentType : false,
                        dataType    : 'json',
                        data        : data,
                        beforeSend  : function(){
                            $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang thêm');
                        },
                        success     : function(data){
                            setTimeout(function(){
                                if(data.status == 'success'){
                                    $('button[type="submit"]').html('<i class="fas fa-check"></i> Thêm thành công').attr("disabled","disabled");
                                    $('input,select').attr('disabled','disabled');
                                    swal("Thành công", "Thêm người dùng thành công", "success");
                                } else {
                                    $.each(data.message, function(index, value){
                                        $('span.error.' + index).html(value);
                                    });
                                    swal("Thất bại", "Thêm người dùng thất bại. Vui lòng thử lại", "error");
                                    $('button[type="submit"]').html('Thêm người dùng');
                                }
                            },1000);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>