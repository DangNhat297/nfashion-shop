<?php
    require_once '../../../config.php';
    require_once '../../../../incfiles/functions.php';
    if(isset($_POST['get']) && $_POST['get'] == 'table'){
        $table = '';
        $sql = "SELECT * FROM categories ORDER BY cat_id DESC";
        $query = $conn->prepare($sql);
        $query->execute();
        if($query->rowCount() > 0){
            $data = $query->fetchAll();
            foreach($data as $value){
                $table .= '<tr>
                <td>
                    <input type="checkbox" class="custom-checkbox-input" name="categories[]" value="'.$value['cat_id'].'">
                </td>
                <td>'.$value['cat_name'].'</td>
                <td>'.(($value['cat_active'] == 1) ? '<span class="badge badge-primary">Đang kinh doanh</span>' : '<span class="badge badge-danger">Ngừng kinh doanh</span>').'</td>
                <td><button type="button" id="editcategory" data-id-category="'.$value['cat_id'].'" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-success" data-popover="popover" data-placement="top" data-trigger="hover" data-content="Sửa danh mục"><i class="fas fa-pen"></i> Sửa</button>
                    <button type="button" id="cancel-category" data-id-category="'.$value['cat_id'].'" class="btn btn-xs btn-warning" data-popover="popover" data-placement="top" data-trigger="hover" data-content="Ngừng kinh doanh mặt hàng"><i class="fas fa-power-off"></i> Ngừng kinh doanh</button>
                    <!--<button type="button" id="delcategory" data-id-category="'.$value['cat_id'].'" class="btn btn-xs btn-danger" data-popover="popover" data-placement="top" data-trigger="hover" data-content="Xóa danh mục ra khỏi hệ thống"><i class="fas fa-trash"></i> Xóa</button>-->
                </td>
                </tr>';
            }
        } else {
            $table = 'Không có dữ liệu';
        }
        echo $table;
    }
    if(isset($_POST['get']) && $_POST['get'] == 'category'){
        $category = $_POST['category'];
        $sql = "SELECT * FROM categories WHERE cat_id = $category";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        $date = new DateTime($result['created_at']);
        $datetime = $date->format("d-m-Y \l\ú\c H:i:s");
        $data = array(
            'cat_id'      => $result['cat_id'],
            'cat_name'    => $result['cat_name'],
            'cat_active'  => $result['cat_active'],
            'created_at'  => $datetime
        );
        echo json_encode($data);
    }
    if(isset($_POST['get']) && $_POST['get'] == 'stats-category'){
        $sql = "SELECT categories.cat_name, COUNT(products.product_id) as soluongsanpham, MAX(products.price) as giacaonhat, MIN(products.price) as giathapnhat, AVG(products.price) as giatrungbinh FROM categories, products WHERE categories.cat_id = products.cat_id GROUP BY categories.cat_id;";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $data = array();
        foreach($result as $category){
            $data[] = array(
                'name'      => $category['cat_name'],
                'quantity'  => $category['soluongsanpham'],
                'max'       => product_price($category['giacaonhat']),
                'min'       => product_price($category['giathapnhat']),
                'avg'       => product_price($category['giatrungbinh'])
            );
        }
        echo json_encode($data);
    }
?>