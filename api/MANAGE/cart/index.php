<?php
    session_start();
    require_once '../../../admin/config.php';
    require_once '../../../incfiles/functions.php';
    $status     = 'error';
    $error      = array();
    if(isset($_POST['action']) && $_POST['action'] == 'add-to-cart'){
        $id         = (int)$_POST['id'];
        $quantity   = (int)$_POST['quantity'];
        $product    = getQueryValueRecord("SELECT * FROM products,images WHERE products.product_id = $id AND products.product_id = images.product_id GROUP BY products.product_id");
        if(isset($_SESSION['user']) && $_SESSION['user']['login'] == true){
            $userID = $_SESSION['user']['id'];
            if(issetRecordQuery("SELECT * FROM cart WHERE user_id = $userID AND product_id = $id")){
                queryExecute("UPDATE cart SET cart_quantity = cart_quantity + $quantity WHERE user_id = $userID AND product_id = $id");
            } else {
                $product = getQueryValueRecord("SELECT * FROM products WHERE product_id = $id");
                $price = ($product['discount'] > 0) ? $product['price'] - ($product['price']*$product['discount']/100) : $product['price'];
                queryExecute("INSERT INTO cart VALUES(null, $userID, $id, $quantity, $price)");
            }
            $status = 'success';
        } else {
            if(!empty($_SESSION['cart'])){
                if(array_key_exists($id,$_SESSION['cart'])){
                    $_SESSION['cart'][$id] = array(
                        'productname'   => $product['name'],
                        'productprice'  => ($product['discount'] > 0) ? $product['price'] - ($product['price']*$product['discount']/100) : $product['price'],
                        'quantity'      => (int)$_SESSION['cart'][$id]['quantity'] + $quantity,
                        'image'         => $product['image']
                    );
                } else {
                    $_SESSION['cart'][$id] = array(
                        'productname'   => $product['name'],
                        'productprice'  => ($product['discount'] > 0) ? $product['price'] - ($product['price']*$product['discount']/100) : $product['price'],
                        'quantity'      => $quantity,
                        'image'         => $product['image']
                    );
                }
            } else {
                $_SESSION['cart'][$id] = array(
                    'productname'   => $product['name'],
                    'productprice'  => ($product['discount'] > 0) ? $product['price'] - ($product['price']*$product['discount']/100) : $product['price'],
                    'quantity'      => $quantity,
                    'image'         => $product['image']
                );
            }
            $status = 'success';
        }
    }
    if(isset($_POST['action']) && $_POST['action'] == 'delete-cart-product'){
        $id = (int)$_POST['id'];
        if(isset($_SESSION['user']) && $_SESSION['user']['login'] == true){
            $userID = $_SESSION['user']['id'];
            queryExecute("DELETE FROM cart WHERE cart_id = $id");
            $status = 'success';
        } else {
            unset($_SESSION['cart'][$id]);
            $status = 'success';
        }
    }
    if(isset($_POST['action']) && $_POST['action'] == 'update-cart'){
        $id = (int)$_POST['id'];
        $quantity = (int)$_POST['quantity'];
        if(isset($_SESSION['user']) && $_SESSION['user']['login'] == true){
            queryExecute("UPDATE cart SET cart_quantity = $quantity WHERE cart_id = $id");
            $status = 'success';
        } else {
            $_SESSION['cart'][$id]['quantity'] = $quantity;
            $status = 'success';
        }

    }
    $data = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>