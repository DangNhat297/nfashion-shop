<?php
    require_once 'incfiles/header.php';
?>
    <main>
        <div class="breadcrumb-thumb">
            <p class="namepage">Liên Hệ</p>
            <div><a href="index.html">Trang Chủ</a> / Liên Hệ</div>
        </div>
        <div class="container-custom">
            <div class="contact">
                <div>
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Địa chỉ</p>
                    <span><?=WEBSITE_ADDRESS?></span>
                </div>
                <div>
                    <i class="fas fa-phone"></i>
                    <p>Số điện thoại</p>
                    <span><?=WEBSITE_PHONE?></span>
                </div>
                <div>
                    <i class="far fa-envelope"></i>
                    <p>Email</p>
                    <span><?=WEBSITE_EMAIL?></span>
                </div>
            </div>
            <div class="contact-form">
                <div class="maps">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8638558813955!2d105.74459841424536!3d21.03813279283566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1622194479357!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="form-contact">
                    <p>Gửi liên hệ</p>
                    <form id="contact-form">
                        <input type="text" class="form-input" placeholder="Nhập tên của bạn..." name="fullname" required />
                        <input type="email" class="form-input" placeholder="Nhập email..." name="email" required />
                        <input type="text" class="form-input" placeholder="Nhập tiêu đề..." name="title" required />
                        <textarea class="input-comment" placeholder="Nội dung" rows="7" name="content" required></textarea>
                        <button type="submit" class="form-submit">Gửi liên hệ</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php
    require_once 'incfiles/footer.php';
?>
    <script>
        $(document).ready(function(){
            setTitle("Liên Hệ - <?=WEBSITE_NAME?>")
            $('#contact-form').submit(function(e){
                e.preventDefault()
                var form = new FormData(this)
                form.append('action', 'add-contact')
                $.ajax({
                    url         : '<?=DOMAIN?>/api/MANAGE/contact/',
                    type        : 'POST',
                    data        : form,
                    processData : false,
                    contentType : false,
                    dataType    : 'json',
                    beforeSend  : function(){
                        $('button[type="submit"]').html('<i class="fas fa-circle-notch fa-spin"></i> Đang xử lý')
                    },
                    success     : function(data){
                        setTimeout(function(){
                            $('input,textarea').attr('disabled', 'disabled')
                            $('button[type="submit"]').html('<i class="fas fa-check"></i> Gửi liên hệ thành công').attr('disabled', 'disabled')
                        },1000)
                    }
                })
            })
        })
    </script>
</body>
</html>