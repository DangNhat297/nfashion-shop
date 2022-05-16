<?php
    define('host', 'mysql:host=localhost;charset:utf8');
    define('dbuser','root');
    define('dbpass','');
    define('dbname','duanmau_v2');
    $error = array();
    try {
        // Chuỗi kết nối
        $conn = new PDO(host, dbuser, dbpass);
         
        // Thiết lập chế độ exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
        // Câu truy vấn
        $sql = "CREATE DATABASE ". dbname;
         
        // Thực thi câu truy vấn
        $conn->exec($sql);
         
        // Thông báo thành công
        echo "Tạo database thành công";
    }
    catch(PDOException $e)
    {
        $error[] = 'Không thể tạo database';
    }
    $sql = [
        "CREATE TABLE information(
            id int auto_increment primary key,
            web_name varchar(50) not null comment 'Tiêu đề cửa hàng',
            logo varchar(255) not null comment 'Logo cửa hàng',
            address varchar(255) not null comment 'Địa chỉ cửa hàng',
            email varchar(50) not null comment 'Email liên hệ',
            phone varchar(11) not null comment 'SĐT liên hệ'
        );",
        "CREATE TABLE slides(
            slide_id int auto_increment primary key,
            slide_image varchar(255) not null comment 'Ảnh slide',
            slide_title varchar(255) not null comment 'Tiêu đề slide',
            slide_url varchar(255) not null comment 'Đường dẫn slide'
        );",
        "CREATE TABLE categories(
            cat_id int auto_increment primary key,
            cat_name varchar(50) not null comment 'Tên danh mục',
            cat_active int(1) not null default 1 comment 'Trạng thái hoạt dộng',
            created_at datetime not null comment 'Thời gian tạo'
        );",
        "CREATE TABLE users(
            user_id int auto_increment primary key,
            fullname varchar(255) not null comment 'Họ và tên',
            username varchar(255) not null comment 'Tên đăng nhập',
            password varchar(255) not null comment 'Mật khẩu',
            email varchar(50) not null comment 'Địa chỉ email',
            avatar varchar(255) not null comment 'Ảnh đại diện',
            active int(1) not null default 0 comment 'Kích hoạt',
            address varchar(255) not null comment 'Địa chỉ',
            permission int(1) not null comment 'Quyền quản trị',
            verify_code varchar(10) not null comment 'Mã kích hoạt',
            created_at datetime not null comment 'Ngày đăng ký'
        );",
        "CREATE TABLE products(
            product_id int auto_increment primary key,
            name varchar(255) not null comment 'Tên sản phẩm',
            price int not null comment 'Giá sản phẩm',
            discount int not null comment 'Phần trăm giảm giá',
            special int(1) not null comment 'Hàng đặc biệt',
            view int not null default 0 comment 'Lượt xem',
            description text comment 'Mô tả sản phẩm',
            keyword varchar(255) comment 'Từ khóa sản phẩm',
            cat_id int comment 'Loại danh mục',
            created_at datetime not null comment 'Ngày tạo sản phẩm',
            is_hidden int(1) not null default 0 comment 'Ẩn sản phẩm',
            foreign key (cat_id) references categories(cat_id) ON DELETE SET NULL
        );",
        "CREATE TABLE comments(
            cmt_id int auto_increment primary key,
            user_id int not null comment 'Người bình luận',
            product_id int not null comment 'Sản phẩm bình luận',
            content text not null comment 'Nội dung bình luận',
            create_at datetime not null comment 'Thời gian bình luận',
            ip_address varchar(50) not null comment 'Địa chỉ IP',
            foreign key (user_id) references users(user_id) ON DELETE CASCADE,
            foreign key (product_id) references products(product_id) ON DELETE CASCADE
        );",
        "CREATE TABLE images(
            id int auto_increment primary key,
            product_id int not null comment 'Sản phẩm',
            image varchar(255) not null,
            foreign key (product_id) references products(product_id) ON DELETE CASCADE
        )",
        "INSERT INTO information VALUES (null, 'NFashion Shop', 'nfashion.png', 'Hà Nội - Việt Nam', 'admin@nfashion.vn', '0987654321')",
        "CREATE TABLE cart(
            cart_id int auto_increment primary key,
            user_id int not null comment 'Giỏ hàng của thành viên',
            product_id int not null comment 'Sản phẩm',
            cart_quantity int(3) not null comment 'Số lượng',
            cart_price int not null comment 'Giá sản phẩm',
            foreign key (user_id) references users(user_id) ON DELETE CASCADE,
            foreign key (product_id) references products(product_id) ON DELETE CASCADE
        )",
        "CREATE TABLE orders(
            order_id int auto_increment primary key,
            user_id int not null comment 'Người mua hàng',
            fullname varchar(255) not null comment 'Họ và tên',
            phone varchar(11) not null comment 'Số điện thoại',
            email varchar(50) not null comment 'Địa chỉ email',
            address varchar(255) comment 'Địa chỉ',
            note varchar(255) comment 'Ghi chú mua hàng',
            status int(1) default 1 comment 'Trạng thái đơn hàng',
            created_at datetime not null comment 'Ngày đặt hàng',
            foreign key (user_id) references users(user_id) ON DELETE CASCADE
        )",
        "CREATE TABLE orders_detail(
            id int auto_increment primary key,
            order_id int not null comment 'Đơn hàng',
            product_id int comment 'Sản phẩm',
            order_quantity int(3) not null comment 'Số lượng',
            order_price int not null comment 'Giá sản phẩm',
            foreign key (order_id) references orders(order_id) ON DELETE CASCADE,
            foreign key (product_id) references products(product_id) ON DELETE CASCADE
        )"
    ];
    try{
        $conn->query("use ". dbname);
        foreach($sql as $query){
            $conn->exec($query);
        }
        echo 'Tạo table thành công !';
    }
    catch(PDOException $e){
        $error[] = $e->getMessage();
    }
    echo '<pre>';
    print_r($error);
    echo '</pre>';
?>