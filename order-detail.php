<?php
    require_once 'incfiles/header.php';
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">Đơn Hàng</p>
            <div><a href="<?=DOMAIN?>/trang-chu.html">Trang Chủ</a> / Chi Tiết Đơn Hàng</div>
        </div>
        <?php
            $orderID = $_GET['order'] ?? 1;
            $userID = $_SESSION['user']['id'];
            $query = "SELECT products.name, orders_detail.order_quantity, orders_detail.order_price FROM orders, orders_detail, products WHERE products.product_id = orders_detail.product_id AND orders_detail.order_id = orders.order_id AND orders.user_id = $userID AND orders_detail.order_id = $orderID";
            if(rowCountQuery($query) > 0){
            $listProduct = getQueryValue($query);
            $total = 0;
        ?>
        <div class="order-page container-custom">
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($listProduct as $product): ?>
                    <tr>
                        <td><?=$product['name']?></td>
                        <td><?=$product['order_quantity']?></td>
                        <td><?=product_price($product['order_price']*$product['order_quantity'])?></td>
                    </tr>
                    <?php $total += $product['order_price']*$product['order_quantity']; ?>
                <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Tổng</th>
                        <th><?=product_price($total)?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php } else { ?> 
            <div class="active-page">
            <p>Đơn hàng không tồn tại</p><a href='<?=DOMAIN?>/trang-chu.html'><button class='readmore'>Về Trang Chủ</button></a>
            </div>
        <?php } ?>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            setTitle("Chi Tiết Đơn Hàng")
        })
    </script>
</body>
</html>