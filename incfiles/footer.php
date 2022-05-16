<footer>
    <?php
        if($fileCurrent == 'recovery-password.php' || $fileCurrent == 'forgotpassword.php' || $fileCurrent == 'login.php' || $fileCurrent == 'register.php' || $fileCurrent == 'change-password.php' || $fileCurrent == 'profile.php'){
            echo '<div class="custom-shape-divider-bottom-1632297820">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                    </svg>
                </div>';
        }
    ?>
        <div class="container-custom footer">
            <div class="column">
                <img src="<?=DOMAIN?>/assets/img/logo/<?=WEBSITE_LOGO?>" class="f-logo">
                <ul class="f-infomation">
                    <li><i class="fas fa-map-marker-alt"></i> <span>Địa chỉ: <?=WEBSITE_ADDRESS?></span></li>
                    <li><i class="fas fa-phone-alt"></i> <span>Số điện thoại: <?=WEBSITE_PHONE?></span></li>
                    <li><i class="far fa-envelope-open"></i> <span>Email: <?=WEBSITE_EMAIL?></span></li>
                </ul>
                <ul class="social_share">
                    <li class="facebook" alt="Chia sẻ facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=http://duanmau.pro/san-pham/ao-phong-oversized-un-black-panther-marvel-boozilla.21.html" alt="Chia sẻ facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="twitter"><a href="https://twitter.com/share?url=http://duanmau.pro/san-pham/ao-phong-oversized-un-black-panther-marvel-boozilla.21.html" alt="Chia sẻ twitter"><i class="fab fa-twitter"></i></a></li>
                    <li class="pinterest"><a href="https://pinterest.com/pin/create/link/?url=http://duanmau.pro/san-pham/ao-phong-oversized-un-black-panther-marvel-boozilla.21.html" alt="Chia sẻ pinterest"><i class="fab fa-pinterest-p"></i></a></li>
                    <li class="messenger"><a href="#" alt="Copy link"><i class="fas fa-link"></i></a></li>
                </ul>
            </div>
            <div class="column">
                <input type="checkbox" id="footer-show-1" hidden>
                <div class="column-title"><label for="footer-show-1">Cửa Hàng <i class="fas fa-angle-right"></i></label></div>
                <ul class="f-link">
                    <li><a href="/trang-chu.html">Trang Chủ</a></li>
                    <li><a href="/danh-sach-san-pham/">Sản Phẩm</a></li>
                    <li><a href="/gioi-thieu/">Giới Thiệu</a></li>
                    <li><a href="/lien-he/">Liên hệ</a></li>
                </ul>
            </div>
            <div class="column">
                <div class="column-title"><label>Bản Đồ</label></div>
                <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8638558814037!2d105.74459841440749!3d21.038132792835356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1633792030119!5m2!1svi!2s" width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </footer>
    <div id="scroll"><span><i class="fas fa-angle-up"></i></span></div>
    <!-- loading animation -->
    <script type='text/javascript'>
        //<![CDATA[
        var Nanobar=function(){var c,d,e,f,g,h,k={width:"100%",height:"4px",zIndex:9999,top:"0"},l={width:0,height:"100%",clear:"both",transition:"height .3s"};c=function(a,b){for(var c in b)a.style[c]=b[c];a.style["float"]="left"};f=function(){var a=this,b=this.width-this.here;0.1>b&&-0.1<b?(g.call(this,this.here),this.moving=!1,100==this.width&&(this.el.style.height=0,setTimeout(function(){a.cont.el.removeChild(a.el)},100))):(g.call(this,this.width-b/4),setTimeout(function(){a.go()},16))};g=function(a){this.width=a;this.el.style.width=this.width+"%"};h=function(){var a=new d(this);this.bars.unshift(a)};d=function(a){this.el=document.createElement("div");this.el.style.backgroundColor=a.opts.bg;this.here=this.width=0;this.moving=!1;this.cont=a;c(this.el,l);a.el.appendChild(this.el)};d.prototype.go=function(a){a?(this.here=a,this.moving||(this.moving=!0,f.call(this))):this.moving&&f.call(this)};e=function(a){a=this.opts=a||{};var b;a.bg=a.bg||"#2a9daf";this.bars=[];b=this.el=document.createElement("div");c(this.el,k);a.id&&(b.id=a.id);b.style.position=a.target?"relative":"fixed";a.target?a.target.insertBefore(b,a.target.firstChild):document.getElementsByTagName("body")[0].appendChild(b);h.call(this)};e.prototype.go=function(a){this.bars[0].go(a);100==a&&h.call(this)};return e}();var nanobar = new Nanobar();nanobar.go(30);nanobar.go(60);nanobar.go(100);
        //]]>
    </script>
    <!-- end loading -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="<?=DOMAIN?>/assets/js/app.js?random=<?=randomStr()?>"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        function setTitle(text) {
        document.title = text;
        }
        function getCart(){
            $.ajax({
                url         : '<?=DOMAIN?>/api/GET/cart/',
                type        : 'POST',
                dataType    : 'json',
                timeout     : 500,
                data        : {get: 'list-cart'},
                success     : function(data){
                    var xhtml = '';
                    if(data.detail.length > 0){
                        $.each(data.detail, function(index, value){
                            xhtml += `<div class="cart-list__item">
                                        <div class="cart-item__image">
                                            <img src="<?=DOMAIN?>/assets/img/product/`+ value.image +`">
                                        </div>
                                        <div class="cart-item__detail">
                                            <div class="cart-item__name">`+ value.name +`</div>
                                            <div class="cart-item__quantity">
                                                X <span>`+ value.quantity +`</span>
                                            </div>
                                            <div class="cart-item__price">`+ value.total +`</div>
                                        </div>
                                        <div class="cart-item__remove" data-id-product="`+ value.id +`"><i class="fas fa-trash-alt"></i></div>
                                    </div>`;
                        })
                        $('.cart-list__total-price, .cart-list__button').show();
                        $('.cart-list__total-price span:last-child').html(data.sum);
                    } else {
                        $('.cart-list__total-price, .cart-list__button').hide();
                        xhtml = '<p style="text-align:center;padding: 20px;">Giỏ hàng của bạn đang trống</p>';
                    }
                    $('.cart-list__body').html(xhtml);
                }
            })
        }
        function addToCart(productID, elementBtn, quantity = 1){
            $.ajax({
                url         : '<?=DOMAIN?>/api/MANAGE/cart/',
                type        : 'POST',
                data        : {id: productID, quantity: quantity, action: 'add-to-cart'},
                dataType    : 'json',
                beforeSend  : function(){
                    $(elementBtn).html('<i class="fas fa-circle-notch fa-spin"></i> Đang thêm');
                },
                success     : function(data){
                    setTimeout(function(){
                        if(data.status == 'success'){
                            getCart()
                            toastr["success"]("Thêm sản phẩm vào giỏ hàng thành công !", "Thành công");
                        } else {
                            toastr["error"]("Thêm vào giỏ hàng thất bại, vui lòng kiểm tra lại!", "Thất bại");
                        }
                    },1000)
                },
                complete    : function(){
                    setTimeout(function(){
                        $(elementBtn).html('<i class="fas fa-cart-plus"></i> Thêm Vào Giỏ');
                    },1000)
                }
            })
        }
        $('.add-to-cart').click(function(){
            var _this = $(this);
            var product = $(this).data('id-product');
            addToCart(product, _this);
        })
        getCart();
        $(document).on('click', '.cart-item__remove', function(){
            var id = $(this).data('id-product');
            $.ajax({
                url         : '<?=DOMAIN?>/api/MANAGE/cart/',
                type        : 'POST',
                data        : {id: id, action: 'delete-cart-product'},
                dataType    : 'json',
                success     : function(data){
                    if(data.status == 'success'){
                        getCart();
                    } else {
                        toastr["error"]("Xóa thất bại, vui lòng thử lại !", "Thất bại");
                    }
                }
            })
        })
    </script>
