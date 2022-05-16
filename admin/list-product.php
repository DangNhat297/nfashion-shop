<?php 
    require_once 'incfiles/head.php';
?>
<div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Danh Sách Sản Phẩm</h5>
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
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>% Giảm giá</th>
                                    <th>Loại hàng</th>
                                    <th>Lượt xem</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody id="list_product">
                                </tbody>
                            </table>
                        </div>
                        <div class="ibox-footer">
                            <button type="button" class="btn btn-w-m btn-success select-all">Chọn tất cả</button>
                            <button type="button" class="btn btn-w-m btn-primary unselect-all">Bỏ chọn</button>
                            <button type="button" class="btn btn-w-m btn-danger remove-all">Xóa các mục chọn</button>
                            <a href="add-product.php"><button type="button" class="btn btn-w-m btn-info">Thêm sản phẩm mới</button></a>
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
            function fetchData(){
                $.ajax({
                    url         : 'api/GET/product/',
                    type        : 'POST',
                    data        : {get: 'table'},
                    success     : function(data){
                        $('#list_product').html(data);
                        $('[data-popover="popover"]').popover();
                        var lengthItem = $('#list_product tr').length;
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
            // xử lý xóa sản phẩm
            $(document).on('click', '#delproduct', function(){
                var product = $(this).data("id-product");
                swal({
                    title: "Bạn có chắc chắn muốn xóa sản phẩm này ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                    url         : 'api/MANAGE/product/',
                    type        : 'POST',
                    data        : {id: product, action: 'remove-product'},
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
            // xóa tất cả mục đã chọn
            $(document).on('click', '.remove-all', function(){
                swal({
                    title: "Bạn có chắc chắn muốn xóa tất cả sản phẩm đã chọn này ?",
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
                            url         : 'api/MANAGE/product/',
                            type        : 'POST',
                            dataType    : 'json',
                            data        : {products: arr, action: 'remove-product-select'},
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