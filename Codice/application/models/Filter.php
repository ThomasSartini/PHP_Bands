<?php 
class Filter{
    public static function string($str){
        $str = filter_var($str,FILTER_SANITIZE_STRING);
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }
}

?>