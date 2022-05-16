<?php 
    require_once 'incfiles/head.php';
    $sql = "SELECT * FROM products ORDER BY view DESC LIMIT 0,5";
    $query = $conn->prepare($sql);
    $query->execute();
    $topProduct = $query->fetchAll(PDO::FETCH_ASSOC);
?>
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <i class="fas fa-tshirt fa-5x"></i>
                                </div>
                                <div class="col-8 text-right">
                                    <span> Sản phẩm </span>
                                    <h2 class="font-bold"><? echo countRecord("products") ?></h2>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fas fa-users fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Người dùng </span>
                                <h2 class="font-bold"><? echo countRecord("users") ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fas fa-archive fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Danh mục </span>
                                <h2 class="font-bold"><? echo countRecord("categories") ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fas fa-comments fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Bình luận </span>
                                <h2 class="font-bold"><? echo countRecord("comments") ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fas fa-shopping-basket fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Đơn hàng </span>
                                <h2 class="font-bold"><? echo countRecord("orders") ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fas fa-images fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Slide </span>
                                <h2 class="font-bold"><? echo countRecord("slides") ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>TOP 5 Sản Phẩm Lượt Xem Cao Nhất</h5>
                        </div>
                        <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover manage-film" >
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá sản phẩm</th>
                                        <th>Lượt xem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($topProduct as $product): ?>
                                    <tr>
                                        <td><?=$product['name']?></td>
                                        <td><?=product_price($product['price'])?></td>
                                        <td><?=$product['view']?></td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    include 'incfiles/foot.php';
?>

</body>
</html>
