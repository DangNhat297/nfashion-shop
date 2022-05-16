<?php
    require_once '../../../config.php';
    $status = 'error';
    $error  = array();
    if(isset($_POST['action']) && $_POST['action'] == 'update-information'){
        $webName    = $_POST['website-name'];
        $webAddress = $_POST['website-address'];
        $webEmail   = $_POST['website-email'];
        $webPhone   = $_POST['website-phone'];
        $webLogo    = $_FILES['weblogo'];
        try{
            $sql = "UPDATE information SET web_name = '$webName', address = '$webAddress', email = '$webEmail', phone = '$webPhone' WHERE id = 1";
            $query = $conn->prepare($sql);
            $query->execute();
            if($webLogo['size'] > 0){
                $fileExtension = pathinfo($webLogo['name'], PATHINFO_EXTENSION);
                $fileName = 'logo-'.date("H-i-s").'.'.$fileExtension;
                move_uploaded_file($webLogo['tmp_name'], '../../../../assets/img/logo/'.$fileName);
                $sql = "UPDATE information SET logo = '$fileName' WHERE id = 1";
                $query = $conn->prepare($sql);
                $query->execute();
            }
        } catch (PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    $data = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>