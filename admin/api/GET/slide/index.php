<?php
    require_once '../../../config.php';
    if(isset($_POST['get']) && $_POST['get'] == 'list-slide'){
        $sql = "SELECT * FROM slides";
        $query = $conn->prepare($sql);
        $query->execute();
        $listSlide = $query->fetchAll(PDO::FETCH_ASSOC);
        $data = $listSlide;
        echo json_encode($data);
    }
?>