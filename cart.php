<?php
    require_once 'incfiles/header.php';
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">giỏ hàng</p>
            <div><a href="<?=DOMAIN?>/trang-chu.html">Trang Chủ</a> / Giỏ Hàng</div>
        </div>
        <div class="cart-page container-custom">
            <div class="table-cart__header">
                <div>Ảnh sản phẩm</div>
                <div>Tên sản phẩm</div>
                <div>Giá</div>
                <div>Số lượng</div>
                <div>Thành tiền</div>
                <div>Xóa</div>
            </div>
            <div class="table-cart__body"></div>
            <div class="total-money">
                <span>Tổng tiền: </span>
                <span>450.000đ</span>
            </div>
            <div class="cart-footer__btn">
                <a href="<?=DOMAIN?>/danh-sach-san-pham/"><button class="continue-shopping"><i class="fas fa-shopping-bag"></i> Tiếp Tục Mua Hàng</button></a>
                <a href="<?=DOMAIN?>/thanh-toan/"><button class="cart-checkout"><i class="fas fa-money-check-alt"></i> Thanh Toán</button></a>
            </div>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            function fetchCart(){
                $.ajax({
                    url         : '<?=DOMAIN?>/api/GET/cart/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {get: 'list-cart'},
                    success     : function(data){
                        console.log(data)
                        var xhtml = '';
                        if(data.detail.length > 0){
                            $.each(data.detail, function(index, value){
                                xhtml += `<div class="cart-item">
                                            <div class="cart-item__image">
                                                <img src="<?=DOMAIN?>/assets/img/product/`+ value.image +`">
                                            </div>
                                            <div class="cart-item__name">`+ value.name +`</div>
                                            <div class="cart-item__price">`+ value.price +`</div>
                                            <div class="cart-item__quantity">
                                                <div class="cart-quantity__btn">
                                                    <button class="cart-quantity__button sub">-</button>
                                                    <input type="number" name="quantity" data-id-cart="`+ value.id +`" step="1" value="`+ value.quantity +`" class="btn-quantity" min="1">
                                                    <button class="cart-quantity__button add">+</button>
                                                </div>
                                            </div>
                                            <div class="cart-item__total">`+ value.total +`</div>
                                            <div class="cart-item__action">
                                                <button class="remove-cart__btn" data-id-cart="`+ value.id +`"><i class="far fa-trash-alt"></i> Xóa</button>
                                            </div>
                                        </div>`;
                            })
                            $('.total-money, .cart-footer__btn').show();
                            $('.total-money span:last-child').html(data.sum);
                        } else {
                            $('.total-money, .cart-footer__btn>button:last-child').hide();
                            xhtml = '<p style="text-align:center;padding: 20px;">Giỏ hàng của bạn đang trống</p>';
                        }
                        $('.table-cart__body').html(xhtml);
                    }
                })
            }
            fetchCart();
            $(document).on('click', '.remove-cart__btn', function(){
                var id = $(this).data('id-cart');
                $.ajax({
                    url         : '<?=DOMAIN?>/api/MANAGE/cart/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {id: id, action: 'delete-cart-product'},
                    success     : function(data){
                        console.log(data)
                        if(data.status == 'success'){
                            toastr["success"]("Đã xóa sản phẩm khỏi giỏ hàng", "Thành công");
                            fetchCart();
                            getCart();
                        } else {
                            toastr["error"]("Xóa thất bại, vui lòng thử lại !", "Thất bại");
                        }
                    }
                })
            })
            $(document).on('change', '.btn-quantity', function(){
                var id = $(this).data('id-cart');
                var quantity = parseInt($(this).val());
                $.ajax({
                    url         : '<?=DOMAIN?>/api/MANAGE/cart/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {id: id, quantity: quantity, action: 'update-cart'},
                    success     : function(data){
                        if(data.status == 'success'){
                            toastr["success"]("Đã cập nhật giỏ hàng", "Thành công");
                            fetchCart();
                            getCart();
                        } else {
                            toastr["error"]("Cập nhật thất bại, vui lòng thử lại !", "Thất bại");
                        }
                    }
                })
            })
        })
    </script>
</body>
</html>