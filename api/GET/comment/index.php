<?php
    require_once '../../../admin/config.php';
    require_once '../../../incfiles/functions.php';
    if(isset($_POST['get']) && $_POST['get'] == 'list-comment'){
        $data = array();
        $productId = (int)$_POST['id'];
        $listComment = getQueryValue("SELECT * FROM comments WHERE product_id = $productId");
        foreach($listComment as $comment){
            $date = new DateTime($comment['create_at']);
            $datetime = $date->format("d-m-Y \l\ú\c H:i");
            $userId = $comment['user_id'];
            $user = getQueryValueRecord("SELECT * FROM users WHERE user_id = $userId");
            $data[] = array(
                'fullname'      => $user['fullname'],
                'avatar'        => $user['avatar'],
                'content'       => $comment['content'],
                'cmt_id'        => $comment['cmt_id'],
                'user_id'       => $user['user_id'],
                'time'          => $datetime
            );
        }
        echo json_encode($data);
    }
?>