<?php
require_once 'Database.php';
require_once 'Filter.php';

class Write {

    private static function readData(){
        $data = [];
        $data["titolo"] = Filter::string($_POST["titolo"]);
        $data["autore"] = Filter::string($_POST["autore"]);
        $data["anno"] = Filter::string($_POST["anno"]);
        $data["descrizione"] = Filter::string($_POST["descrizione"]);
        $data["audio"] = Filter::string($_POST["audio"]);
        $data["testo"] = Filter::string($_POST["testo"]);
        $data["album"] = Filter::string($_POST["album"]);
        $data["bpm"] = Filter::string($_POST["bpm"]);
        $data["genere"] = Filter::string($_POST["genere"]);
        $data["tipologia"] = Filter::string($_POST["tipologia"]);
       return $data;
    }

    private static function canzone(){
        $data = self::readData();
        $conn = Database::connect();
        $query = "INSERT INTO canzone(titolo, autore, anno, descrizione, audio, testo, album, bpm, genere, tipologia, band_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"; 
        $stmt = $conn->prepare($query); 
        $stmt->bind_param("ssissssissi", $data["titolo"], $data["autore"], $data["anno"],$data["descrizione"], $data["audio"], $data["testo"], $data["album"], $data["bpm"],$data["genere"], $data["tipologia"], $_SESSION["id"]);
        $stmt->execute();
        return $conn->insert_id;
    }

    private static function strumenti($id){
        if(isset($_POST["strumenti"])){ 
            $conn = Database::connect();
            foreach($_POST["strumenti"] as $strumento){
                $query = "INSERT INTO strumento_canzone(strumentoNome, canzone_id) VALUES (?, ?);"; 
                $stmt = $conn->prepare($query); 
                $s = Filter::string($strumento);
                $stmt->bind_param("si", $s, $id);
                $stmt->execute();
            }
        }
    }

    public static function canzoneCompleta(){
        self::strumenti(self::canzone());
    }


    private static function scaletta(){
        $conn = Database::connect();
        $query = "INSERT INTO scaletta(nome, band_id, data, ora_inizio, ora_fine) VALUES(?, ?, ?, ?, ?);"; 
        $stmt = $conn->prepare($query); 
        $titolo = Filter::string($_POST["titolo"]);
        $date = Filter::string($_POST["data"]);
        $inizio = Filter::string($_POST["inizio"]);
        $fine = Filter::string($_POST["fine"]);
        $stmt->bind_param("sisss", $titolo, $_SESSION["id"], $date, $inizio, $fine);
        $stmt->execute();
        return $conn->insert_id;
    }

    private static function canzoni($id){
        if(isset($_POST["canzoni"])){ 
            $conn = Database::connect();
            foreach($_POST["canzoni"] as $canzone){
                $query = "INSERT INTO scaletta_canzone(canzone_id, scaletta_id) VALUES (?, ?);"; 
                $stmt = $conn->prepare($query); 
                $c = Filter::string($canzone);
                $stmt->bind_param("ii", $c, $id);
                $stmt->execute();
            }
        }
    }

    public static function scalettaCompleta(){
        self::canzoni(self::scaletta());
    }



}