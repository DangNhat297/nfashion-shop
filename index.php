<?php
    require_once 'incfiles/header.php';
    $newProduct     = getQueryValue("SELECT * FROM products, images, categories WHERE products.product_id = images.product_id AND products.is_hidden = 0 AND products.cat_id = categories.cat_id AND categories.cat_active = 1 GROUP BY products.product_id ORDER BY products.product_id DESC LIMIT 12");
    $topViewProduct = getQueryValue("SELECT * FROM products, images, categories WHERE products.product_id = images.product_id AND products.is_hidden = 0 AND products.cat_id = categories.cat_id AND categories.cat_active = 1 GROUP BY products.product_id ORDER BY products.view DESC LIMIT 12");
    $saleProduct    = getQueryValue("SELECT * FROM products, images, categories WHERE products.product_id = images.product_id AND products.is_hidden = 0 AND products.cat_id = categories.cat_id AND categories.cat_active = 1 AND products.discount > 0 GROUP BY products.product_id ORDER BY products.product_id DESC LIMIT 5");
    $specialProduct = getQueryValue("SELECT * FROM products, images, categories WHERE products.product_id = images.product_id AND products.is_hidden = 0 AND products.cat_id = categories.cat_id AND categories.cat_active = 1 AND products.special = 1 GROUP BY products.product_id ORDER BY products.product_id DESC LIMIT 5");
    $listCategory   = getQueryValue("SELECT * FROM categories WHERE cat_active = 1");
    $listSlide      = getQueryValue("SELECT * FROM slides");
