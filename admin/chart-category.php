<?php 
    require_once 'incfiles/head.php';
?>
<div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Biểu Đồ Thống Kê Danh Mục Sản Phẩm</h5>
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
                            <div id="chart"></div>
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
            <?php 
                $sql = "SELECT categories.cat_name, COUNT(products.product_id) as soluong FROM categories, products WHERE products.cat_id = categories.cat_id GROUP BY categories.cat_id";
                $query = $conn->prepare($sql);
                $query->execute();
                $categories = $query->fetchAll();
                if($query->rowCount() > 0){   
            ?>
            c3.generate({
                bindto: '#chart',
                data:{
                    columns: [
                        <?php foreach($categories as $category): ?>
                        ['<?=$category['cat_name']?>', <?=$category['soluong']?>],
                        <?php endforeach ?>
                    ],
                    type : 'pie'
                }
            });
            <?php } else {?> 
                $('#chart').html('Không có dữ liệu');    
            <?php } ?>
        })
    </script>
</body>
</html>