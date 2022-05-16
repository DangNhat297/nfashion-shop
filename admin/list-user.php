<?php 
    require_once 'incfiles/head.php';
?>
<div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Danh Sách Users</h5>
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
                            <table class="table table-bordered table-hover vertical-align">
                                <thead>
                                <tr>
                                    <th width="10%">Chọn</th>
                                    <th>Họ và tên</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Email</th>
                                    <th>Trạng thái</th>
                                    <th>Phần quyền</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody id="list-user">
                                </tbody>
                            </table>
                        </div>
                        <div class="ibox-footer">
                            <button type="button" class="btn btn-w-m btn-success select-all">Chọn tất cả</button>
                            <button type="button" class="btn btn-w-m btn-primary unselect-all">Bỏ chọn</button>
                            <button type="button" class="btn btn-w-m btn-danger remove-all">Xóa các mục chọn</button>
                            <a href="add-user.php"><button type="button" class="btn btn-w-m btn-info">Thêm người dùng mới</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                <div class="modal-content animated bounceInRight">
                <form id="update-user">
                    <div class="modal-body">
                            <div class="form-group row"><label for="fullname" class="col-lg-2 col-form-label">Họ và tên</label>
                            <div class="col-lg-10"><input type="text" id="fullname" placeholder="Họ và tên" class="form-control" disabled>
                            <span class="form-text errormodal category m-b-none"></span>
                            </div>
                            </div>
                            <div class="form-group row"><label for="username" class="col-lg-2 col-form-label">Họ và tên</label>
                            <div class="col-lg-10"><input type="text" id="username" placeholder="Tên đăng nhập" class="form-control" disabled>
                            </div>
                            </div>
                            <div class="form-group row"><label for="email" class="col-lg-2 col-form-label">Địa chỉ Email</label>
                            <div class="col-lg-10"><input type="email" id="email" placeholder="Email" class="form-control" disabled>
                            </div>
                            </div>
                            <div class="form-group row"><label for="product-special" class="col-lg-2 col-form-label">Hàng đặc biệt</label>
                                <div class="col-lg-10">
                                    <div class="form-check abc-radio abc-radio-info form-check-inline">
                                        <input class="form-check-input" type="radio" id="inlineRadio1" value="0" name="active" checked="">
                                        <label class="form-check-label" for="inlineRadio1"> Chưa Kích Hoạt </label>
                                    </div>
                                    <div class="form-check abc-radio abc-radio-info form-check-inline">
                                        <input class="form-check-input" type="radio" id="inlineRadio2" value="1" name="active">
                                        <label class="form-check-label" for="inlineRadio2"> Đã Kích Hoạt </label>
                                    </div>
                                <span class="form-text error special m-b-none"></span>
                                </div>
                            </div>
                            <div class="form-group row"><label for="permission" class="col-lg-2 col-form-label">Phân quyền</label>
                            <div class="col-lg-10">
                                <select name="permission" id="permission" class="form-control">
                                    <option value="1">Thành Viên</option>
                                    <option value="2">Quản Trị Viên</option>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                        <input type="hidden" name="id">
                </form>
                    </div>
                </div>
            </div>
    </div>
<?php
    include 'incfiles/foot.php';
