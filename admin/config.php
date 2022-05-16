<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    define('host', 'mysql:host=localhost;dbname=duanmau_v2;charset=utf8');
    define('dbuser','root');
    define('dbpass','');
    define('DOMAIN', $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"]);
    define('SITEKEY', '6LcuzdYcAAAAAPN_hBx2GFrKN9-LGbbzcSddRc7q');
    define('SECRETKEY', '6LcuzdYcAAAAAMIzVuOihWUeBK1asHVlpPZCUWys');
    try {
        // Kết nối
        $conn = new PDO(host, dbuser, dbpass);
         
        // Thiết lập chế độ lỗi
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
        // Thông báo thành công
        $sql = "SELECT * FROM information";
        $query = $conn->prepare($sql);
        $query->execute();
        $website = $query->fetch(PDO::FETCH_ASSOC);
        define('WEBSITE_NAME', $website["web_name"]);
        define('WEBSITE_LOGO', $website["logo"]);
        define('WEBSITE_ADDRESS', $website["address"]);
        define('WEBSITE_EMAIL', $website["email"]);
        define('WEBSITE_PHONE', $website["phone"]);
    } 
    // Nhánh kết nối thất bại
    catch (PDOException $e) {
        die('Kết nối thất bại: ' . $e->getMessage());
    }
?>