?>
   <main>
        <div class="slider">
            <?php foreach($listSlide as $slide): ?>
            <div class="slider-item">
                <img src="assets/img/banner/<?=$slide['slide_image']?>">
                <div class="slide-caption">
                    <div class="slide-item__text">
                        <?=$slide['slide_title']?>
                    </div>
                    <p><a href="<?=$slide['slide_url']?>"><button class="slide-item__btn">Xem ngay</button></a></p>
                </div>
            </div>
            <?php endforeach ?>
        </div>
          <div class="banner-category container-custom">
              <div class="banner-category__item">
                  <div class="banner-category__item-image">
                    <img src="assets/img/banner10.1.jpg">
                  </div>
                  <a href="<?=DOMAIN?>/danh-sach-san-pham/?search=??o"><button class="banner-category__item-btn">??o</button></a>
              </div>
              <div class="banner-category__item">
                <div class="banner-category__item-image">
                  <img src="assets/img/banner10.2.jpg">
                </div>
                <a href="<?=DOMAIN?>/danh-sach-san-pham/?search=qu???n"><button class="banner-category__item-btn">Qu???n</button></a>
            </div>
            <div class="banner-category__item">
                <div class="banner-category__item-image">
                  <img src="assets/img/banner10.4.jpg">
                </div>
                <a href="<?=DOMAIN?>/danh-sach-san-pham/?search=gi??y d??p"><button class="banner-category__item-btn">Gi??y D??p</button></a>
            </div>
            <div class="banner-category__item">
                <div class="banner-category__item-image">
                  <img src="assets/img/banner10.5.jpg">
                </div>
                <a href="<?=DOMAIN?>/danh-sach-san-pham/?category%5B%5D=2"><button class="banner-category__item-btn">Ph??? Ki???n</button></a>
            </div>
          </div>
          <div class="product-section container-custom">
              <div class="product-section-left">
                <p class="title"><span>S???n Ph???m</span></p>
                <div class="tab-product">
                    <div class="tab-item active" data-tab="new-product">M???I NH???T</div>
                    <div class="tab-item" data-tab="top-view-product">XEM NHI???U</div>
                </div>
                <div class="list-product tab-content" id="new-product">
                    <?php
                    if(count($newProduct) > 0){
                    foreach($newProduct as $product): ?>
                    <a href="san-pham/<?=slug($product['name']).'.'.$product['product_id'].'.html'?>">
                        <div class="product">
                            <div class="product-image">
                                <img src="assets/img/product/<?=$product['image']?>">
                                <div class="product-button">
                                    <button data-id-product="<?=$product['product_id']?>" class="add-to-cart"><i class="fas fa-cart-plus"></i> th??m v??o gi???</button>
                                    <button><i class="fas fa-shopping-basket"></i> xem ngay</button>
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
                    <?php endforeach; } else {echo 'Kh??ng t??m th???y s???n ph???m n??o ';}?>
                </div>
                <div class="list-product tab-content" id="top-view-product">
                    <?php 
                    if(count($topViewProduct) > 0){
                    foreach($topViewProduct as $product): ?>
                    <a href="san-pham/<?=slug($product['name']).'.'.$product['product_id'].'.html'?>">
                        <div class="product">
                            <div class="product-image">
                                <img src="assets/img/product/<?=$product['image']?>">
                                <div class="product-button">
                                    <button data-id-product="<?=$product['product_id']?>" class="add-to-cart"><i class="fas fa-cart-plus"></i> th??m v??o gi???</button>
                                    <button><i class="fas fa-shopping-basket"></i> xem ngay</button>
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
                    <?php endforeach; } else {echo 'Kh??ng t??m th???y s???n ph???m n??o';} ?>
                </div>
                <a href="<?=DOMAIN?>/danh-sach-san-pham/"><button class="readmore">Xem Th??m S???n Ph???m</button></a>
              </div>
              <div class="product-section-right">
                <div class="category">
                    <div class="category-title">
                        Danh M???c S???n Ph???m
                    </div>
                    <div class="category-list">
                        <?php foreach($listCategory as $category): ?>
                        <a href="/danh-sach-san-pham/?category%5B%5D=<?=$category['cat_id']?>"><div class="category-list__item"><?=$category['cat_name']?></div></a>
                        <?php endforeach ?>
                    </div>
                    <div class="category-search">
                        <input type="text" placeholder="T??m danh m???c...">
                    </div>
                </div>
                <div class="best-sell">
                    <div class="best-sell__title">S???n Ph???m ?????c Bi???t</div>
                    <div class="best-sell__list">
                        <?php foreach($specialProduct as $product): ?>
                        <a href="san-pham/<?=slug($product['name']).'.'.$product['product_id'].'.html'?>">
                            <div class="best-sell__item">
                                <div class="best-sell__item--image">
                                    <img src="assets/img/product/<?=$product['image']?>">
                                </div>
                                <div class="best-sell__item--detail">
                                    <div class="best-sell__name"><?=$product['name']?></div>
                                    <div class="best-sell__price"><?=($product['discount'] > 0) ? product_price($product['price'] - ($product['price']*$product['discount']/100)).' <del>'.product_price($product['price']).'</del>' : product_price($product['price'])?></div>
                                </div>
                            </div>
                        </a>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="product-sale">
                    <div class="product-sale__title">Khuy???n M??i </div>
                    <div class="product-sale__list">
                        <?php foreach($saleProduct as $product): ?>
                        <a href="san-pham/<?=slug($product['name']).'.'.$product['product_id'].'.html'?>">
                            <div class="product-sale__item">
                                <div class="product-sale__item--image">
                                    <img src="assets/img/product/<?=$product['image']?>">
                                </div>
                                <div class="product-sale__item--detail">
                                    <div class="product-sale__name"><?=$product['name']?></div>
                                    <div class="product-sale__price"><?=product_price($product['price'] - ($product['price']*$product['discount']/100))?> <del><?=product_price($product['price'])?></del></div>
                                </div>
                            </div>
                        </a>
                        <?php endforeach ?>
                    </div>
                </div>
              </div>
          </div>
