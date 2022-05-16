<?php 
    require_once 'incfiles/head.php';
?>
<div class="wrapper wrapper-content">
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Thêm Danh Mục Sản Phẩm</h5>
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
                            <form id="add-category">
                                <div class="form-group row"><label for="category" class="col-lg-2 col-form-label">Danh mục</label>
                                <div class="col-lg-10"><input type="text" id="category" placeholder="Nhập tên danh mục..." class="form-control" required>
                                <span class="form-text error category m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-primary" type="submit">Thêm danh mục</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Danh Mục Sản Phẩm</h5>
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
                            <input type="text" class="form-control form-control-sm m-b-xs" id="search-category" placeholder="Tìm kiếm danh mục...">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th width="10%">Chọn</th>
                                    <th>Tên danh mục</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody id="list_category">
                                </tbody>
                            </table>
                        </div>
                        <div class="ibox-footer">
                        <span class="form-text number-category m-b-none"></span>
                            <button type="button" class="btn btn-w-m btn-success select-all">Chọn tất cả</button>
                            <button type="button" class="btn btn-w-m btn-primary unselect-all">Bỏ chọn</button>
                            <button type="button" class="btn btn-w-m btn-warning cancel-all">Ngừng kinh doanh các mặt hàng</button>
                            <!--<button type="button" class="btn btn-w-m btn-danger remove-all">Xóa tất cả</button>-->
                        </div>
                    </div>
                </div>
                <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content animated bounceInRight">
                    <form id="update-category">
                        <div class="modal-body">
                                <div class="form-group row"><label for="category-name" class="col-lg-2 col-form-label">Tên danh mục</label>
                                <div class="col-lg-10"><input type="text" name="category-name" id="category-name" placeholder="Nhập tên danh mục" class="form-control" required>
                                <span class="form-text errormodal category m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="product-special" class="col-lg-2 col-form-label">Hàng đặc biệt</label>
                                <div class="col-lg-10">
                                    <div class="form-check abc-radio abc-radio-info form-check-inline">
                                        <input class="form-check-input" type="radio" id="inlineRadio1" value="1" name="category-active" checked="">
                                        <label class="form-check-label" for="inlineRadio1"> Đang kinh doanh </label>
                                    </div>
                                    <div class="form-check abc-radio abc-radio-info form-check-inline">
                                        <input class="form-check-input" type="radio" id="inlineRadio2" value="0" name="category-active">
                                        <label class="form-check-label" for="inlineRadio2"> Ngừng kinh doanh </label>
                                    </div>
                                <span class="form-text error special m-b-none"></span>
                                </div>
                                </div>
                                <div class="form-group row"><label for="createdat" class="col-lg-2 col-form-label">Ngày tạo</label>
                                <div class="col-lg-10"><input type="text" id="createdat" placeholder="Ngày tạo" class="form-control" disabled>
                                </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                            <input type="hidden" name="id">
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
        // hàm get data list category
        function fetchData(){
            $.ajax({
                url         : 'api/GET/category/',
                type        : 'POST',
                data        : {get: 'table'},
                success     : function(data){
                    $('#list_category').html(data);
                    var lengthItem = $('#list_category tr').length;
                    $('span.number-category').text('Có tất cả ' + lengthItem + ' danh mục');
                    $('[data-popover="popover"]').popover();
                    if(lengthItem == 0){
                        $('.ibox-footer').hide();
                        $('#search-category').hide();
                    } else {
                        $('.ibox-footer').show();
                        $('#search-category').show();
                    }
                }
            });
        }
        fetchData();
        // xử lý thêm danh mục
        $('#add-category').submit(function(e){
            e.preventDefault();
            var category = $('input#category').val();
            category.trim();
            var arr = category.split(" ");
            for (var i = 0; i < arr.length; i++) {
                arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
            }
            category = arr.join(" ");
            $.ajax({
                url         : 'api/MANAGE/category/',
                type        : 'POST',
                dataType    : 'json',
                data        : {category: category, action: 'add'},
                beforeSend  : function(){
                    $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang thêm');
                },
                success     : function(data){
                    setTimeout(function(){
                        if(data.status == 'success'){
                            swal("Thành công", "Thêm danh mục thành công", "success");
                            fetchData();
                        } else {
                            $.each(data.message, function(index, value){
                                $('span.error.' + index).html(value);
                            });
                            swal("Thất bại", "Thêm thất bại. Vui lòng thử lại", "error");
                        }
                    },1000);
                },
                complete    : function(){
                    setTimeout(function(){
                        $('button[type="submit"]').html('Thêm danh mục');
                        $('input#category').val('');
                    },1000);
                }
            });
        });
        // tìm kiếm danh mục 
        $(document).on('keyup', '#search-category', function(){
            var _this = $(this);
            $('#list_category tr').each(function(index, value){
                if($(value).find("td:eq(1)").text().toLowerCase().includes($(_this).val().trim().toLowerCase())){
                    $(value).show();
                } else {
                    $(value).hide();
                }
            });
        });
        // xử lý truyền dữ liệu vào modal sửa danh mục
        $(document).on('click', '#editcategory', function(){
            $('.modal input').removeAttr("disabled");
            $('.modal button[type="submit"]').removeAttr("disabled");
            $('#createdat').attr("disabled", "disabled");
            $('#myModal button[type="submit"]').html('Cập nhật');
            var category = $(this).data('id-category');
            $.ajax({
                url         : 'api/GET/category/',
                type        : 'POST',
                data        : {get: 'category', category: category},
                dataType    : 'json',
                success     : function(data){
                    $('.modal input[name="category-name"]').val(data.cat_name);
                    $('.modal input:radio[name="category-active"][value="'+ data.cat_active +'"]').prop('checked', true);
                    $('#createdat').val(data.created_at);
                    $('.modal input[name="id"]').val(data.cat_id);
                }
            });
        });
        // xử lý xóa danh mục
        // $(document).on('click', '#delcategory', function(){
        //     var category = $(this).data("id-category");
        //     swal({
        //         title: "Bạn có chắc chắn muốn xóa mặt hàng này ?",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //     .then((willDelete) => {
        //     if (willDelete) {
        //         $.ajax({
        //         url         : 'api/MANAGE/category/',
        //         type        : 'POST',
        //         data        : {category: category, action: 'remove'},
        //         dataType    : 'json',
        //         success     : function(data){
        //                 if(data.status == 'success'){
        //                     swal("Thành công", "Bạn đã xóa danh mục thành công", "success");
        //                     fetchData();
        //                 } else {
        //                     swal("Thất bại", "Xóa hất bại, vui lòng thử lại", "error");
        //                 }
        //             }
        //         });
        //     }
        //     });
        // });
        // xử lý ngừng kinh doanh danh mục
        $(document).on('click', '#cancel-category', function(){
            var category = $(this).data("id-category");
            swal({
                title: "Bạn có chắc chắn muốn ngừng kinh doanh mặt hàng này ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                url         : 'api/MANAGE/category/',
                type        : 'POST',
                data        : {category: category, action: 'cancel-active'},
                dataType    : 'json',
                success     : function(data){
                        if(data.status == 'success'){
                            swal("Thành công", "Bạn đã ngừng kinh doanh thành công", "success");
                            fetchData();
                        } else {
                            swal("Thất bại", "Thất bại, vui lòng thử lại", "error");
                        }
                    }
                });
            }
            });
        });
        // xử lý cập nhật danh mục
        $('#update-category').submit(function(e){
            $('span.errormodal').html('');
            e.preventDefault();
            var data = new FormData(this);
            data.append('action', 'update');
            var category = data.get('category-name');
            category.trim();
            var arr = category.split(" ");
            for (var i = 0; i < arr.length; i++) {
                arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
            }
            category = arr.join(" ");
            data.set('category-name', category);
            $.ajax({
                url         : 'api/MANAGE/category/',
                type        : 'POST',
                data        : data,
                contentType : false,
                processData : false,
                dataType    : 'json',
                beforeSend  : function(){
                    $('.modal-footer button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang cập nhật');
                },
                success     : function(data){
                    console.log(data);
                    setTimeout(function(){
                        if(data.status == 'success'){
                            $('#myModal button[type="submit"]').html('<i class="fas fa-check"></i> Đã cập nhật').attr("disabled", "disabled");
                            swal("Thành công","Cập nhật thành công","success");
                            $('.modal input').attr("disabled", "disabled");
                            fetchData();
                        } else {
                            $('#myModal button[type="submit"]').html('Cập nhật');
                            swal("Thất bại","Cập nhật thất bại, vui lòng thử lại","error");
                            $.each(data.message, function(index, value){
                                $('span.errormodal.' + index).html(value);
                            });
                        }
                    },1000);
                }
            });
        });
        // ngừng kinh doanh tất cả mục đã chọn
        $(document).on('click', '.cancel-all', function(){
            swal({
                title: "Bạn có chắc chắn muốn ngừng kinh doanh các mặt hàng này ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                var arr = [];
                $('.custom-checkbox-input').each(function(index, value){
                    if($(value).is(':checked')){
                        arr.push($(value).val());
                    }
                });
                if(arr.length === 0){
                    swal({
                        title: "Lỗi",
                        text: "Bạn chưa chọn mục để ngừng kinh doanh, vui lòng thử lại !",
                        icon: "error",
                        button: "OK",
                        dangerMode: true
                    });
                } else {
                    $.ajax({
                        url         : 'api/MANAGE/category/',
                        type        : 'POST',
                        dataType    : 'json',
                        data        : {categories: arr, action: 'cancel-all'},
                        beforeSend  : function(){
                            $('.cancel-all').html('<i class="fas fa-circle-notch fa-spin"></i> Đang xử lý');
                        },
                        success     : function(data){
                            setTimeout(function(){
                                if(data.status == 'success'){
                                    swal("Thành công", "Bạn đã ngừng kinh doanh thành công", "success");
                                    fetchData();
                                } else {
                                    swal("Thất bại", "Thất bại, vui lòng thử lại", "error");
                                }
                            },1000);
                        },
                        complete    : function(){
                            setTimeout(function(){
                                $('.cancel-all').html('Ngừng kinh doanh các mặt hàng')
                            },1000);
                        }
                    });
                }
            }
            });
        });
        // // xóa tất cả mục đã chọn
        // $(document).on('click', '.remove-all', function(){
        //     swal({
        //         title: "Bạn có chắc chắn muốn xóa các mặt hàng này ?",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //     .then((willDelete) => {
        //     if (willDelete) {
        //         var arr = [];
        //         $('.custom-checkbox-input').each(function(index, value){
        //             if($(value).is(':checked')){
        //                 arr.push($(value).val());
        //             }
        //         });
        //         if(arr.length === 0){
        //             swal({
        //                 title: "Lỗi",
        //                 text: "Bạn chưa chọn mục để ngừng kinh doanh, vui lòng thử lại !",
        //                 icon: "error",
        //                 button: "OK",
        //                 dangerMode: true
        //             });
        //         } else {
        //             $.ajax({
        //                 url         : 'api/MANAGE/category/',
        //                 type        : 'POST',
        //                 dataType    : 'json',
        //                 data        : {categories: arr, action: 'remove-all'},
        //                 beforeSend  : function(){
        //                     $('.remove-all').html('<i class="fas fa-circle-notch fa-spin"></i> Đang xử lý');
        //                 },
        //                 success     : function(data){
        //                     setTimeout(function(){
        //                         if(data.status == 'success'){
        //                             swal("Thành công", "Bạn đã xóa thành công", "success");
        //                             fetchData();
        //                         } else {
        //                             swal("Thất bại", "Thất bại, vui lòng thử lại", "error");
        //                         }
        //                     },1000);
        //                 },
        //                 complete    : function(){
        //                     setTimeout(function(){
        //                         $('.remove-all').html('Xóa tất cả')
        //                     },1000);
        //                 }
        //             });
        //         }
        //     }
        //     });
        // });
    });
</script>
</body>
</html>