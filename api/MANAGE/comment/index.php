<?php
    require_once '../../../admin/config.php';
    require_once '../../../incfiles/functions.php';
    $wordError = "địt|dcm|lol|dm|lồn|cặc|cc|dkm|clmm|loz|vlxx|sex|cmm|'|\"";
    $status = 'error';
    $error = array();
    if(isset($_POST['action']) && $_POST['action'] == 'add-comment'){
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = new DateTime();
        $createdAt = $date->format("Y-m-d H:i:s");
        $content = trim(htmlspecialchars(strip_tags($_POST['content'])));
        $userId = (int)$_POST['user'];
        $productId = (int)$_POST['product'];
        if(preg_match("#($wordError)#", $content)){
            $content = 'Bình luận đã bị ẩn vì chứa ngôn ngữ nhạy cảm !';
        }
        try{
            $sql = "INSERT INTO comments VALUES (null, $userId, $productId, '$content', '$createdAt', '$ip')";
            $query = $conn->prepare($sql);
            $query->execute();
        } catch (PDOException $e){
            $error[] = $e->getMessage();
        }
        if(count($error) == 0) $status = 'success';
    }
    if(isset($_POST['action']) && $_POST['action'] == 'delete-comment'){
        $cmtID  = (int)$_POST['id'];
        try{
            $sql = "DELETE FROM comments WHERE cmt_id = $cmtID";
            $query = $conn->prepare($sql);
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