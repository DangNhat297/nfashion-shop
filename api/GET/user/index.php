<?php
    session_start();
    require_once '../../../admin/config.php';
    if(isset($_SESSION['user']) && isset($_POST['get']) && $_POST['get'] == 'user-information'){
        $userId = $_SESSION['user']['id'];
        $sql = "SELECT * FROM users WHERE user_id = $userId";
        $query = $conn->prepare($sql);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $date = new DateTime($user['created_at']);
        $time = $date->format("d-m-Y");
        $data = array(
            'id'        => $user['user_id'],
            'fullname'  => $user['fullname'],
            'username'  => $user['username'],
            'email'     => $user['email'],
            'avatar'    => $user['avatar'],
            'address'   => $user['address'],
            'permission'=> $user['permission'],
            'created'   => $time
        );
        echo json_encode($data);
    }
?>