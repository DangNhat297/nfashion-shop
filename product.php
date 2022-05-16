<?php
    require_once 'incfiles/header.php';
    $id             = !empty($_GET['id']) ? $_GET['id'] : 1;
    $issetProduct   = issetRecordQuery("SELECT * FROM products WHERE product_id = $id");
    $product        = getQueryValueRecord("SELECT * FROM products,categories WHERE product_id = $id AND products.cat_id = categories.cat_id");
    $listImage      = getQueryValue("SELECT * FROM images WHERE product_id = $id");
?>
    <main>
        <div class="product-single container-custom">
            <?php if($issetProduct){ 
                queryExecute("UPDATE products SET view = view+1 WHERE product_id = $id");    
            ?>
            <div class="breadcrumb-detail">
                <ul class="bread-crumb">
                    <li><a href="<?=DOMAIN?>/index.php">Trang chủ</a></li>
                    <li><a href="#">Sản phẩm</a></li>
                    <li><?=$product['name']?></li>
                </ul>
            </div>
            <div class="product-detail">
                <div class="product-detail__image">
                    <div class="product-detail__image--thumbnail">
                        <?php foreach($listImage as $image): ?>
                            <img src="<?=DOMAIN?>/assets/img/product/<?=$image['image']?>">
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="product-detail__info">
                    <div class="product-info__name">
                        <?=$product['name']?>
                    </div>
                    <div class="product-info__price">
                        <?=($product['discount'] > 0) ? product_price($product['price'] - ($product['price']*$product['discount']/100)).' <del>'.product_price($product['price']).'</del>' : product_price($product['price'])?>
                    </div>
                    <hr>
                    <div class="product-info__short--description">
                        <?=$product['description']?>
                    </div>
                    <div class="product-info__quantity">Số lượng:
                        <div class="product-info__quantify--btn">
                            <button type="button" class="btn-quantity sub">-</button>
                            <input type="number" name="quantity" step="1" value="1" class="btn-quantity" min="1">
                            <input type="hidden" name="id" value="1">
                            <button type="button" class="btn-quantity add">+</button>
                        </div>
                    </div>
                    <div class="product-info__btn">
                        <button class="add-cart" data-id-product="<?=$product['product_id']?>"><i class="fas fa-cart-plus"></i> Thêm Vào Giỏ</button>
                    </div>
                    <div class="product-info__share">
                        Chia sẻ: 
                        <ul class="social_share">
                            <li class="facebook" alt="Chia sẻ facebook"><a href="#" alt="Chia sẻ facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="twitter"><a href="#" alt="Chia sẻ twitter"><i class="fab fa-twitter"></i></a></li>
                            <li class="pinterest"><a href="#" alt="Chia sẻ pinterest"><i class="fab fa-pinterest-p"></i></a></li>
                            <li class="messenger"><a href="#" alt="Copy link"><i class="fas fa-link"></i></a></li>
                        </ul>
                    </div>
                    <div class="product-info__category">
                        <span>Danh mục:</span> <a href="<?=DOMAIN.'/danh-sach-san-pham/?category%5B%5D='.$product['cat_id']?>" target="_blank"><?=$product['cat_name']?></a>
                    </div>
                    <div class="product-info__keyword">
                        <span>Từ khóa:</span> <span><?=$product['keyword']?></span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="product-about">
                <div class="product-tab">
                    <span data-tab="description" class="active">Mô tả sản phẩm</span>
                    <span data-tab="comment" >Bình luận</span>
                    <div class="tabline"></div>
                </div>
                <div class="tab-content product-description" id="description"><?=$product['description']?></div>
                <div class="tab-content product-comment" id="comment">
                    <div class="product-comment__list" id="style-5"></div>
                    <?php if(isset($_SESSION['user'])){?>
                    <form class="comment" id="add-comment">
                        <textarea rows="3" class="input-comment" placeholder="Nhập nội dung bình luận" required></textarea>
                        <button data-id-user="<?=$_SESSION['user']['id']?>" class="comment-btn"><i class="fas fa-reply"></i> Gửi bình luận</button>
                    </form>
                    <?php } else { ?>
                    <div class="box-alert">Vui lòng đăng nhập để bình luận !</div>
                    <?php } ?>
                </div>
            </div>
            <p class="title"><span>Sản Phẩm Liên Quan</span></p>
<?php
    $productCategory = $product['cat_id'];
    $query = "SELECT * FROM products,images WHERE products.cat_id = $productCategory AND products.is_hidden = 0 AND products.product_id = images.product_id AND products.product_id <> $id GROUP BY products.product_id LIMIT 12";
    if(rowCountQuery($query) == 0){
        $query = "SELECT * FROM products, images, categories WHERE products.product_id = images.product_id AND products.is_hidden = 0 AND products.cat_id = categories.cat_id AND categories.cat_active = 1 GROUP BY products.product_id ORDER BY products.product_id DESC LIMIT 12"; 
    }
    $relatedProduct = getQueryValue($query);    
?>
            <div class="list-product" style="overflow: hidden;grid-template-columns:1fr">
            <?php foreach($relatedProduct as $product): ?>
                <a href="/san-pham/<?=slug($product['name']).'.'.$product['product_id'].'.html'?>">
                    <div class="product">
                        <div class="product-image">
                            <img src="<?=DOMAIN?>/assets/img/product/<?=$product['image']?>">
                            <div class="product-button">
                                <button data-id-product="<?=$product['product_id']?>" class="add-to-cart"><i class="fas fa-cart-plus"></i> thêm vào giỏ</button>
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
            <?php } ?>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            <?php if($issetProduct){ ?>
            $('.product-detail__image--thumbnail').slick({
                infinite: true,
                speed: 300,
                autoplay: true,
                cssEase: 'linear',
                mouseDrag:true,
                animateOut: 'slideOutUp',
                autoplaySpeed: 3000,
                slidesToShow: 1,
                adaptiveHeight: true,
            })
            setTitle("<?=$product['name']?> - <?=WEBSITE_NAME?>");
            function activeTab(tab){
                $('.product-tab span').removeClass("active");
                $(tab).addClass("active");
                var id = $(tab).data("tab");
                $('.tab-content').hide();
                $('#' + id).show();
                const tabActive = $('.product-tab span.active');
                const line = $('.product-tab .tabline');
                line.css("left", $(tabActive).position().left + 'px');
                line.css("width", $(tabActive).outerWidth() + 'px');
            }
            $('.product-tab span').click(function(){
                activeTab(this);
                return false;
            });
            activeTab('.product-tab span:first-child');
            $('.list-product').slick({
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
                        slidesToScroll: 1
                    }
                    }
                ]
            });
            function fetchComment(){
                $.ajax({
                    url         : '<?=DOMAIN?>/api/GET/comment/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {get: 'list-comment', id: <?=$id?>},
                    success     : function(data){
                        var xhtml = '';
                        $.each(data, function(index, value){
                            xhtml += `<div class="product-comment__item">
                            <div class="product-comment__item--avatar">
                                <img src="<?=DOMAIN?>/assets/img/avatar/`+ value.avatar +`">
                            </div>
                            <div>
                                <div class="product-comment__item--name">
                                    <span>`+ value.fullname +`</span>
                                    <span>
                                        <span>`+ value.time +`</span>`;
                            <?php if(isset($_SESSION['user'])){ ?>
                                if(value.user_id == <?=$_SESSION['user']['id']?>){
                                    xhtml += `<span data-id-comment="`+ value.cmt_id +`" class="delete-comment" style="margin-left: 10px;"><i class="far fa-trash-alt"></i> Xóa</span>`;
                                }
                            <?php } ?>
                            xhtml +=`</span>
                                </div>
                                <div class="product-comment__item--content">`+ value.content +`</div>
                            </div>
                        </div>`;
                        })
                        if(data.length == 0) xhtml = 'Sản phẩm chưa có bình luận nào !';
                        $('.product-comment__list').html(xhtml);
                        $(".product-comment__list").animate({ scrollTop: $(".product-comment__list").prop("scrollHeight")}, 1000);
                    }
                })
            }
            fetchComment();
            $('textarea').blur(function(){
                if(!/\b/.test($(this).val())){
                    $(this).val('');
                }
            });
            $('.add-cart').click(function(){
                var quantity = $('input[name="quantity"]').val();
                var product = $(this).data('id-product');
                var _this = $(this);
                addToCart(product, _this, quantity);
            })
            $(document).on('submit', '#add-comment', function(e){
                e.preventDefault();
                var user = $('.comment-btn').data("id-user");
                var content = $('.input-comment').val();
                var product = 32;
                $.ajax({
                    url         : '<?=DOMAIN?>/api/MANAGE/comment/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {user: user, product: <?=$id?>, content: content, action: 'add-comment'},
                    beforeSend  : function(){
                        $('.comment-btn').html('<i class="fas fa-spinner fa-spin"></i> Đang bình luận')
                    },
                    success     : function(data){
                        setTimeout(function(){
                            if(data.status == 'success'){
                                fetchComment();
                                toastr["success"]("Gửi bình luận thành công !", "Thành công");
                            } else {
                                toastr["error"]("Bình luận thất bại, vui lòng thử lại !", "Thất bại");
                            }
                        },500)
                    },
                    complete    : function(){
                        setTimeout(function(){
                            $('.input-comment').val('');
                            $('.comment-btn').html('<i class="fas fa-reply"></i> Gửi bình luận')
                        },500)
                    }
                })
            })
            $(document).on('click', '.delete-comment', function(){
                var id = $(this).data('id-comment')
                var alert = confirm('Bạn có chắc chắn muốn xóa bình luận này?')
                if(alert){
                    $.ajax({
                        url         : '<?=DOMAIN?>/api/MANAGE/comment/',
                        type        : 'POST',
                        dataType    : 'json',
                        data        : {id: id, action: 'delete-comment'},
                        success     : function(data){
                            console.log(data)
                            if(data.status == 'success'){
                                toastr["success"]("Xóa thành công !", "Thành công");
                                fetchComment()
                            } else {
                                toastr["error"]("Xóa bình luận thất bại, vui lòng thử lại !", "Thất bại");
                            }
                        }
                    })
                }
            })
            <?php } else { ?>
                $(".product-single.container-custom").addClass("active-page").html("<p>Không tìm thấy sản phẩm ! Vui lòng thử lại.</p><a href='<?=DOMAIN?>/index.php'><button class='readmore'>Về Trang Chủ</button></a>");
            <?php } ?>
        })
    </script>
</body>
</html>