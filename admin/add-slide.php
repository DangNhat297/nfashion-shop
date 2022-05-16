<?php 
    require_once 'incfiles/head.php';
?>
<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Thêm Slide</h5>
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
                        <form id="add-slide">
                            <div class="form-group row"><label for="slide-title" class="col-lg-2 col-form-label">Tiêu đề</label>
                            <div class="col-lg-10"><input type="text" name="slide-title" id="slide-title" placeholder="Nhập tiêu đề slide..." class="form-control" required>
                            </div>
                            </div>
                            <div class="form-group row"><label for="slide-url" class="col-lg-2 col-form-label">Url</label>
                            <div class="col-lg-10"><input type="text" name="slide-url" id="slide-url" placeholder="Nhập địa chỉ slide..." class="form-control" required>
                            </div>
                            </div>
                            <div class="form-group row"><label for="slide-image" class="col-lg-2 col-form-label">Tải ảnh</label>
                            <div class="col-lg-10">
                                <div class="custom-file">
                                    <input id="slide-image" type="file" accept=".png, .jpg, .jpeg, .jfif" name="slide" class="custom-file-input">
                                    <label for="slide-image" class="custom-file-label">Chọn tệp...</label>
                                </div>
                                <span class="form-text error image m-b-none"></span>
                            </div>
                            </div>
                            <div class="form-group row previewimage"><label for="" class="col-lg-2 col-form-label">Xem trước hình ảnh</label>
                                <div class="col-lg-10 preview-image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary" type="submit">Thêm slide</button>
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
            $("#slide-image").on('change',function(){
                $(".preview-image").empty();//you can remove this code if you want previous user input
                for(let i=0;i<this.files.length;++i){
                    let filereader = new FileReader();
                    let $img=jQuery.parseHTML("<img src='' style='width: auto;height: 200px;object-fit:cover;border:1px solid #1ab394'>");
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
            $('#slide-title').blur(function(){
                if(!/\b/.test($(this).val())){
                    $(this).val('');
                }
            });
            $('#add-slide').submit(function(e){
                e.preventDefault();
                var error = [];
                var data = new FormData(this);
                data.append('action', 'add-slide');
                var slideTitle = data.get('slide-title');
                slideTitle = slideTitle.trim().toLowerCase();
                var arr = slideTitle.split(" ");
                for (var i = 0; i < arr.length; i++) {
                    arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
                }
                slideTitle = arr.join(" ");
                data.set('slide-title', slideTitle);
                if($('#slide-image').get(0).files.length == 0){
                    $('span.error.image').html('Vui lòng tải ảnh lên');
                    error.push('image');
                    $('#slide-image').change(function(){
                        $('span.error.image').html('');
                    });
                }
                if(error.length == 0){
                    $.ajax({
                        url         : 'api/MANAGE/slide/',
                        type        : 'POST',
                        dataType    : 'json',
                        data        : data,
                        contentType : false,
                        processData : false,
                        beforeSend  : function(){
                            $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang thêm');
                        },
                        success     : function(data){
                            setTimeout(function(){
                                if(data.status == 'success'){
                                    $('button[type="submit"]').html('<i class="fas fa-check"></i> Thêm thành công').attr("disabled","disabled");
                                    $('input').attr('disabled','disabled');
                                    swal("Thành công", "Thêm slide thành công", "success");
                                } else {
                                    swal("Thất bại", "Thêm slide thất bại. Vui lòng thử lại", "error");
                                    $('button[type="submit"]').html('Thêm slide');
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