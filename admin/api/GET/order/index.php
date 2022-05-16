<?php
    require_once '../../../config.php';
    require_once '../../../../incfiles/functions.php';
    if(isset($_POST['get']) && $_POST['get'] == 'list-order'){
        $sql = "SELECT orders.order_id, orders.user_id, orders.fullname, orders.phone, orders.email, orders.address, orders.note, orders.status, orders.created_at, SUM(orders_detail.order_quantity*orders_detail.order_price) as tongtien FROM orders, orders_detail WHERE orders.order_id = orders_detail.order_id GROUP BY orders.order_id;";
        $query = $conn->prepare($sql);
        $query->execute();
        $listOrder = $query->fetchAll(PDO::FETCH_ASSOC);
        $data = array();
        foreach($listOrder as $order){
            $date = new DateTime($order['created_at']);
            $datetime = $date->format("d-m-Y \l\ú\c H:i:s");
            $data[] = array(
                'order_id'  => $order['order_id'],
                'fullname'  => $order['fullname'],
                'phone'     => $order['phone'],
                'email'     => $order['email'],
                'address'   => $order['address'],
                'note'      => $order['note'],
                'status'    => $order['status'],
                'created'   => $datetime,
                'total'     => product_price($order['tongtien'])
            );
        }
        echo json_encode($data);
    }
    if(isset($_POST['get']) && $_POST['get'] == 'order'){
        $orderID = (int)$_POST['order'];
        $sql = "SELECT products.name, orders_detail.order_quantity, orders_detail.order_price FROM orders_detail, products WHERE products.product_id = orders_detail.product_id AND orders_detail.order_id = $orderID";
        $query = $conn->prepare($sql);
        $query->execute();
        $listProduct = $query->fetchAll(PDO::FETCH_ASSOC);
        $product = array();
        $total = 0;
        foreach($listProduct as $order){
            $product[] = array(
                'name'      => $order['name'],
                'quantity'  => $order['order_quantity'],
                'total'     => product_price($order['order_quantity']*$order['order_price'])
            );
            $total += $order['order_quantity']*$order['order_price'];
        }
        $data = array(
            'product'   => $product,
            'total'     => product_price($total)
        );
        echo json_encode($data);
    }
?>