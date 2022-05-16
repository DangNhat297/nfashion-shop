<?php
    require_once '../../../config.php';
    $status = 'error';
    $error  = array();
    if(isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] == 'remove'){
        $cmtID = $_POST['id'];
        try{
            $sql      = "DELETE FROM comments WHERE cmt_id = $cmtID";
            $query    = $conn->prepare($sql);
            $query->execute();
        } catch (PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['comments']) && isset($_POST['action']) && $_POST['action'] == 'remove-all'){
        $comments = $_POST['comments'];
        $listCmt = array_map(function($value){
            return (int)$value;
        }, $comments);
        foreach($listCmt as $value){
            try{
                $sql      = "DELETE FROM comments WHERE cmt_id = $value";
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