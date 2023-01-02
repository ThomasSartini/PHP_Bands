<?php
require_once 'Database.php';
require_once 'Filter.php';
require_once 'Get.php';
require_once 'Data.php';
class Check{
    
    public static function login($usename, $password, $tipo){
        $user = Filter::string($usename);
        $pass = $password;
        if($tipo){
            $query = "SELECT id FROM administrator where user=? AND password=?"; 
        }else{
            $query = "SELECT id FROM band where user=? AND password=?"; 
        }
        $conn = Database::connect();
        $stmt = $conn->prepare($query); 
        $stmt->bind_param("ss", $user, $pw);
        $pw =  hash('sha256',$pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        $return = false;
        if($result->num_rows> 0){
            $return = true;
            if(session_status() != 2){
                session_start();
                $_SESSION['user'] = $user;
                if($tipo){
                    $_SESSION["admin"] = true;
                }else{
                    $_SESSION["admin"] = false;
                }
                $_SESSION["id"] = Data::cleanSingleData($result, "id");
                $date = (new Datetime(Get::currentDate()))->format('Ydm');
                $ip = Get::ipAddress();
                $_SESSION['check'] = hash('md5',$ip.$date.$user);
            }
        }
        mysqli_free_result($result);
        return $return;
    }


    public static function session(){
        if(session_status() != 2){
            session_start();
        }
        
        if(isset($_SESSION['user']) && isset($_SESSION['check'])){
            $date = (new Datetime(Get::currentDate()))->format('Ydm');
            $ip = Get::ipAddress();
            $user = $_SESSION["user"];
            if(hash('md5',$ip.$date.$user) == $_SESSION['check']){
                return true;
            }
        }
        header("Location:http://localhost:8080/bands/login/");
        exit();
        return false;
    }
    
}
?>
