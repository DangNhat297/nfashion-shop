<?php 
    require_once 'incfiles/head.php';
?>
<div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Thống Kê Danh Mục Sản Phẩm</h5>
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
                            <table class="table table-bordered table-hover vertical-align">
                                <thead>
                                <tr>
                                    <th>Tên Danh Mục</th>
                                    <th>Số Sản Phẩm</th>
                                    <th>Giá Thấp Nhất</th>
                                    <th>Giá Cao Nhất</th>
                                    <th>Giá Trung Bình</th>
                                </tr>
                                </thead>
                                <tbody id="stats-category">
                                </tbody>
                            </table>
                        </div>
                        <div class="ibox-footer">
                            <a href="chart-category.php"><button type="button" class="btn btn-w-m btn-primary">Xem thống kê biểu đồ</button></a>
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
            function fetchData(){
                $.ajax({
                    url         : 'api/GET/category/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {get: 'stats-category'},
                    success     : function(data){
                        console.log(data)
                        var xhtml = '';
                        $.each(data, function(index, value){
                            xhtml += `<tr>
                                <td>`+ value.name +`</td>
                                <td>`+ value.quantity +`</td>
                                <td>`+ value.max +`</td>
                                <td>`+ value.min +`</td>
                                <td>`+ value.avg +`</td>
                            </tr>`;
                        })
                        $('#stats-category').html(xhtml)
                        $('.table').DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": false,
                            "info": true,
                            "autoWidth": true,
                            "responsive": true,
                        })
                    }
                })
            }
            fetchData()
        })
    </script>
</body>
</html>