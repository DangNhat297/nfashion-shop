<?php
    require_once '../../../config.php';
    require_once '../../../../incfiles/functions.php';
    $status = 'error';
    $error  = array();
    $date       = new DateTime();
    $createAt   = $date->format("Y-m-d H:i:s");
    if(isset($_POST['action']) && $_POST['action'] == 'add-product'){
        $productName = strip_tags(trim($_POST['product-name']));
        $productPrice = preg_replace("#\.|\,|-#","", $_POST['product-price']);
        $productDiscount = $_POST['product-discount'];
        $productSpecial = $_POST['product-special'];
        $productDesc = trim($_POST['product-description']);
        $productCat = $_POST['product-category'];
        $listImage = $_FILES['fileimg'];
        $productKeyword = strip_tags($_POST['product-keyword']);
        $keyWordTmp = explode(" ", strtolower($productName));
        $keyWordTmp = implode(",", $keyWordTmp);
        $productKeyword .= ",".$keyWordTmp;
        $productDiscount = preg_replace("#\.|\,|-#","", $productDiscount);
        $productDesc = preg_replace("#(script>|onclick|javascript:)#i","", $productDesc);
        if(strlen($productName) < 5){
            $error['name'] = 'Tên sản phẩm phải lớn hơn 5 kí tự';
        }
        if($productDesc == ''){
            $error['description'] = 'Mô tả sản phẩm không được để trống';
        }
        if($listImage['size'][0] == 0){
            $error['image'] = 'Vui lòng tải hình ảnh sản phẩm';
        }
        if(count($error) == 0){
            try{
                $sql = "INSERT INTO products VALUES (null, '$productName', '$productPrice', $productDiscount, $productSpecial, 0, '$productDesc','$productKeyword', $productCat, '$createAt', 0)";
                $query = $conn->prepare($sql);
                $query->execute();
            } catch(PDOException $e){
                $error[] = $e->getMessage();
            }
            $sql = "SELECT MAX(product_id) as lastID FROM products";
            $query = $conn->prepare($sql);
            $query->execute();
            $lastID = $query->fetch()['lastID'];
            foreach($listImage['name'] as $key => $value){
                $fileExtension = pathinfo($value, PATHINFO_EXTENSION);
                $fileName = randomStr().'-'.date("H-i-s").'.'.$fileExtension;
                $pathImg = '../../../../assets/img/product/';
                move_uploaded_file($listImage['tmp_name'][$key], $pathImg . $fileName);
                $sql = "INSERT INTO images VALUES(null, $lastID, '$fileName')";
                $query = $conn->prepare($sql);
                $query->execute();
            }
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] == 'remove-product'){
        $product = $_POST['id'];
        try{
            $sql      = "DELETE FROM products WHERE product_id = $product";
            $query    = $conn->prepare($sql);
            $query->execute();
        } catch (PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['products']) && isset($_POST['action']) && $_POST['action'] == 'remove-product-select'){
        $products = $_POST['products'];
        $listProduct = array_map(function($value){
            return (int)$value;
        }, $products);
        foreach($listProduct as $value){
            try{
                $sql      = "DELETE FROM products WHERE product_id = $value";
                $query    = $conn->prepare($sql);
                $query->execute();
            } catch (PDOException $e){
                $error[] = $e->getMessage();
            }
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] == 'remove-image-product'){
        $imageName = $_POST['image'];
        unlink('../../../../assets/img/product/'.$imageName);
        $image = $_POST['id'];
        try{
            $sql      = "DELETE FROM images WHERE id = $image";
            $query    = $conn->prepare($sql);
            $query->execute();
        } catch (PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['product-id']) && isset($_POST['action']) && $_POST['action'] == 'update-product'){
        $id = $_POST['product-id'];
        $productName = strip_tags(trim($_POST['product-name']));
        $productPrice = preg_replace("#\.|\,#","", $_POST['product-price']);
        $productDiscount = $_POST['product-discount'];
        $productSpecial = $_POST['product-special'];
        $productHidden = $_POST['product-hidden'];
        $productDesc = trim($_POST['product-description']);
        $productKeyword = strip_tags($_POST['product-keyword']);
        $productCat = $_POST['product-category'];
        $listImage = $_FILES['fileimg'];
        $productDiscount = preg_replace("#\.|\,#","", $productDiscount);
        $productDesc = preg_replace("#(script>|onclick|javascript:)#i","", $productDesc);
        if(strlen($productName) < 5){
            $error['name'] = 'Tên sản phẩm phải lớn hơn 5 kí tự';
        }
        if($productDesc == ''){
            $error['description'] = 'Mô tả sản phẩm không được để trống';
        }
        if(count($error) == 0){
            try{
                $sql = "UPDATE products SET name = '$productName', price = '$productPrice', discount = '$productDiscount', special = $productSpecial,keyword = '$productKeyword', description = '$productDesc', cat_id = $productCat, is_hidden = $productHidden WHERE product_id = $id";
                $query = $conn->prepare($sql);
                $query->execute();
            } catch(PDOException $e){
                $error[] = $e->getMessage();
            }
            if($listImage['size'][0] > 0){
                foreach($listImage['name'] as $key => $value){
                    $fileExtension = pathinfo($value, PATHINFO_EXTENSION);
                    $fileName = randomStr().'-'.date("H-i-s").'.'.$fileExtension;
                    $pathImg = '../../../../assets/img/product/';
                    move_uploaded_file($listImage['tmp_name'][$key], $pathImg . $fileName);
                    $sql = "INSERT INTO images VALUES(null, $id, '$fileName')";
                    $query = $conn->prepare($sql);
                    $query->execute();
                }
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