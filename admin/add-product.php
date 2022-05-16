<?php 
    require_once 'incfiles/head.php';
    $sql = "SELECT * FROM categories WHERE cat_active = 1";
    $query = $conn->prepare($sql);
    $query->execute();
    $categories = $query->fetchAll();
?>
<div class="wrapper wrapper-content">
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Thêm Sản Phẩm</h5>
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
                            <form id="add-product">
                                <div class="form-group row"><label for="product-name" class="col-lg-2 col-form-label">Tên sản phẩm</label>
                                <div class="col-lg-10"><input type="text" name="product-name" id="product-name" placeholder="Nhập tên sản phẩm" class="form-control" required>
                                <span class="form-text error name m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="product-price" class="col-lg-2 col-form-label">Giá sản phẩm</label>
                                <div class="col-lg-10"><input type="number" name="product-price" id="product-price" placeholder="Nhập giá sản phẩm..." class="form-control" required>
                                <span class="form-text error price m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="product-discount" class="col-lg-2 col-form-label">% Giảm giá</label>
                                <div class="col-lg-10"><input type="number" value="0" name="product-discount" min="0" max="100" id="product-discount" placeholder="Nhập % giám giá... " class="form-control" required>
                                <span class="form-text error discount m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="product-special" class="col-lg-2 col-form-label">Hàng đặc biệt</label>
                                <div class="col-lg-10">
                                    <div class="form-check abc-radio abc-radio-info form-check-inline">
                                        <input class="form-check-input" type="radio" id="inlineRadio1" value="0" name="product-special" checked="">
                                        <label class="form-check-label" for="inlineRadio1"> Bình thường </label>
                                    </div>
                                    <div class="form-check abc-radio abc-radio-info form-check-inline">
                                        <input class="form-check-input" type="radio" id="inlineRadio2" value="1" name="product-special">
                                        <label class="form-check-label" for="inlineRadio2"> Đặc biệt </label>
                                    </div>
                                <span class="form-text error special m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="product-category" class="col-lg-2 col-form-label">Danh mục</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-b" id="product-category" name="product-category">
                                        <option selected disabled>Chọn danh mục</option>
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?=$category['cat_id']?>"><?=$category['cat_name']?></option>
                                        <?php endforeach ?>
                                    </select>
                                <span class="form-text error category m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="product-keyword" class="col-lg-2 col-form-label">Từ khóa</label>
                                <div class="col-lg-10">
                                    <input id="product-keyword" name="product-keyword" value="nfashion,fashion,thời trang,quần áo," class="tagsinput form-control" data-role="tagsinput" placeholder="Từ khóa sản phẩm...">
                                <span class="form-text error description m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="product-description" class="col-lg-2 col-form-label">Mô tả</label>
                                <div class="col-lg-10">
                                    <textarea id="productdescription" name="product-description" class="form-control" placeholder="Mô tả sản phẩm..."></textarea>
                                <span class="form-text error description m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="product-image" class="col-lg-2 col-form-label">Ảnh sản phẩm</label>
                                <div class="col-lg-10">
                                    <div class="custom-file">
                                        <input id="product-image" type="file" accept=".png, .jpg, .jpeg, .jfif" name="fileimg[]" class="custom-file-input" multiple>
                                        <label for="product-image" class="custom-file-label">Choose file...</label>
                                    </div>
                                    <span class="form-text error image m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row previewimage"><label for="" class="col-lg-2 col-form-label">Ảnh sản phẩm</label>
                                    <div class="col-lg-10 preview-image"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary" type="submit">Thêm sản phẩm</button>
                                        <a href="list-product.php"><button type="button" class="btn btn-sm btn-success">Danh sách sản phẩm</button></a>
                                    </div>
                                </div>
                            </form>
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
            // preview image
            $('.previewimage').hide();
            $("#product-image").on('change',function(){
                $(".preview-image").empty();//you can remove this code if you want previous user input
                for(let i=0;i<this.files.length;++i){
                    let filereader = new FileReader();
                    let $img=jQuery.parseHTML("<img src='' style='width: 130px;height: 140px;object-fit:cover;border:1px solid #1ab394'>");
                    filereader.onload = function(){
                        $img[0].src=this.result;
                    };
                    filereader.readAsDataURL(this.files[i]);
                    $(".preview-image").append($img);
                }
            });
            // xử lý preview image
            $('.custom-file-input').on('change', function() {
                $(this).next('.custom-file-label').addClass("selected").html('Đã tải lên ' + this.files.length + ' tệp');
                if(this.files.length === 0){
                    $('.previewimage').hide();
                } else {
                    $('.previewimage').show();
                }
            }); 
            // tags input
            $('.tagsinput').tagsinput({
                tagClass: 'label label-primary',
                trimValue: true
            });
            // ck editor
            CKEDITOR.editorConfig = function( config ){
                config.allowedContent = {
                    $1: {
                        // Use the ability to specify elements as an object.
                        elements: CKEDITOR.dtd,
                        attributes: true,
                        styles: true,
                        classes: true
                    }
                };
                config.disallowedContent = 'script; *[on*]';
            }
            CKEDITOR.replace('productdescription');
            $('#product-name').blur(function(){
                if(!/\b/.test($(this).val())){
                    $(this).val('');
                }
            });
            $('#add-product').submit(function(e){
                e.preventDefault();
                $('span.error').html('');
                var error = [];
                var data = new FormData(this);
                data.append('action', 'add-product');
                var dataDescription = CKEDITOR.instances.productdescription.getData();
                dataDescription = dataDescription.replaceAll(/(script|onclick)/ig,'');
                data.set('product-description', dataDescription);
                if(!data.get('product-category')){
                    $('span.error.category').html('Vui lòng chọn danh mục');
                    error.push('category');
                    $('#product-category').change(function(){
                        $('span.error.category').html('');
                    });
                }
                if($('#product-image').get(0).files.length == 0){
                    $('span.error.image').html('Vui lòng tải ảnh lên');
                    error.push('image');
                    $('#product-image').change(function(){
                        $('span.error.image').html('');
                    });
                }
                if(/-/.test($('#product-price').val())){
                    $('span.error.price').html('Nhập sai giá, không được là số âm');
                    error.push('price');
                    $('#product-price').change(function(){
                        $('span.error.price').html('');
                    });
                }
                var productName = data.get('product-name');
                productName = productName.trim().toLowerCase();
                var arr = productName.split(" ");
                for (var i = 0; i < arr.length; i++) {
                    arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
                }
                productName = arr.join(" ");
                data.set('product-name', productName);
                if(error.length == 0){
                    $.ajax({
                        url         : 'api/MANAGE/product/',
                        type        : 'POST',
                        data        : data,
                        contentType : false,
                        processData : false,
                        dataType    : 'json',
                        beforeSend  : function(){
                            $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang thêm');
                        },
                        success     : function(data){
                            console.log(data);
                            setTimeout(function(){
                                if(data.status == 'success'){
                                    $('button[type="submit"]').html('<i class="fas fa-check"></i> Thêm thành công').attr("disabled","disabled");
                                    $('input').attr('disabled','disabled');
                                    swal("Thành công", "Thêm sản phẩm thành công", "success");
                                    setTimeout(function(){
                                        window.location.href="";
                                    },1000);
                                } else {
                                    $.each(data.message, function(index, value){
                                        $('span.error.' + index).html(value);
                                    });
                                    swal("Thất bại", "Thêm sản phẩm thất bại. Vui lòng thử lại", "error");
                                    $('button[type="submit"]').html('Thêm sản phẩm');
                                }
                            },1000);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>