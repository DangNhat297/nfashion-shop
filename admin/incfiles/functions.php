<?php
    function countRecord($table){
        global $conn;
        $sql = "SELECT COUNT(*) as soluong FROM $table";
        $result = $conn->query($sql);
        if($result->rowCount() > 0){
            $num = $result->fetch(PDO::FETCH_ASSOC)['soluong'];
        } else {
            $num = 0;
        }
        return $num;
    }
    function checkLength($name, $min, $max){
        $flag = false;
        if(strlen($name) >= $min && strlen($name) <= $max) $flag = true;
        return $flag;
    }
    function checkExtension($filename){
        $extension = array('jpg','jpg','png','jfif','jpeg');
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        $flag = false;
        if(in_array(strtolower($file_extension), $extension)) $flag = true;
        return $flag;
    }
    function checkFileSize($filesize, $min, $max){
        $flag = false;
        if($filesize >= $min && $filesize <= $max) $flag = true;
        return $flag;
    }
    function randomStr(){
        $str = "QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890";
        $str = str_shuffle($str);
        return substr($str, 0, 5);
    }
    function product_price($priceFloat) {
        $symbol = 'đ';
        $symbol_thousand = '.';
        $decimal_place = 0;
        $price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
        return $price.$symbol;
    }
    function slug($str){
 
        $unicode = array(
  
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
  
            'd'=>'đ',
  
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
  
            'i'=>'í|ì|ỉ|ĩ|ị',
  
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
  
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
  
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
  
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
  
            'D'=>'Đ',
  
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
  
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
  
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
  
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
  
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
  
        );
  
       foreach($unicode as $nonUnicode=>$uni){
  
            $str = preg_replace("#($uni)#i", $nonUnicode, $str);
  
       }
       $str = strtolower($str);
       $str = preg_replace("#[^a-zA-Z0-9\s]#",'',$str);
       $str = preg_replace("#\s#",'-',$str);
       $str = preg_replace("#(-){2,}#",'-',$str);
        return $str;
    }
    function getDriveID($link){
        $link = preg_match("#/file/d/(.*)/view#",$link,$match);
        return $match[1];
    }
    function getThumb($thumb){
        $str = '';
        if(preg_match("#http|https|www#",$thumb)) { 
            $str = $thumb;
        } else {
            $str = "../img/film/".$thumb;
        }
        return $str;
    }
    function renameMovie($name){
        $str = strtolower($name);
        $str = ucwords($str);
        return $str;
    }
?>