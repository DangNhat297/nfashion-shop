<?php
    require_once 'incfiles/header.php';
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">Thanh Toán</p>
            <div><a href="index.html">Trang Chủ</a> / Thanh Toán</div>
        </div>
        <?php
            if(isset($_SESSION['user'])){
        ?>
        <form id="checkout">
        <div class="checkout-page container-custom">
            <div class="form-checkout-left">
                <p class="title"><span>Thông tin thanh toán</span></p>
                <div class="group-form">
                    <label>Họ và tên *</label>
                    <input type="text" name="fullname" class="form-input " placeholder="Nhập họ và tên..." required>
                </div>
                <div class="group-form row">
                    <div class="group-form">
                        <label>Số điện thoại *</label>
                        <input type="number" name="phone" class="form-input" placeholder="Nhập số điện thoại..." required>
                        <span class="error phone"></span>
                    </div>
                    <div class="group-form">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-input" placeholder="Nhập email..." required>
                    </div>
                </div>
                <div class="group-form">
                    <label>Tỉnh / Thành phố *</label>
                    <select name="select-province" class="form-input" required>
                        <option value="">Chọn tỉnh thành</option>
                    </select>
                </div>
                <div class="group-form">
                    <label>Quận / Huyện *</label>
                    <select name="select-district" class="form-input" required>
                        <option value="">Chọn quận huyện</option>
                    </select>
                </div>
                <div class="group-form">
                    <label>Xã / Phường *</label>
                    <select name="select-ward" class="form-input" required>
                        <option value="">Chọn xã phường</option>
                    </select>
                </div>
                <div class="group-form">
                    <label>Địa chỉ *</label>
                    <input type="text" name="address" class="form-input " placeholder="Số nhà / Tên đường / Thôn">
                </div>
                <div class="group-form">
                    <label>Ghi chú đơn hàng</label>
                    <textarea class="input-comment" name="note" rows="5" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."></textarea>
                </div>
                <input type="text" name="province" hidden>
                <input type="text" name="district" hidden>
                <input type="text" name="ward" hidden>
            </div>
            <div class="checkout-right">
                <p class="title"><span>Đơn hàng của bạn</span></p>
                <table class="check-out">
                    <thead>
                        <tr>
                            <th>Sản Phẩm</th>
                            <th>Tạm tính</th>
                        </tr>
                    </thead>
                    <tbody id="list-cart-checkout">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Tổng</th>
                            <th>0đ</th>
                        </tr>
                    </tfoot>
                </table>
                <input type="radio" id="ship-delivery" checked/><label for="ship-delivery">Trả tiền mặt khi nhận hàng</label>
                <button type="submit" class="buynow">Đặt hàng</button>
                <p>Dữ liệu cá nhân của bạn sẽ được sử dụng để xử lý đơn đặt hàng, hỗ trợ trải nghiệm của bạn trên toàn bộ trang web này và cho các mục đích khác được mô tả trong chính sách riêng tư.</p>
            </div>
        </div>
        </form>
        <?php } else { ?>
            <div class="active-page">Vui lòng <a href="<?=DOMAIN?>/dang-nhap/">đăng nhập</a> hoặc <a href="<?=DOMAIN?>/dang-ky/">đăng ký</a> để tiến hành thanh toán</div>
        <?php } ?>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            $('input').blur(function(){
                if(!/\b/.test($(this).val())){
                    $(this).val('');
                }
            });
            $('li.cart').hide();
            setTitle("Thanh Toán");
            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'token': '7d39926f-24bd-11ec-b268-d64e67bb39ee'
                },
                type: "GET",
                dataType: "json",
                success: function (result) {
                    var xhtml = '<option value="">Chọn tỉnh thành</option>';
                    $.each(result.data, function(index, value){
                        xhtml += '<option value="'+ value.ProvinceID +'">'+ value.ProvinceName +'</option>'
                    })
                    $('select[name="select-province"]').html(xhtml)
                }
            })
            $(document).on('change', 'select[name="select-province"]', function(){
                $('input[name=province]').val($('select[name="select-province"]').find(':selected').text());
                var provinceID = $(this).val();
                var $this = $('select[name="select-district"]');
                $.ajax({
                    url         : 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
                    headers     : {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'token': '7d39926f-24bd-11ec-b268-d64e67bb39ee',
                    },
                    data        : {"province_id" : provinceID},
                    type        : "GET",
                    dataType    : "json",
                    success     : function (result) {
                        var xhtml = '<option value="">Chọn quận huyện</option>';
                        $.each(result.data, function(index, value){
                            xhtml += '<option value="'+ value.DistrictID +'">'+ value.DistrictName +'</option>'
                        })
                        $this.html(xhtml)
                        $('select[name="select-ward"]').html('<option>Chọn xã phường</option>')
                    }
                })
            })
            $(document).on('change', 'select[name="select-district"]', function(){
                $('input[name=district]').val($('select[name="select-district"]').find(':selected').text());
                var districtID = $(this).val();
                var $this = $('select[name="select-ward"]');
                $.ajax({
                    url         : 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'token': '7d39926f-24bd-11ec-b268-d64e67bb39ee',
                    },
                    data        : {"district_id" : districtID},
                    type        : "GET",
                    dataType    : "json",
                    success     : function (result) {
                        var xhtml = '<option value="">Chọn xã phường</option>';
                        $.each(result.data, function(index, value){
                            xhtml += '<option value="'+ value.WardCode +'">'+ value.WardName +'</option>'
                        })
                        $this.html(xhtml)
                    }
                })
            })
            $(document).on('change', 'select[name="select-ward"]', function(){
                $('input[name=ward]').val($('select[name="select-ward"]').find(':selected').text());
            })
            $.ajax({
                url         : '<?=DOMAIN?>/api/GET/cart/',
                type        : 'POST',
                dataType    : 'json',
                data        : {get: 'list-cart'},
                success     : function(data){
                    var xhtml = '';
                    if(data.detail.length == 0){
                        $('.checkout-page').find('*').hide();
                        $('.checkout-page').addClass('active-page').removeClass('checkout-page').html('<p>Bạn chưa có sản phẩm nào trong giỏ hàng.</p><a href="<?=DOMAIN?>/trang-chu.html"><button type="button" class="readmore">Về Trang Chủ</button></a>');
                    }
                    $.each(data.detail, function(index, value){
                        xhtml += `<tr>
                            <td>`+ value.name +` <span style="color:var(--blue)">x  `+ value.quantity +`</span></td>
                            <td>`+ value.total +`</td>
                        </tr>`
                    })
                    $('#list-cart-checkout').html(xhtml)
                    $('tfoot tr th:last-child').html(data.sum)
                }
            })
            $(document).on('submit', '#checkout', function(e){
                e.preventDefault()
                $('span.error').html('')
                var data = new FormData(this)
                data.append('action', 'checkout')
                var error = []
                var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                var numberPhone = data.get('phone')
                if (vnf_regex.test(numberPhone) == false) {
                    error.push('phone')
                    $('span.error.phone').html('Vui lòng nhập số điện thoại hợp lệ !');
                }
                if(error.length == 0){
                    $.ajax({
                        url         : '<?=DOMAIN?>/api/MANAGE/checkout/',
                        type        : 'POST',
                        data        : data,
                        dataType    : 'json',
                        processData : false,
                        contentType : false,
                        beforeSend  : function(){
                            $('.buynow').html('<i class="fas fa-spinner fa-spin"></i> Đang tiến hành')
                        },
                        success     : function(data){
                            setTimeout(function(){
                                if(data.status == 'success'){
                                    toastr["success"]("Đặt hàng thành công !", "Thành công");
                                    $('input, textarea, select').attr('disabled', 'disabled')
                                    $('.buynow').html('<i class="fas fa-check-double"></i> Đặt hàng thành công').attr('disabled', 'disabled')
                                    $('.buynow').next().text('Cảm ơn quý khách đã ủng hộ cửa hàng. Chúc quý khách thật nhiều sức khỏe !')
                                    $('.buynow').after('<a href="<?=DOMAIN?>/danh-sach-san-pham/"><button type="button" class="readmore">Tiếp Tục Mua Sắm</button></a>')
                                    $('.buynow').next('a').slideDown('slow')
                                } else {
                                    $('.buynow').html('Đặt hàng')
                                    toastr["error"]("Đặt hàng thất bại, vui lòng kiểm tra lại !", "Thất bại");
                                }
                            },2000)
                        }
                    })
                }
            })
        })
    </script>
</body>
</html>