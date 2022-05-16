<?php
    require_once 'incfiles/header.php';
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">Đơn Hàng</p>
            <div><a href="<?=DOMAIN?>/trang-chu.html">Trang Chủ</a> / Đơn Hàng</div>
        </div>
        <?php
            $idUser = $_SESSION['user']['id'];
            $query = "SELECT orders.order_id, orders.user_id, orders.fullname, orders.phone, orders.email, orders.address, orders.note, orders.status, orders.created_at, SUM(orders_detail.order_quantity*orders_detail.order_price) as tongtien FROM orders, orders_detail WHERE orders.order_id = orders_detail.order_id AND orders.user_id = $idUser GROUP BY orders.order_id;";
            if(rowCountQuery($query) > 0){
            $listOrder = getQueryValue($query);
        ?>
        <div class="order-page container-custom">
            <table>
                <thead>
                    <tr>
                        <th>Thông tin</th>
                        <th>Ngày đặt hàng</th>
                        <th>Ghi chú</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($listOrder as $order): ?>
                    <tr>
                        <td>
                            <p><?=$order['fullname']?></p>
                            <p><?=$order['phone']?></p>
                            <p><?=$order['email']?></p>
                            <p><?=$order['address']?></p>
                        </td>
                        <td><?=$order['created_at']?></td>
                        <td><?=($order['note'] == '') ? 'Không' : $order['note']?></td>
                        <td><?=product_price($order['tongtien'])?></td>
                        <td><?=($order['status'] == 0) ? 'Đã hủy' : (($order['status'] == 1) ? 'Đang xử lý' : (($order['status'] == 2) ? 'Đang giao hàng' : 'Đã hoàn thành'))?></td>
                        <td><a href="<?=DOMAIN?>/chi-tiet-don-hang/<?=$order['order_id']?>"><button class="readmore">Xem chi tiết</button></a>
                            <?php if($order['status'] == 1){ ?> <a href="<?=DOMAIN?>/cancel-order.php?order=<?=$order['order_id']?>" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')"><button class="readmore danger">Hủy đơn</button></a> <?php } ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <?php } else { ?> 
            <div class="active-page">
            <p>Bạn chưa có đơn hàng nào.</p><a href='<?=DOMAIN?>/trang-chu.html'><button class='readmore'>Về Trang Chủ</button></a>
            </div>
        <?php } ?>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            setTitle("Đơn Hàng")
        })
    </script>
</body>
</html>