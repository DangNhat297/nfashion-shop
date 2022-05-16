<?php
    require_once '../../../config.php';
    if(isset($_POST['get']) && $_POST['get'] == 'list-comment'){
        $sql = "SELECT products.product_id, products.name, COUNT(comments.product_id) as soluongcmt, MAX(comments.create_at) as moinhat, MIN(comments.create_at) as cunhat FROM products, comments WHERE products.product_id = comments.product_id GROUP BY products.product_id HAVING soluongcmt > 0;";
        $query = $conn->prepare($sql);
        $query->execute();
        $listCmt = $query->fetchAll(PDO::FETCH_ASSOC);
        $data = array();
        foreach($listCmt as $cmt){
            $date = new DateTime($cmt['moinhat']);
            $newTime = $date->format("d-m-Y \l\ú\c H:i:s");
            $date = new DateTime($cmt['cunhat']);
            $oldTime = $date->format("d-m-Y \l\ú\c H:i:s");
            $data[] = array(
                'product_id'    => $cmt['product_id'],
                'name'          => $cmt['name'],
                'soluong'       => $cmt['soluongcmt'],
                'moinhat'       => $newTime,
                'cunhat'        => $oldTime
            );
        }
        echo json_encode($data);
    }
    if(isset($_POST['get']) && $_POST['get'] == 'comment'){
        $productID = (int)$_POST['id'];
        $sql = "SELECT comments.cmt_id, users.fullname, comments.content, comments.create_at, comments.ip_address FROM users, comments, products WHERE comments.user_id = users.user_id AND comments.product_id = products.product_id AND comments.product_id = $productID ORDER BY comments.cmt_id DESC";
        $query = $conn->prepare($sql);
        $query->execute();
        $listCmt = $query->fetchAll(PDO::FETCH_ASSOC);
        $detail = array();
        foreach($listCmt as $cmt){
            $date = new DateTime($cmt['create_at']);
            $time = $date->format("d-m-Y \l\ú\c H:i:s");
            $detail[] = array(
                'cmt_id'    => $cmt['cmt_id'],
                'fullname'  => $cmt['fullname'],
                'content'   => $cmt['content'],
                'time'      => $time,
                'ipaddress' => $cmt['ip_address']
            );
        }
        $data = array(
            'detail'            => $detail
        );
        echo json_encode($data);
    }
?>