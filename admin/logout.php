<?php
    session_start();
    session_destroy();
    header('Location: VIP/login.php');
?>