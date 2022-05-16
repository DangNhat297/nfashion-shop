<div class="footer">
            <div class="float-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2018
            </div>
        </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <!-- Tags Input -->
    <script src="js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <!-- CKEditor -->
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <!-- d3 and c3 charts -->
    <script src="js/plugins/d3/d3.min.js"></script>
    <script src="js/plugins/c3/c3.min.js"></script>
    <script>
        $(document).ready(function(){
            function findActivePage(){
                var pathname = window.location.pathname;
                var path = pathname.substr(pathname.lastIndexOf("/")+1);
                if(path.indexOf('.') == -1){
                    $('.nav a[href*="index.php"]').parent().attr("class", "active");
                }
                $('.nav a[href*="'+ path +'"]').parent().attr("class", "active");
                $('.nav a[href*="'+ path +'"]').parents('.nav-second-level').addClass('in');
                $('.nav a[href*="'+ path +'"]').parents('.nav-second-level').parent().attr("class","active");
            }
            findActivePage();
            // zoom image
            $(document).on('click', '.zoom-img', function(){
                var img = $(this);
                var bigImg = $('<img />').css({
                'max-width': '100%',
                'max-height': '100%',
                'display': 'inline'
                });
                bigImg.attr({
                src: img.attr('src'),
                alt: img.attr('alt'),
                title: img.attr('title')
                });
                var over = $('<div />').text(' ').css({
                'height': '100%',
                'width': '100%',
                'background': 'rgba(0,0,0,.82)',
                'position': 'fixed',
                'top': 0,
                'left': 0,
                'opacity': 0.0,
                'cursor': 'pointer',
                'z-index': 9999,
                'text-align': 'center'
                }).append(bigImg).bind('click', function () {
                $(this).fadeOut(300, function () {
                    $(this).remove();
                });
                }).insertAfter(this).animate({
                'opacity': 1
                }, 300);
            });
            // chọn tất cả
            $(document).on('click', '.select-all', function(){
                $('.custom-checkbox-input').each(function(index, value){
                    if($(value).is(':not(:checked)')){
                        $(value).click();
                    }
                });
            });
            // bỏ chọn tất cả
            $(document).on('click', '.unselect-all', function(){
                $('.custom-checkbox-input').each(function(index, value){
                    if($(value).is(':checked')){
                        $(value).click();
                    }
                });
            });
        });
    </script>
