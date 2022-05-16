<?php
    require_once '../../../config.php';
    $status = 'error';
    $error  = array();
    if(isset($_POST['action']) && $_POST['action'] == 'change-status'){
        $orderID = (int)$_POST['order'];
        $status  = (int)$_POST['status'];
        try{
            $sql = "UPDATE orders SET status = $status WHERE order_id = $orderID";
            $query = $conn->prepare($sql);
            $query->execute();
        } catch(PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['action']) && $_POST['action'] == 'delete-order'){
        $orderID = (int)$_POST['order'];
        try{
            $sql = "DELETE FROM orders WHERE order_id = $orderID";
            $query = $conn->prepare($sql);
            $query->execute();
        } catch(PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    $data   = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>