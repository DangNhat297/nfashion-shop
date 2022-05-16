$(document).ready(function(){
    $('.form-search').hide();
    $('.icon-search').click(function(){
        $('.form-search').slideToggle("slow");
    });
    $('.close-form').click(function(){
        $('.form-search').slideUp("slow");
    });
    // setInterval(function (){
    //     var now = new Date();
    //     var hour = now.getHours();
    //     var minute = now.getMinutes();
    //     var second = now.getSeconds();
    //     if(hour < 10) hour = '0' + hour;
    //     if(minute < 10) minute = '0' + minute;
    //     if(second < 10) second = '0' + second;
    //     $('.time.hour').text(hour)
    //     $('.time.minute').text(minute);
    //     $('.time.second').text(second);
    // }, 1000);
    function quantityProduct(){
        $('.btn-quantity.sub').click(function(){
            var input = parseInt($('input.btn-quantity').val());
            $('input.btn-quantity').val(input-1);
            if(input <= 1) $('input.btn-quantity').val(1);
        });
        $('.btn-quantity.add').click(function(){
            var input = parseInt($('input.btn-quantity').val());
            $('input.btn-quantity').val(input+1);
        });
    }
    quantityProduct();
    function cartQuantity(){
        $(document).on('click', '.cart-quantity__button.sub', function(){
            var input = parseInt($(this).next().val());
            $(this).next().val(input-1);
            if(input <= 1) $(this).next().val(1);
            $(this).next().change();
        })
        $(document).on('click', '.cart-quantity__button.add', function(){
            var input = parseInt($(this).prev().val());
            $(this).prev().val(input+1).change();
        })
    }
    cartQuantity()
    $('.category-search').find('input').keyup(function(){
        var _this = $(this);
        $('.category-list__item').each(function(index, value){
            if($(value).text().toLowerCase().trim().includes($(_this).val().toLowerCase().trim())){
                $(value).show();
            } else {
                $(value).hide();
            }
        });
    });
    function shareSocial(){
        var currentLocation = window.location;
        $('.facebook').find('a').attr("href", "https://www.facebook.com/sharer/sharer.php?u=" + currentLocation);
        $('.twitter').find('a').attr("href", "https://twitter.com/share?url=" + currentLocation);
        $('.pinterest').find('a').attr("href", "https://pinterest.com/pin/create/link/?url=" + currentLocation);
        $('.messenger').find('a').click(function(){
            var dummy = document.createElement('input'),
            text = window.location.href;
            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);
            $(this).parent().after('<span>Đã sao chép url vào bộ nhớ tạm!</span>');
            setTimeout(function(){
                $('.messenger').find('a').parent().next().fadeOut(300, function(){
                    $(this).remove();
                });
            },2000);
            return false;
        });
    }
    shareSocial();
    $('.social_share').find('li:not(:last-child)').find('a').click(function(){
        window.open(this.href);
        return false;
    });
    $('.product-button button:first-child').click(false);
    $('.togglepass').click(function(){
        $(this).toggleClass('show');
        if($(this).hasClass('show')){
            $(this).prev().attr('type','text');
        } else {
            $(this).prev().attr('type','password');
        }
    });
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.label-file-custom').html('<i class="fas fa-file-upload"></i> ' + fileName);
    }); 
    $('.output-image').hide();
    // $('.range').css('background-size', $('.range').val() + '%');
    // $('.range').mousemove(function(){
    //     var rangeValue = $('.range').val();
    //     $('.range').css('background-size', rangeValue + '%');
    // });
    $('.filter-category-search').find('input').keyup(function(){
        var _this = $(this);
        $('.filter-category__item label').each(function(index, value){
            if($(value).text().toLowerCase().trim().includes($(_this).val().toLowerCase().trim())){
                $(value).parent().show();
            } else {
                $(value).parent().hide();
            }
        });
    });
    // // zoom image
    // $('.product-detail__image--thumbnail img').css({cursor: 'pointer'}).on('click', function () {
    //     var img = $(this);
    //     var bigImg = $('<img />').css({
    //     'max-width': '50%',
    //     'max-height': '100%',
    //     'display': 'inline'
    //     });
    //     bigImg.attr({
    //     src: img.attr('src'),
    //     alt: img.attr('alt'),
    //     title: img.attr('title')
    //     });
    //     var over = $('<div />').text(' ').css({
    //     'height': '100%',
    //     'width': '100%',
    //     'background': 'rgba(0,0,0,.82)',
    //     'position': 'fixed',
    //     'top': 0,
    //     'left': 0,
    //     'opacity': 0.0,
    //     'cursor': 'pointer',
    //     'z-index': 9999,
    //     'text-align': 'center'
    //     }).append(bigImg).bind('click', function () {
    //     $(this).fadeOut(300, function () {
    //         $(this).remove();
    //     });
    //     }).insertAfter(this).animate({
    //     'opacity': 1
    //     }, 300);
    // });
    // $('.dropdown').click(function(e){
    //     e.preventDefault();
    //     $(this).find('.dropdown-list').toggleClass('show')
    // })
    // $('.cart').click(function(){
    //     $(this).find('.cart-list').toggleClass('show')
    // })
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 1000) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
});
function loadFile(event){
    $('.output-image').show();
    $('.output-image').attr('src', URL.createObjectURL(event.target.files[0]));
}