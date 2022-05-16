<?php 
    require_once 'incfiles/head.php';
?>
<div class="wrapper wrapper-content">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Slides</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content ">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            
                        </ol>
                        <div class="carousel-inner">
                            
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Danh Sách Slide</h5>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped vertical-align">
                            <thead>
                                <tr>
                                    <th width="30%">Hình ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Đường dẫn</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="list-slide">
                            </tbody>
                        </table>
                    </div>
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
            function fetchSlide(){
                $.ajax({
                    url         : 'api/GET/slide/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {get: 'list-slide'},
                    success     : function(data){
                        var listSlide = '';
                        var carouselInner = '';
                        var carouselIndicators = '';
                        var i = 0;
                        $.each(data, function(index, value){
                            listSlide += `<tr>
                                                        <td>
                                                            <img class="zoom-img" src="../assets/img/banner/`+ value.slide_image +`" style="max-height: 200px;width: 90%;display: block;object-fit: cover;margin: 0 auto;">
                                                        </td>
                                                        <td>`+ value.slide_title +`</td>
                                                        <td>
                                                            <a href="`+ value.slide_url +`" target="_blank"><input type="text" class="form-control" value="`+ value.slide_url +`" disabled></a>
                                                        </td>
                                                        <td>
                                                            <button type="button" id="remove-slide" data-id-slide="`+ value.slide_id +`" data-name-slide="`+ value.slide_image +`" class="btn btn-danger"><i class="fa fa-trash"></i> </button>
                                                        </td>
                                                    </tr>`;
                            carouselInner += `<div class="carousel-item">
                                <img class="d-block w-100" src="../assets/img/banner/`+ value.slide_image +`" style="max-height: 400px;width: 100%;object-fit:cover">
                                <div class="carousel-caption d-none d-md-block">
                                            <h3>`+ value.slide_title +`</h3>
                                        </div>
                            </div>`;
                            carouselIndicators += `<li data-target="#carouselExampleIndicators" data-slide-to="`+ i +`" class=""></li>`;
                            i++;
                        });
                        $('#list-slide').html(listSlide);
                        $('.carousel-inner').html(carouselInner);
                        $('.carousel-inner>div:first-child').addClass("active");
                        $('.carousel-indicators').html(carouselIndicators);
                        $('.carousel-indicators>li:first-child').addClass("active");
                    }
                });
            }
            fetchSlide();
            // xóa slide
            $(document).on('click', '#remove-slide', function(){
                var id = $(this).data("id-slide");
                var slideName = $(this).data("name-slide");
                swal({
                    title: "Bạn có chắc chắn muốn xóa danh mục này ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    var listSlide = $('#list-slide tr');
                    if(listSlide.length === 1){
                        swal({
                            title: "Lỗi",
                            text: "Phải có 1 slide duy nhất, vui lòng tải thêm slide để xóa slide này !",
                            icon: "error",
                            button: "OK",
                            dangerMode: true
                        });
                    } else {
                        $.ajax({
                           url          : 'api/MANAGE/slide/',
                           type         : 'POST',
                           data         : {action: 'remove-slide', id: id, slide: slideName},
                           dataType     : 'json',
                           success      : function(data){
                            if(data.status == 'success'){
                                swal("Thành công", "Bạn đã xóa thành công", "success");
                                fetchSlide();
                            } else {
                                swal("Thất bại", "Xóa thất bại, vui lòng thử lại", "error");
                            }
                           }
                        });
                    }
                }
                });
            });
        });
    </script>
</body>
</html>