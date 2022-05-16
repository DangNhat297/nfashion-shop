<?php
    session_start();
    require_once '../../../admin/config.php';
    require_once '../../../incfiles/functions.php';
    if(isset($_POST['get']) && $_POST['get'] == 'list-cart'){
        sleep(0.1);
        $data = array();
        $sum = 0;
        if(isset($_SESSION['user']) && $_SESSION['user']['login'] == true){
            $userID = $_SESSION['user']['id'];
            $listCart = getQueryValue("SELECT cart.cart_id, cart.user_id, cart.product_id, cart.cart_quantity, cart.cart_price, images.image, products.name FROM cart, images, products WHERE cart.product_id = products.product_id AND cart.product_id = images.product_id AND cart.user_id = $userID GROUP BY cart.product_id ORDER BY cart.cart_id;");
            foreach($listCart as $cart){
                $data[] = array(
                    'id'        => $cart['cart_id'],
                    'image'     => $cart['image'],
                    'name'      => $cart['name'],
                    'price'     => product_price($cart['cart_price']),
                    'quantity'  => $cart['cart_quantity'],
                    'total'     => product_price($cart['cart_price']*$cart['cart_quantity'])
                );
                $sum += $cart['cart_price']*$cart['cart_quantity'];
            }
        } else {
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $id => $cart){
                    $data[] = array(
                        'id'        => $id,
                        'image'     => $cart['image'],
                        'name'      => $cart['productname'],
                        'price'     => product_price($cart['productprice']),
                        'quantity'  => $cart['quantity'],
                        'total'     => product_price($cart['productprice']*$cart['quantity'])
                    );
                    $sum += $cart['productprice']*$cart['quantity'];
                }
            }
        }
        $cart = array(
            'detail'    => $data,
            'sum'       => product_price($sum)
        );
        echo json_encode($cart);
    }
?>