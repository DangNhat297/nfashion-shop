<?php
    session_start();
    require_once 'admin/config.php';
    if(isset($_SESSION['user'])){
        session_destroy();
        header('Location: '.DOMAIN.'/trang-chu.html');
    } else {
        header('Location: '.DOMAIN.'/404.php');
    }
?>