<?php
    require_once '../../../admin/config.php';
    require_once '../../../incfiles/functions.php';
    $status = 'error';
    $error = array();
    if(isset($_POST['action']) && $_POST['action'] == 'add-contact'){
        $fullName   = validField($_POST['fullname']);
        $email      = validField($_POST['email']);
        $title      = validField($_POST['title']);
        $content    = validField($_POST['content']);
        $status     = 'success';
        $fileName   = 'contact.txt';
        file_put_contents($fileName, $fullName."|".$email."|".$title."|".$content."\r\n", FILE_APPEND);
    }
    $data = array(
        'status'    => $status,
        'message'   => $error
    );
    echo json_encode($data);
?>