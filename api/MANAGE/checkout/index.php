<?php
    session_start();
    require_once '../../../admin/config.php';
    require_once '../../../incfiles/functions.php';
    $status     = 'error';
    $error      = array();
    $date       = new DateTime();
    $createAt   = $date->format("Y-m-d H:i:s");
    if(isset($_SESSION['user']) && isset($_POST['action']) && $_POST['action'] == 'checkout'){
        $userID     = $_SESSION['user']['id'];
        $fullname   = validField($_POST['fullname']);
        $phone      = validField($_POST['phone']);
        $email      = validField($_POST['email']);
        $address    = validField($_POST['address']).' - '.$_POST['ward'].' - '.$_POST['district'].' - '.$_POST['province'];
        $note       = validField($_POST['note']);
        queryExecute("INSERT INTO orders VALUES(null, $userID, '$fullname', '$phone', '$email', '$address', '$note', 1, '$createAt')");
        $listCart   = getQueryValue("SELECT * FROM cart WHERE cart.user_id = $userID");
        $orderID    = getQueryValueRecord("SELECT MAX(order_id) as lastid FROM orders")['lastid'];
        foreach($listCart as $product){
            $cartID    = $product['cart_id'];
            $productID = $product['product_id'];
            $quantity  = $product['cart_quantity'];
            $price     = $product['cart_price'];
            try{
                queryExecute("INSERT INTO orders_detail VALUES(null, $orderID, $productID, $quantity, $price)");
                queryExecute("DELETE FROM cart WHERE cart_id = $cartID");
            } catch (PDOException $e){
                $error[] = $e->getMessage();
            }
        }
        if(count($error) == 0) $status = 'success';
    }
    $data = array(
        'status'        => $status,
        'message'       => $error
    );
    echo json_encode($data);
?>