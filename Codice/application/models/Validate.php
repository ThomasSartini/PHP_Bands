<?php
require_once 'Check.php';
require_once 'Data.php';
require_once 'Get.php';


class Validate{

    public static function existence($value){
        return (isset($value)  && !self::null_or_empty($value) && $value != "default" && trim($value) != "-");
    }

    private static function null_or_empty($value){
        return (empty($value) || is_null($value) || trim($value) == "");
    }


    private static function titolo(){
        if(self::existence($_POST["titolo"])){
            return true;
        }else{
            $_SESSION["errorMessage"] = "Titolo mancante";
            return false;
        }
        
    }

    private static function autore(){
        if(self::existence($_POST["autore"])){
            return true;
        }else{
            $_SESSION["errorMessage"] = "Autore mancante";
            return false;
        }
        
    }

    private static function anno(){
        if(self::existence($_POST["anno"]) && is_numeric($_POST["anno"])){
            return true;
        }else{
            $_SESSION["errorMessage"] = "Anno non valido";
            return false;
        }
        
    }

    private static function descrizione(){
        if(self::existence($_POST["descrizione"])){
            return true;
        }else{
            $_SESSION["errorMessage"] = "descrizione mancante";
            return false;
        }
        
    }

    private static function album(){
        if(self::existence($_POST["album"])){
            return true;
        }else{
            $_SESSION["errorMessage"] = "album mancante";
            return false;
        }
        
    }

    private static function bpm(){
        if(self::existence($_POST["bpm"]) && is_numeric($_POST["bpm"])){
            return true;
        }else{
            $_SESSION["errorMessage"] = "campo bpm non valido";
            return false;
        }
        
    }

    private static function genere(){
        if(self::existence($_POST["genere"]) && (in_array($_POST["genere"], Get::generi()) || $_POST["genere"] == "tutti")){
            return true;
        }else{
            $_SESSION["errorMessage"] = "genere non valido";
            return false;
        }
        
    }

    private static function tipologia(){
        if(self::existence($_POST["tipologia"]) && (in_array($_POST["tipologia"], Get::tipologie()) || $_POST["tipologia"] == "tutte")){
            return true;
        }else{
            $_SESSION["errorMessage"] = "tipologia non valida";
            return false;
        }
    }

    private static function strumenti(){
        if(isset($_POST["strumenti"])){
            $strumenti = Get::strumenti(); 
            foreach($_POST["strumenti"] as $s ){
                if(!in_array($s, $strumenti)){
                    $_SESSION["errorMessage"] = "strumenti non validi";
                    return false;
                }
            }
            return true;
        }else{
            return true;
        }
    }

    private static function setDefaultMessage(){
        $_SESSION["errorMessage"] = "inserire tutti i dati";
    }

    public static function canzone(){
        self::setDefaultMessage();
        return (  
            self::titolo() && 
            self::autore() &&
            self::anno() &&
            self::descrizione() &&
            self::album() &&
            self::bpm() &&
            self::genere() &&
            self::tipologia() &&
            self::strumenti()
        );
    }

    private static function canzoni(){
        if(isset($_POST["canzoni"])){
            $strumenti = Get::listSelfCanzoniId(); 
            foreach($_POST["canzoni"] as $s ){
                if(!in_array($s, $strumenti)){
                    $_SESSION["errorMessage"] = "Canzoni non valide";
                    return false;
                }
            }
            return true;
        }else{
            return true;
        }
    }

    private static function data(){
        if(self::existence($_POST["data"])){
            return true;
        }else{
            $_SESSION["errorMessage"] = "Data non valida";
            return false;
        }
    }

    private static function oraInizio(){
        if(self::existence($_POST["inizio"])){
            return true;
        }else{
            $_SESSION["errorMessage"] = "Ora di inizio non valida";
            return false;
        }
    }

    private static function oraFine(){
        if(self::existence($_POST["fine"])){
            return true;
        }else{
            $_SESSION["errorMessage"] = "Ora di fine non valida";
            return false;
        }
    }



    public static function scaletta(){
        self::setDefaultMessage();
        $base = true;
        if(isset($_POST["genere"])){
            $base = $base && self::genere() && self::tipologia();
        }else{
            $base = $base && self::canzoni();
        }
        return (  
            $base &&
            self::titolo() &&
            self::data() &&
            self::oraInizio() &&
            self::oraFine()
        );
    }

    public static function canzoneId(){
        if(isset($_POST["canzoneId"])){
            $conn = Database::connect();
            $query = "SELECT * FROM canzone WHERE id=? AND band_id=?"; 
            $stmt = $conn->prepare($query);
            $id = $_POST["canzoneId"];
            $stmt->bind_param("ii", $id, $_SESSION["id"]);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->num_rows > 0;
        }else{
            return false;
        }
    }

    public static function scalettaId(){
        if(isset($_POST["scalettaId"])){
            $conn = Database::connect();
            $query = "SELECT * FROM scaletta WHERE id=? AND band_id=?"; 
            $stmt = $conn->prepare($query);
            $id = $_POST["scalettaId"];
            $stmt->bind_param("ii", $id, $_SESSION["id"]);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->num_rows > 0;
        }else{
            return false;
        }
    }
}