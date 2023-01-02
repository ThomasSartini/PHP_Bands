<?php
require_once 'Database.php';
require_once 'Filter.php';
require_once 'Get.php';
require_once 'Data.php';
class Check{
    
    /*
    Verifica il login dell'utente.
    @param $usename: nome utente
    @param $password: password dell'utente
    @param $tipo: tipo di utente (amministratore o band)
    @return true se il login è valido, altrimenti false
    */
    public static function login($usename, $password, $tipo){
        $user = Filter::string($usename);
        $pass = $password;
        // seleziona la tabella corretta in base al tipo di utente
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
        // Se ci sono risultati, imposta il valore di ritorno a true e inizializza la sessione.
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

    /**
     * Questo metodo si occupa di gestire le sessioni.
     */
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
