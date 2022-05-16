<?php
    require_once '../../../config.php';
    require_once '../../../../incfiles/functions.php';
    $status = 'error';
    $error  = array();
    $date       = new DateTime();
    $createAt   = $date->format("Y-m-d H:i:s");
    $verifyCode = randomStr();
    if(isset($_POST['action']) && $_POST['action'] == 'add-user'){
        if(!checkLength($_POST['username'], 5, 255)){
            $error['username'] = 'Tên đăng nhập phải lớn hơn 5 kí tự';
        }
        if(preg_match("#\W#", $_POST['username'])){
            $error['username'] = 'Tên đăng nhập không được chứa kí tự đặc biệt';
        }
        if(!preg_match("#(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z]{6,255}#", $_POST['password'])){
            $error['password'] = 'Mật khẩu chứa ít nhất 1 kí tự số, 1 chữ hoa, 1 chữ thường, từ 6 kí tự trở lên';
        }
        if($_FILES['avatar']['size'] > 0){
            if(!checkExtension($_FILES['avatar']['name'])){
                $error['avatar'] = 'Định dạng file ảnh không chính xác';
            } else {
                $fileExtension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $fileName = randomStr().'-'.date("d-m-Y").'.'.$fileExtension;
            }
        } else {
            $fileName = 'default.png';
        }
        $fullname   = validField($_POST['fullname']);
        $username   = validField($_POST['username']);
        $password   = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $email      = validField($_POST['email']);
        $address    = validField($_POST['address']);
        $permission = validField($_POST['permission']);
        if($permission < 1 || $permission > 3){
            $error['permission'] = 'Loại thành viên không chính xác';
        }
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0){
            $error['username'] = 'Tên đăng nhập đã tồn tại';
        }
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0){
            $error['email'] = 'Email đã được đăng ký';
        }
        if(count($error) == 0){
                try{
                    $sql = "INSERT INTO users VALUES (null, '$fullname', '$username', '$password', '$email', '$fileName', 1, '$address', $permission, '$verifyCode', '$createAt')";
                    $stmt   = $conn->prepare($sql);
                    $stmt->execute();
                    if($_FILES['avatar']['size'] > 0){
                        move_uploaded_file($_FILES['avatar']['tmp_name'], '../../../../assets/img/avatar/'. $fileName);
                    }
                }catch(PDOException $e){
                    $error[] = $e->getMessage();
                }
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['action']) && $_POST['action'] == 'delete-user'){
        $userId = (int)$_POST['id'];
        try{
            $sql      = "DELETE FROM users WHERE user_id = $userId";
            $query    = $conn->prepare($sql);
            $query->execute();
        } catch (PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['action']) && $_POST['action'] == 'remove-user-select'){
        $users = $_POST['users'];
        $listUser = array_map(function($value){
            return (int)$value;
        }, $users);
        foreach($listUser as $value){
            try{
                $sql      = "DELETE FROM users WHERE user_id = $value";
                $query    = $conn->prepare($sql);
                $query->execute();
            } catch (PDOException $e){
                $error[] = $e->getMessage();
            }
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['action']) && $_POST['action'] == 'update-user'){
        $userID = (int)$_POST['id'];
        $active = (int)$_POST['active'];
        $permission = (int)$_POST['permission'];
        try{
            $sql = "UPDATE users SET active = $active, permission = $permission WHERE user_id = $userID";
            $query = $conn->prepare($sql);
            $query->execute();
        } catch (PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['action']) && $_POST['action'] == 'update-current-user'){
        $fullname = validField($_POST['fullname']);
        $userID = (int)$_POST['id'];
        if($_FILES['avatar']['size'] > 0){
            if(!checkExtension($_FILES['avatar']['name'])){
                $error['avatar'] = 'Định dạng file ảnh không chính xác';
            } else {
                $fileExtension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $fileName = randomStr().'-'.date("d-m-Y").'.'.$fileExtension;
            }
        }
        if(count($error) == 0){
            try{
                $sql = "UPDATE users SET fullname = '$fullname' WHERE user_id = $userID";
                $query = $conn->prepare($sql);
                $query->execute();
                if($_FILES['avatar']['size'] > 0){
                    try{
                        $sql = "UPDATE users SET avatar = '$fileName' WHERE user_id = $userID";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        move_uploaded_file($_FILES['avatar']['tmp_name'], '../../../../assets/img/avatar/' . $fileName);
                    } catch (PDOException $e){
                        $error[] = $e->getMessage();
                    }
                }
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