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
    function issetRecordQuery($sql){
        global $conn;
        $flag = false;
        $result = $conn->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0){
            $flag = true;
        }
        return $flag;
    }
    function queryExecute($sql){
        global $conn;
        $result = $conn->prepare($sql);
        $result->execute();
    }
    function rowCountQuery($sql){
        global $conn;
        $result = $conn->prepare($sql);
        $result->execute();
        return $result->rowCount();
    }
    function getAllTable($tableName){
        global $conn;
        $sql = "SELECT * FROM $tableName";
        $result = $conn->prepare($sql);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getQueryValue($sql){
        global $conn;
        $result = $conn->prepare($sql);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getQueryValueRecord($sql){
        global $conn;
        $result = $conn->prepare($sql);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function showPrice($price, $discount){
        $xhtml = '';
        if($discount > 0){
            $xhtml = '<div class="product-price">
                        '.product_price($price-($price*$discount/100)).' <del>'.product_price($price).'</del>
                    </div>';
        } else {
            $xhtml = '<div class="product-price">'.product_price($price).'</div>';
        }
        return $xhtml;
    }
    function checkLength($name, $min, $max){
        $flag = false;
        if(strlen($name) >= $min && strlen($name) <= $max) $flag = true;
        return $flag;
    }
    function checkExtension($filename){
        $extension = array('jpg','png','jfif','jpeg');
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
        $symbol = '??';
        $symbol_thousand = '.';
        $decimal_place = 0;
        $price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
        return $price.$symbol;
    }
    function slug($str){
 
        $unicode = array(
  
            'a'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
  
            'd'=>'??',
  
            'e'=>'??|??|???|???|???|??|???|???|???|???|???',
  
            'i'=>'??|??|???|??|???',
  
            'o'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
  
            'u'=>'??|??|???|??|???|??|???|???|???|???|???',
  
            'y'=>'??|???|???|???|???',
  
            'A'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
  
            'D'=>'??',
  
            'E'=>'??|??|???|???|???|??|???|???|???|???|???',
  
            'I'=>'??|??|???|??|???',
  
            'O'=>'??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???',
  
            'U'=>'??|??|???|??|???|??|???|???|???|???|???',
  
            'Y'=>'??|???|???|???|???',
  
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
    function validField($text){
        $text = trim($text);
        $text = strip_tags($text);
        return $text;
    }
?>