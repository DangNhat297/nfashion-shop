<?php 
    require_once 'incfiles/head.php';
    $sql = "SELECT * FROM information WHERE id = 1";
    $query = $conn->prepare($sql);
    $query->execute();
    $information = $query->fetch(PDO::FETCH_ASSOC);
?>
<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Thông Tin Website</h5>
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
                        <form id="update-information">
                            <div class="form-group row"><label for="website-name" class="col-lg-2 col-form-label">Tên trang web</label>
                            <div class="col-lg-10"><input type="text" value="<?=$information['web_name']?>" name="website-name" id="website-name" placeholder="Nhập tên trang web" class="form-control" required>
                            </div>
                            </div>
                            <div class="form-group row"><label for="website-address" class="col-lg-2 col-form-label">Địa chỉ trang web</label>
                            <div class="col-lg-10"><input type="text" value="<?=$information['address']?>" name="website-address" id="website-address" placeholder="Nhập địa chỉ trang web" class="form-control" required>
                            </div>
                            </div>
                            <div class="form-group row"><label for="website-email" class="col-lg-2 col-form-label">Email trang web</label>
                            <div class="col-lg-10"><input type="email" value="<?=$information['email']?>" name="website-email" id="website-email" placeholder="Nhập email trang web" class="form-control" required>
                            </div>
                            </div>
                            <div class="form-group row"><label for="website-phone" class="col-lg-2 col-form-label">SĐT trang web</label>
                            <div class="col-lg-10"><input type="number" value="<?=$information['phone']?>" name="website-phone" id="website-phone" placeholder="Nhập SĐT trang web" class="form-control" required>
                            </div>
                            </div>
                            <div class="form-group row"><label for="" class="col-lg-2 col-form-label">Logo website</label>
                                <div class="col-lg-10">
                                    <img src="../assets/img/logo/<?=$information['logo']?>" style="width: auto;height: 100px;object-fit:cover">
                                </div>
                            </div>
                            <div class="form-group row"><label for="product-image" class="col-lg-2 col-form-label">Tải logo mới</label>
                            <div class="col-lg-10">
                                <div class="custom-file">
                                    <input id="product-image" type="file" accept=".png, .jpg, .jpeg, .jfif" name="weblogo" class="custom-file-input">
                                    <label for="product-image" class="custom-file-label">Chọn tệp...</label>
                                </div>
                                <span class="form-text error image m-b-none"></span>
                            </div>
                            </div>
                            <div class="form-group row previewimage"><label for="" class="col-lg-2 col-form-label">Xem trước logo website</label>
                                <div class="col-lg-10 preview-image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary" type="submit">Cập nhật</button>
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
                    let $img=jQuery.parseHTML("<img src='' style='width: auto;height: 100px;object-fit:cover;border:1px solid #1ab394'>");
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
            // update information
            $('#update-information').submit(function(e){
                e.preventDefault();
                var data = new FormData(this);
                data.append('action', 'update-information');
                $.ajax({
                    url         : 'api/MANAGE/information/',
                    type        : 'POST',
                    dataType    : 'json',
                    contentType : false,
                    processData : false,
                    data        : data,
                    beforeSend  : function(){
                            $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang cập nhật');
                        },
                    success     : function(data){
                        console.log(data)
                        setTimeout(function(){
                            if(data.status == 'success'){
                                $('button[type="submit"]').html('<i class="fas fa-check"></i> Cập nhật thành công').attr("disabled","disabled");
                                $('input').attr('disabled','disabled');
                                swal("Thành công", "Cập nhật thành công", "success");
                            } else {
                                $.each(data.message, function(index, value){
                                    $('span.error.' + index).html(value);
                                });
                                swal("Thất bại", "Cập nhật thất bại. Vui lòng thử lại", "error");
                                $('button[type="submit"]').html('Cập nhật');
                            }
                        },1000);
                    }
                });
            });
        });
    </script>
</body>
</html>