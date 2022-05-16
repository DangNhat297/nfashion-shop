<?php
    require_once '../../../config.php';
    require_once '../../../../incfiles/functions.php';
    $status = 'error';
    $error  = array();
    if(isset($_POST['action']) && $_POST['action'] == 'add-slide'){
        $slideTitle = strip_tags(trim($_POST['slide-title']));
        $slideUrl   = strip_tags(trim($_POST['slide-url']));
        $slideImg   = $_FILES['slide'];
        $fileExtension = pathinfo($slideImg['name'], PATHINFO_EXTENSION);
        $fileName = 'slide-'.date("H-i-s").'.'.$fileExtension;
        try{
            $sql = "INSERT INTO slides VALUES (null, '$fileName', '$slideTitle', '$slideUrl')";
            $query = $conn->prepare($sql);
            $query->execute();
            move_uploaded_file($slideImg['tmp_name'], '../../../../assets/img/banner/' . $fileName);
        } catch(PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] == 'remove-slide'){
        $slideName = $_POST['slide'];
        unlink('../../../../assets/img/banner/'.$slideName);
        $slide = $_POST['id'];
        try{
            $sql      = "DELETE FROM slides WHERE slide_id = $slide";
            $query    = $conn->prepare($sql);
            $query->execute();
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