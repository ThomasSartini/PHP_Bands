<?php

class Database{

    private static $HOST = "localhost";
    private static $USER = "root";
    private static $PASS = "";
    private static $DB = "bands";

    
    public static function connect(){
        return new mysqli(self::$HOST, self::$USER, self::$PASS, self::$DB);
    }

    public static function query($query){
        $conn = self::connect();
        $result = $conn->query($query);
        mysqli_close($conn);
        return $result;
    }

}