<?php
    $query = "SELECT products.product_id, products.name, products.price, products.discount, images.image, COUNT(comments.product_id) as soluongcmt FROM products, comments, images WHERE products.product_id = comments.product_id AND products.is_hidden = 0 AND products.product_id = images.product_id GROUP BY products.product_id HAVING soluongcmt > 0 ORDER BY soluongcmt DESC LIMIT 8;";
    if(rowCountQuery($query) > 0){
    $relatedProduct = getQueryValue($query);    
?>
          <div class="container-custom">
          <p class="title"><span>S???n Ph???m Nhi???u T????ng T??c</span></p>
            <div class="list-product product-comments" style="overflow: hidden;grid-template-columns:1fr">
            <?php foreach($relatedProduct as $product): ?>
                <a href="/san-pham/<?=slug($product['name']).'.'.$product['product_id'].'.html'?>">
                    <div class="product">
                        <div class="product-image">
                            <img src="<?=DOMAIN?>/assets/img/product/<?=$product['image']?>">
                            <div class="product-button">
                                <button data-id-product="<?=$product['product_id']?>" class="add-to-cart"><i class="fas fa-cart-plus"></i> th??m v??o gi???</button>
                                <button><i class="fas fa-shopping-basket"></i> xem ngay</button>
                            </div>
                        </div>
                        <div class="product-name">
                            <?=$product['name']?>
                        </div>
                        <?=showPrice($product['price'], $product['discount'])?>
                    </div>
                </a>
            <?php endforeach ;?>
            </div>
          </div>
          <?php } ?>
          <div class="container-custom">
            <div class="service">
                <div class="service-info">
                    <span><i class="fas fa-shipping-fast"></i></span>
                    <p>Mi???n ph?? giao h??ng</p>
                    <span>Mi???n ph?? giao h??ng v???i ????n h??ng tr??n 99k</span>
                </div>
                <div class="service-info">
                    <span><i class="fas fa-phone-volume"></i></span>
                    <p>H??? tr??? 24/7</p>
                    <span>H??? tr??? t?? v???n kh??ch h??ng m???i l??c m???i n??i</span>
                </div>
                <div class="service-info">
                    <span><i class="fas fa-sync-alt fa-spin"></i></span>
                    <p>Ch??nh s??ch ho??n tr???</p>
                    <span>Ho??n tr??? ngay n???u ????n h??ng c?? l???i</span>
                </div>
            </div>
          </div>
          <div class="container-custom">
              <p class="title"><span><i class="fab fa-instagram"></i> Theo D??i Ch??ng T??i Tr??n Instagram</span></p>
              <div class="list-img-ins">
                  <a href="">
                    <div class="img-ins">
                        <img src="assets/img/instagram01.jpg">
                    </div>
                  </a>
                  <a href="">
                    <div class="img-ins">
                        <img src="assets/img/instagram02.jpg">
                    </div>
                  </a>
                  <a href="">
                    <div class="img-ins">
                        <img src="assets/img/instagram03.jpg">
                    </div>
                  </a>
                  <a href="">
                    <div class="img-ins">
                        <img src="assets/img/instagram04.jpg">
                    </div>
                  </a>
                  <a href="">
                    <div class="img-ins">
                        <img src="assets/img/instagram05.jpg">
                    </div>
                  </a>
                  <a href="">
                    <div class="img-ins">
                        <img src="assets/img/instagram06.jpg">
                    </div>
                  </a>
              </div>
          </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $('.slider').slick({
            infinite: true,
            speed: 300,
            autoplay: true,
            cssEase: 'linear',
            fade: true,
            mouseDrag:true,
            animateOut: 'slideOutUp',
            autoplaySpeed: 2000,
            slidesToShow: 1,
            adaptiveHeight: true,
        });
        $('.product-comments').slick({
                slidesToShow: 4,
                slideToScroll: 1,
                dots: false,
                responsive: [
                    {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                    },
                    {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    }
                ]
            });
    </script>
    <script>
        $(document).ready(function(){
            function activeTab(tab){
                $('.tab-product>div').removeClass("active");
                $(tab).addClass("active");
                var id = $(tab).data("tab");
                $('.tab-content').hide();
                $('#' + id).show();
            }
            $('.tab-product>div').click(function(){
                activeTab(this);
                return false;
            });
            activeTab('.tab-product>div:first-child');
        })
    </script>
</body>
</html>