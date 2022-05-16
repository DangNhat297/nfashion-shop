<?php
    require_once '../../../config.php';
    $status = 'error';
    $error  = array();
    $date       = new DateTime();
    $createAt   = $date->format("Y-m-d H:i:s");
    if(isset($_POST['category']) && isset($_POST['action']) && $_POST['action'] == 'add'){
        $category = ucwords($_POST['category']);
        $category = strip_tags($category);
        $sql      = "SELECT * FROM categories WHERE cat_name = '$category'";
        $query    = $conn->prepare($sql);
        $query->execute();
        if($query->rowCount() > 0){
            $error['category'] = 'Danh mục đã tồn tại';
        } else {
            $sql  = "INSERT INTO categories VALUES (null, '$category',1, '$createAt')";
            $query= $conn->prepare($sql);
            $query->execute();
            $status = 'success';
        }
    }
    if(isset($_POST['category']) && isset($_POST['action']) && $_POST['action'] == 'cancel-active'){
        $category = $_POST['category'];
        try{
            $sql      = "UPDATE categories SET cat_active = 0 WHERE cat_id = $category";
            $query    = $conn->prepare($sql);
            $query->execute();
        } catch (PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['category']) && isset($_POST['action']) && $_POST['action'] == 'remove'){
        $category = $_POST['category'];
        try{
            $sql      = "DELETE FROM categories WHERE cat_id = $category";
            $query    = $conn->prepare($sql);
            $query->execute();
        } catch (PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['category-name']) && isset($_POST['action']) && $_POST['action'] == 'update'){
        $category = ucwords($_POST['category-name']);
        $id       = $_POST['id'];
        $active   = (int)$_POST['category-active'];
        $category = strip_tags($category);
        $sql      = "SELECT * FROM categories WHERE cat_name = '$category' AND cat_id <> $id";
        $query    = $conn->prepare($sql);
        $query->execute();
        if($query->rowCount() > 0){
            $error['category'] = 'Danh mục đã tồn tại';
        } else {
            $sql  = "UPDATE categories SET cat_name = '$category', cat_active = $active WHERE cat_id = $id";
            $query= $conn->prepare($sql);
            $query->execute();
            $status = 'success';
        }
    }
    if(isset($_POST['categories']) && isset($_POST['action']) && $_POST['action'] == 'remove-all'){
        $category = $_POST['categories'];
        $listCat = array_map(function($value){
            return (int)$value;
        }, $category);
        foreach($listCat as $value){
            try{
                $sql      = "DELETE FROM categories WHERE cat_id = $value";
                $query    = $conn->prepare($sql);
                $query->execute();
            } catch (PDOException $e){
                $error[] = $e->getMessage();
            }
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['categories']) && isset($_POST['action']) && $_POST['action'] == 'cancel-all'){
        $category = $_POST['categories'];
        $listCat = array_map(function($value){
            return (int)$value;
        }, $category);
        foreach($listCat as $value){
            try{
                $sql      = "UPDATE categories SET cat_active = 0 WHERE cat_id = $value";
                $query    = $conn->prepare($sql);
                $query->execute();
            } catch (PDOException $e){
                $error[] = $e->getMessage();
            }
        }
        if(count($error) == 0) $status = 'success';
    }
    $data = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>