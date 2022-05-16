<?php
    require_once '../../../config.php';
    require_once '../../../../incfiles/functions.php';
    if($_POST['get'] == 'table'){
        $table = '';
        $sql = "SELECT * FROM products ORDER BY product_id desc";
        $query = $conn->prepare($sql);
        $query->execute();
        if($query->rowCount() > 0){
            $data = $query->fetchAll();
            foreach($data as $value){
                $productId = $value['product_id'];
                $sql = "SELECT * FROM images WHERE product_id = $productId";
                $query = $conn->prepare($sql);
                $query->execute();
                $image = $query->fetchAll(PDO::FETCH_ASSOC)[0]['image'];
                $table .= '<tr>
                <td>
                    <input type="checkbox" class="custom-checkbox-input" name="products[]" value="'.$value['product_id'].'">
                </td>
                <td><img class="zoom-img" src="../assets/img/product/'.$image.'" style="width: 130px;height:130px;object-fit:cover;margin: 0 auto;display: block;"></td>
                <td>'.$value['name'].'</td>
                <td>'.product_price($value['price']).'</td>
                <td>'.$value['discount'].'%</td>
                <td>'.(($value['special'] == 0) ? "Bình thường" : "Đặc biệt").'</td>
                <td><span class="badge badge-primary">'.$value['view'].'</span></td>
                <td><a href="edit-product.php?id='.$value['product_id'].'"><button type="button" class="btn btn-xs btn-success" data-popover="popover" data-placement="top" data-trigger="hover" data-content="Sửa sản phẩm"><i class="fas fa-pen"></i> Sửa</button></a>
                    <button type="button" id="delproduct" class="btn btn-xs btn-danger" data-id-product="'.$value['product_id'].'" data-popover="popover" data-placement="top" data-trigger="hover" data-content="Xóa sản phẩm"><i class="fas fa-trash-alt"></i> Xóa</button>
                </td>
                </tr>';
            }
        } else {
            $table = '';
        }
        echo $table;
    }
    if($_POST['get'] == 'product'){
        $product = $_POST['product'];
        $sql = "SELECT * FROM products WHERE product_id = $product";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $date = new DateTime($result['created_at']);
        $datetime = $date->format("d-m-Y \l\ú\c H:i:s");
        $sql = "SELECT * FROM images WHERE product_id = $product";
        $query = $conn->prepare($sql);
        $query->execute();
        $listImage = $query->fetchAll(PDO::FETCH_ASSOC);
        $data = array(
            'id'            => $result['product_id'],
            'name'          => $result['name'],
            'price'         => $result['price'],
            'discount'      => $result['discount'],
            'special'       => $result['special'],
            'keyword'       => $result['keyword'],
            'description'   => $result['description'],
            'category'      => $result['cat_id'],
            'created_at'    => $datetime,
            'hidden'        => $result['is_hidden'],
            'image'         => $listImage
        );
        echo json_encode($data);
    }
?>