<?php 
    require_once 'incfiles/head.php';
?>
<div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Danh Sách Bình Luận</h5>
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
                                    <th>Tên sản phẩm</th>
                                    <th>Số Bình Luận</th>
                                    <th>Bình Luận Mới Nhất</th>
                                    <th>Bình Luận Cũ Nhất</th>
                                    <th>Chi Tiết</th>
                                </tr>
                                </thead>
                                <tbody id="list-comment">
                                </tbody>
                            </table>
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
            function fetchComment(){
                $.ajax({
                    url         : 'api/GET/comment/',
                    type        : 'POST',
                    dataType    : 'json',
                    data        : {get: 'list-comment'},
                    success     : function(data){
                        console.log(data)
                        var xhtml = '';
                        $.each(data, function(index, value){
                            xhtml += `<tr>
                                <td>`+ value.name +`</td>
                                <td><span class="badge badge-primary">`+ value.soluong +`</span></td>
                                <td>`+ value.moinhat +`</td>
                                <td>`+ value.cunhat +`</td>
                                <td><a href="comment.php?product=`+ value.product_id +`"><button type="button" class="btn btn-primary btn-xs"><i class="far fa-comments"></i> Chi tiết</button></a></td>
                            </tr>`;
                        })
                        $('#list-comment').html(xhtml)
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
            fetchComment()
        })
    </script>
</body>
</html>