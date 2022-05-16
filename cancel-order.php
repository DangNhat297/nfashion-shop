<?php
    session_start();
    require_once 'admin/config.php';
    require_once 'incfiles/functions.php';
    $order = $_GET['order'] ?? 1;
    if(isset($_SESSION['user'])){
        $userID = $_SESSION['user']['id'];
        $query = "SELECT * FROM orders WHERE user_id = $userID AND order_id = $order";
        if(issetRecordQuery($query)){
            queryExecute("UPDATE orders SET status = 0 WHERE user_id = $userID AND order_id = $order");
            header('Location: '.DOMAIN.'/don-hang/');
        } else {
            header('Location: '.DOMAIN.'/trang-chu.html');
        }
    }
?>