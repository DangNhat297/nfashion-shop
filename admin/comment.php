<?php 
    require_once 'incfiles/head.php';
    $id = (int)$_GET['product'] ?? 1;
?>
<div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Danh Sách Bình Luận Sản Phẩm</h5>
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
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th width="10%">Chọn</th>
                                    <th width="20%">Họ và tên</th>
                                    <th>Nội dung</th>
                                    <th>Thời gian</th>
                                    <th>Địa chỉ IP</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody id="list-comment-product">
                                </tbody>
                            </table>
                        </div>
                        <div class="ibox-footer">
                            <span class="form-text count-comment m-b-none"></span>
                            <button type="button" class="btn btn-w-m btn-success select-all">Chọn tất cả</button>
                            <button type="button" class="btn btn-w-m btn-primary unselect-all">Bỏ chọn</button>
                            <button type="button" class="btn btn-w-m btn-danger remove-all">Xóa các mục chọn</button>
                            <a href="list-comment.php"><button type="button" class="btn btn-w-m btn-info">Quay lại</button></a>
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
        // hàm get data list comment product
        function fetchData(){
            $.ajax({
                url         : 'api/GET/comment/',
                type        : 'POST',
                dataType    : 'json',
                data        : {get: 'comment', id: <?=$id?>},
                success     : function(data){
                    console.log(data)
                    var xhtml = '';
                    if(data.detail.length > 0){
                        $.each(data.detail, function(index, value){
                            xhtml += `<tr>
                                <td><input type="checkbox" class="custom-checkbox-input" name="comments[]" value="`+ value.cmt_id +`"></td>
                                <td>`+ value.fullname +`</td>
                                <td>`+ value.content +`</td>
                                <td>`+ value.time +`</td>
                                <td>`+ value.ipaddress +`</td>
                                <td><button type="button" id="delcmt" data-id-comment="`+ value.cmt_id +`" class="btn btn-xs btn-danger" data-popover="popover" data-placement="top" data-trigger="hover" data-content="Xóa bình luận" data-original-title="" title=""><i class="fas fa-trash-alt"></i> Xóa</button></td>
                            </tr>`;
                        })
                    }
                    $('#list-comment-product').html(xhtml);
                    $('.count-comment').text('Tổng có ' + data.detail.length + ' bình luận');
                    if($('#list-comment-product tr').length > 0){
                        $('.ibox-footer').show();
                    } else {
                        $('.ibox-footer').hide();
                    }
                }
            })
        }
        fetchData();
        // xử lý xóa danh mục
        $(document).on('click', '#delcmt', function(){
            var comment = $(this).data("id-comment");
            swal({
                title: "Bạn có chắc chắn muốn xóa bình luận này ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                url         : 'api/MANAGE/comment/',
                type        : 'POST',
                data        : {id: comment, action: 'remove'},
                dataType    : 'json',
                success     : function(data){
                        console.log(data)
                        if(data.status == 'success'){
                            swal("Thành công", "Bạn đã xóa thành công", "success");
                            fetchData();
                        } else {
                            swal("Thất bại", "Xóa thất bại, vui lòng thử lại", "error");
                        }
                    }
                });
            }
            });
        });
        // xóa tất cả mục đã chọn
        $(document).on('click', '.remove-all', function(){
            swal({
                title: "Bạn có chắc chắn muốn xóa các bình luận này ?",
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
                        url         : 'api/MANAGE/comment/',
                        type        : 'POST',
                        dataType    : 'json',
                        data        : {comments: arr, action: 'remove-all'},
                        beforeSend  : function(){
                            $('.remove-all').html('<i class="fas fa-circle-notch fa-spin"></i> Đang xóa');
                        },
                        success     : function(data){
                            setTimeout(function(){
                                if(data.status == 'success'){
                                    swal("Thành công", "Bạn đã xóa thành công", "success");
                                    fetchData();
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
    });
</script>
</body>
</html>