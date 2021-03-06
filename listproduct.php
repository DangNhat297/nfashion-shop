<?php
    require_once 'incfiles/header.php';
    $listCategory   = getQueryValue("SELECT * FROM categories WHERE cat_active = 1");
    $sortBy = $_GET['sort-by'] ?? 'default';
    $valueCheckbox = $_GET['category'] ?? array();
    $strUrl = '';
    $query = "SELECT * FROM products, images, categories WHERE products.product_id = images.product_id AND products.is_hidden = 0 AND products.cat_id = categories.cat_id AND cat_active = 1 ";
    if(isset($_GET['search']) && $_GET['search'] != ''){
        $search = $_GET['search'];
        $query .= " AND products.name LIKE '%$search%'";
    }
    if(isset($_GET['type']) && $_GET['type'] == 'special'){
        $query .= " AND products.special = 1 ";
    }
    if(isset($_GET['type']) && $_GET['type'] == 'sale'){
        $query .= " AND products.discount > 0 ";
    }
    if(count($valueCheckbox) > 0){
        $category = implode(",", $valueCheckbox);
        $query .= " AND products.cat_id IN ($category)";
        foreach($valueCheckbox as $value){
            $strUrl .= "category%5B%5D=$value&";
        }
    }
    if(isset($_GET['min']) && isset($_GET['max'])){
        $min = (int)$_GET['min'];
        $max = (int)$_GET['max'];
        if($_GET['max'] > $_GET['min']){
            $query .= " AND products.price BETWEEN $min AND $max";
        } else if($_GET['max'] > 0 && ($_GET['max'] == $_GET['min'])){
            $query .= " AND products.price <= $max";
        }
    }
    switch($sortBy){
        case 'popular':
            $query .= " GROUP BY products.product_id ORDER BY products.view DESC";
            break;
        case 'old':
            $query .= " GROUP BY products.product_id ORDER BY products.product_id ASC";
            break;
        case 'price-low-to-high':
            $query .= " GROUP BY products.product_id ORDER BY products.price ASC";
            break;
        case 'price-high-to-low':
            $query .= " GROUP BY products.product_id ORDER BY products.price DESC";
            break;
        default: 
            $query .= " GROUP BY products.product_id ORDER BY products.product_id DESC";
            break;
    }
    $totalProduct   = rowCountQuery($query);
    $current_page   = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 12;
    $total_page = ceil($totalProduct / $limit);
    if ($current_page > $total_page){
        $current_page = $total_page;
    }
    else if ($current_page < 1){
        $current_page = 1;
    }
    $start = ($current_page - 1) * $limit;
    if($totalProduct == 0) $start = 0;
    $query .= " LIMIT $start, $limit";
    $listProduct    = getQueryValue($query);
    $strUrl = rtrim($strUrl, "&");
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">s???n ph???m</p>
            <div><a href="<?=DOMAIN?>/index.php">Trang Ch???</a> / S???n Ph???m</div>
        </div>
        <div class="list-product-page">
            <form method="GET" id="apply-filter">
            <div class="product-section container-custom">
                <div class="product-section-left">
                <?php if(count($listProduct) > 0){ ?>
                    <div class="filter-select">
                        S???p x???p theo: 
                        <select class="option-product" name="sort-by">
                            <option value="default" selected>M???c ?????nh</option>
                            <option value="popular">Ph??? bi???n</option>
                            <option value="old">H??ng c??</option>
                            <option value="price-low-to-high">Gi?? t??? th???p ?????n cao</option>
                            <option value="price-high-to-low">Gi?? t??? cao ?????n th???p</option>
                        </select>
                    </div>
                  <div class="list-product">
                  <?php foreach($listProduct as $product): ?>
                    <a href="/san-pham/<?=slug($product['name']).'.'.$product['product_id'].'.html'?>">
                        <div class="product">
                            <div class="product-image">
                                <img src="<?=DOMAIN?>/assets/img/product/<?=$product['image']?>">
                                <div class="product-button">
                                    <button data-id-product="<?=$product['product_id']?>" class="add-to-cart"><i class="fas fa-cart-plus"></i> th??m v??o gi???</button>
                                    <button type="button"><i class="fas fa-shopping-basket"></i> xem ngay</button>
                                </div>
                                <?=($product['discount'] > 0) ? '<div class="product-discount">Gi???m '.$product['discount'].' %</div>' : ''?>
                                <?=($product['special'] == 1) ? '<div class="product-special">Hot</div>' : ''?>
                            </div>
                            <div class="product-name">
                                <?=$product['name']?>
                            </div>
                            <div class="product-price">
                                <?=showPrice($product['price'], $product['discount'])?>
                            </div>
                        </div>
                    </a>
                    <?php endforeach ?>
                  </div>
                  <ul class="pagination">
                      <!-- <a href="#"><li><i class="fas fa-angle-left"></i></li></a>
                      <a href="#"><li class="active">1</li></a>
                      <a href="#"><li>2</li></a>
                      <a href="#"><li>3</li></a>
                      <a href="#"><li>4</li></a>
                      <a href="#"><li><i class="fas fa-angle-right"></i></li></a> -->
                      <?php
                        // n???u current_page > 1 v?? total_page > 1 m???i hi???n th??? n??t prev
                        if ($current_page > 1 && $total_page > 1){
                            echo '<a href="'.DOMAIN.'/danh-sach-san-pham/?page='.($current_page-1).(isset($_GET['sort-by']) ? '&sort-by='.$_GET['sort-by'] : '').(isset($_GET['search']) ? '&search='.$_GET['search'] : '').(count($valueCheckbox) > 0 ? '&'.$strUrl : '').(isset($_GET['min']) ? '&min='.$_GET['min'] : '').(isset($_GET['max']) ? '&max='.$_GET['max'] : '').(isset($_GET['type']) ? '&type='.$_GET['type'] : '').'"><li><i class="fas fa-angle-left"></i></li></a>';
                        }
                        // L???p kho???ng gi???a
                        for ($i = $current_page-2; $i <= $current_page+3; $i++){
                            // N???u l?? trang hi???n t???i th?? hi???n th??? th??? span
                            // ng?????c l???i hi???n th??? th??? a
                            if($current_page > 0){
                                if ($i == $current_page){
                                    echo '<a><li class="active">'.$i.'</li></a>';
                                } else if($i <= $total_page && $i > 0){
                                    echo '<a href="'.DOMAIN.'/danh-sach-san-pham/?page='.$i.(isset($_GET['sort-by']) ? '&sort-by='.$_GET['sort-by'] : '').(isset($_GET['search']) ? '&search='.$_GET['search'] : '').(count($valueCheckbox) > 0 ? '&'.$strUrl : '').(isset($_GET['min']) ? '&min='.$_GET['min'] : '').(isset($_GET['max']) ? '&max='.$_GET['max'] : '').(isset($_GET['type']) ? '&type='.$_GET['type'] : '').'"><li>'.$i.'</li></a>';
                                }
                            }
                        }
                        
                        // n???u current_page < $total_page v?? total_page > 1 m???i hi???n th??? n??t prev
                        if ($current_page < $total_page && $total_page > 1){
                            echo '<a href="'.DOMAIN.'/danh-sach-san-pham/?page='.($current_page+1).(isset($_GET['sort-by']) ? '&sort-by='.$_GET['sort-by'] : '').(isset($_GET['search']) ? '&search='.$_GET['search'] : '').(count($valueCheckbox) > 0 ? '&'.$strUrl : '').(isset($_GET['min']) ? '&min='.$_GET['min'] : '').(isset($_GET['max']) ? '&max='.$_GET['max'] : '').(isset($_GET['type']) ? '&type='.$_GET['type'] : '').'"><li><i class="fas fa-angle-right"></i></li></a>';
                        }
                        ?>
                  </ul>
                  <?php } else { echo 'Kh??ng t??m th???y s???n ph???m n??o'; } ?>
                </div>
                <div class="product-section-right">
                <div class="filter-price">
                      <div class="filter-price__title">T??m Ki???m</div>
                      <div class="filter-price__range">
                        <input type="text" name="search" class="form-input search-product" value="<?=$_GET['search'] ?? ''?>" placeholder="Nh???p t??? kh??a t??m ki???m...">
                        <button class="readmore">T??m ki???m</button>
                      </div>
                  </div>
                  <div class="filter-category">
                      <div class="filter-category__title">
                          Danh M???c S???n Ph???m
                      </div>
                      <div class="filter-category__list" id="style-5">
                          <?php  
                          foreach($listCategory as $category): ?>
                          <div class="filter-category__item">
                              <input type="checkbox" name="category[]" value="<?=$category['cat_id']?>" id="category-<?=$category['cat_id']?>" <?=(in_array($category['cat_id'], $valueCheckbox)) ? 'checked' : ''?>>
                              <label for="category-<?=$category['cat_id']?>"><?=$category['cat_name']?></label>
                          </div>
                          <?php endforeach ?>
                      </div>
                      <div class="filter-category-search">
                        <input type="text" placeholder="T??m danh m???c...">
                    </div>
                  </div>
                  <div class="filter-price">
                      <div class="filter-price__title">Gi??</div>
                      <div class="filter-price__range">
                          T???
                        <input type="number" class="form-filter-input" step="100000" name="min" min="0" value="<?=$_GET['min'] ?? 0 ?>" />
                        ?????n
                        <input type="number" class="form-filter-input" step="100000" name="max" min="0" value="<?=$_GET['max'] ?? 0 ?>" />
                      </div>
                  </div>
                  <button type="submit" class="filter-btn">L???c k???t qu???</button>
                </div>
            </div>
            </form>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            setTitle("S???n Ph???m - Trang <?=$current_page?>");
            $('.option-product').val(<?=isset($_GET['sort-by']) ? "'".$_GET['sort-by']."'" : '"default"'?>);
            $('input[name="min"]').blur(function(){
                var minValue = $(this).val();
                $('input[name="max"]').attr("min", minValue);
            })
            $('input[name="max"]').blur(function(){
                var maxValue = $(this).val();
                $('input[name="min"]').attr("max", maxValue);
            })
            $('.option-product').change(function(){
                $('#apply-filter').submit();
            })
        })
    </script>
</body>
</html>