?>
    <script>
        $(document).ready(function(){
            function fetchData(){
                $.ajax({
                    url         : 'api/GET/user/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {get: 'list-user'},
                    success     : function(data){
                        var xhtml = '';
                        $.each(data, function(index, value){
                            xhtml += `<tr>
                            <td>
                            <input type="checkbox" class="custom-checkbox-input" name="user[]" value="`+ value.id +`">
                            </td>
                            <td>`+ value.fullname +`</td>
                            <td>`+ value.username +`</td>
                            <td>`+ value.email +`</td>
                            <td>`+ (value.active == 0 ? '<span class="badge badge-danger">Chưa kích hoạt</span>' : '<span class="badge badge-primary">Đã kích hoạt</span>') +`</td>
                            <td>`+ ((value.permission == 1) ? '<span class="badge badge-success">Thành Viên</span>' : (value.permission == 2) ? '<span class="badge badge-primary">Quản Trị Viên</span>' : '<span class="badge badge-danger">Chưa Xác Định</span>') +`</td>
                            <td><button type="button" id="edituser" data-id-user="`+ value.id +`" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-success" data-popover="popover" data-placement="top" data-trigger="hover" data-content="Sửa người dùng" data-original-title="" title=""><i class="fas fa-pen"></i> Sửa</button>
                                <button type="button" id="deluser" class="btn btn-xs btn-danger" data-id-user="`+ value.id +`" data-popover="popover" data-placement="top" data-trigger="hover" data-content="Xóa người dùng" data-original-title="" title=""><i class="fas fa-trash-alt"></i> Xóa</button>
                            </td>
                            </tr>`
                        });
                        $('#list-user').html(xhtml);
                        $('[data-popover="popover"]').popover();
                        var lengthItem = $('#list-user tr').length;
                        if(lengthItem == 0){
                            $('.ibox-footer').hide();
                        } else {
                            $('.ibox-footer').show();
                        }
                        $('.table').DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": false,
                            "info": true,
                            "autoWidth": true,
                            "responsive": true,
                        });
                    }
                });
            }
            fetchData();
            // xử lý xóa người dùng
            $(document).on('click', '#deluser', function(){
                var user = $(this).data("id-user");
                swal({
                    title: "Bạn có chắc chắn muốn xóa người dùng này ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                    url         : 'api/MANAGE/user/',
                    type        : 'POST',
                    data        : {id: user, action: 'delete-user'},
                    dataType    : 'json',
                    success     : function(data){
                            if(data.status == 'success'){
                                swal("Thành công", "Bạn đã xóa thành công", "success");
                                setTimeout(function(){
                                    window.location.reload();
                                },1000);
                            } else {
                                swal("Thất bại", "Xóa thất bại, vui lòng thử lại", "error");
                            }
                        }
                    });
                }
                });
            });
            // truyền người dùng vào modal
            $(document).on('click', '#edituser', function(){
                var id = $(this).data("id-user");
                $.ajax({
                    url         : 'api/GET/user/',
                    type        : 'POST',
                    data        : {get: 'user', id: id},
                    dataType    : 'json',
                    success     : function(data){
                        $('#fullname').val(data.fullname);
                        $('#username').val(data.username);
                        $('#email').val(data.email);
                        $('input:radio[name="active"][value="'+data.active+'"]').prop("checked", true);
                        $('#permission').val(data.permission);
                        $('.modal input[name="id"]').val(data.id);
                    }
                });
            });
            // xóa tất cả các user đã chọn
            $(document).on('click', '.remove-all', function(){
                swal({
                    title: "Bạn có chắc chắn muốn xóa tất cả người dùng đã chọn ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    var arr = [];
                    $('.custom-checkbox-input').each(function(index, value){
                        if($(value).is(':checked')){
                            arr.push($(value).val());
                        }
                    });
                    if(arr.length === 0){
                        swal({
                            title: "Lỗi",
                            text: "Bạn chưa chọn mục để xóa, vui lòng thử lại !",
                            icon: "error",
                            button: "OK",
                            dangerMode: true
                        });
                    } else {
                        $.ajax({
                            url         : 'api/MANAGE/user/',
                            type        : 'POST',
                            dataType    : 'json',
                            data        : {users: arr, action: 'remove-user-select'},
                            beforeSend  : function(){
                                $('.remove-all').html('<i class="fas fa-circle-notch fa-spin"></i> Đang xóa');
                            },
                            success     : function(data){
                                setTimeout(function(){
                                    if(data.status == 'success'){
                                        swal("Thành công", "Bạn đã xóa thành công", "success");
                                        setTimeout(function(){
                                            window.location.reload();
                                        },1000);
                                    } else {
                                        swal("Thất bại", "Xóa thất bại, vui lòng thử lại", "error");
                                    }
                                },1000);
                            },
                            complete    : function(){
                                setTimeout(function(){
                                    $('.remove-all').html('Xóa các mục chọn')
                                },1000);
                            }
                        });
                    }
                }
                });
            });
            // submit sửa người dùng
            $(document).on('submit', '#update-user', function(e){
                e.preventDefault();
                var data = new FormData(this);
                data.append('action', 'update-user');
                $.ajax({
                    url         : 'api/MANAGE/user/',
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    dataType    : 'json',
                    data        : data,
                    beforeSend  : function(){
                        $('.modal-footer button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang cập nhật');
                    },
                    success     : function(data){
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $('#myModal button[type="submit"]').html('<i class="fas fa-check"></i> Đã cập nhật').attr("disabled", "disabled");
                                swal("Thành công","Cập nhật thành công","success");
                                $('.modal input').attr("disabled", "disabled");
                                setTimeout(function(){
                                    window.location.reload();
                                },1000);
                            } else {
                                $('#myModal button[type="submit"]').html('Cập nhật');
                                swal("Thất bại","Cập nhật thất bại, vui lòng thử lại","error");
                            }
                        },1000);
                    }
                });
            });
        });
    </script>
</body>
</html>