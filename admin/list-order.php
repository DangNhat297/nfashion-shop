<?php 
    require_once 'incfiles/head.php';
?>
<div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Danh Sách Đơn Hàng</h5>
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
                                    <th>Thông tin</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ghi chú</th>
                                    <th>Xem chi tiết</th>
                                </tr>
                                </thead>
                                <tbody id="list-order">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content animated bounceInRight">
                        <div class="modal-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-detail-order">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2">Tổng tiền</th>
                                            <th>0.đ</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Đóng</button>
                        </div>
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
            function fetchOrder(){
                $.ajax({
                    url         : 'api/GET/order/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {get: 'list-order'},
                    success     : function(data){
                        var xhtml = '';
                        $.each(data, function(index, value){
                            xhtml += `<tr>
                                        <td>
                                            <p>`+ value.fullname +`</p>
                                            <p>`+ value.phone +`</p>
                                            <p>`+ value.email +`</p>
                                            <p>`+ value.address +`</p>
                                        </td>
                                        <td>`+ value.created +`</td>
                                        <td>`+ value.total +`</td>
                                        <td>
                                            <select class="form-control m-b order-status" style="font-size: 0.8rem;margin:0" data-id-order="`+ value.order_id +`" data-status="`+ value.status +`">
                                                <option value="0">Đã hủy</option>
                                                <option value="1">Đang xử lý</option>
                                                <option value="2">Đang giao hàng</option>
                                                <option value="3">Đã hoàn thành</option>
                                            </select>
                                        </td>
                                        <td>`+ ((value.note == '') ? 'Không' : value.note) +`</td>
                                        <td>
                                            <button type="button" id="order-detail" data-toggle="modal" data-target="#myModal" data-id-order="`+ value.order_id +`" class="btn btn-primary btn-xs"><i class="fas fa-shopping-basket"></i> Chi tiết</button>
                                            <button type="button" id="delete-order" data-id-order="`+ value.order_id +`" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Xóa</button>
                                        </td>
                                    </tr>`;
                        })
                        $('#list-order').html(xhtml)
                        $('.order-status').each(function(index, value){
                            var status = $(value).data('status')
                            $(value).val(status)
                        })

                    }
                })
            }
            fetchOrder()
            $(document).on('change', '.order-status', function(){
                var orderID = $(this).data('id-order')
                var status  = $(this).val()
                $.ajax({
                    url         : 'api/MANAGE/order/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {order: orderID, status: status, action: 'change-status'},
                    success     : function(data){
                        if(data.status == 'success'){
                            swal("Thành công", "Đã thay đổi trạng thái", "success")
                            fetchOrder()
                        } else {
                            swal("Thất bại", "Thay đổi thất bại, vui lòng thử lại", "error")
                        }
                    }
                })
            })
            $(document).on('click', '#order-detail', function(){
                var orderID = $(this).data('id-order')
                $.ajax({
                    url         : 'api/GET/order/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {order: orderID, get: 'order'},
                    success     : function(data){
                        var xhtml = ''
                        $.each(data.product, function(index, value){
                            xhtml += `<tr>
                                        <td>`+ value.name +`</td>
                                        <td><span class="badge badge-primary">`+ value.quantity +`</span></td>
                                        <td>`+ value.total +`</td>
                                    </tr>`
                        })
                        $('#table-detail-order').html(xhtml)
                        $('.modal-body table tfoot tr th:last-child').html(data.total)
                    }
                })
            })
            // xử lý xóa đơn hàng
            $(document).on('click', '#delete-order', function(){
                var orderID = $(this).data("id-order")
                swal({
                    title: "Bạn có chắc chắn muốn xóa đơn hàng này ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                    url         : 'api/MANAGE/order/',
                    type        : 'POST',
                    data        : {order: orderID, action: 'delete-order'},
                    dataType    : 'json',
                    success     : function(data){
                            if(data.status == 'success'){
                                swal("Thành công", "Bạn đã xóa đơn hàng thành công", "success")
                                fetchOrder()
                            } else {
                                swal("Thất bại", "Xóa thất bại, vui lòng thử lại", "error")
                            }
                        }
                    });
                }
                });
            });
        })
    </script>
</body>
</html>