
<?php
require_once 'Database.php';

class Get{

    public static  function ipAddress(){
        if(getenv('HTTP_CLIENT_IP')){
            return getenv('HTTP_CLIENT_IP');
        }else if(getenv('HTTP_X_FORWARDED_FOR')){
            return getenv('HTTP_X_FORWARDED_FOR');
        }else if(getenv('HTTP_X_FORWARDED')){
            return getenv('HTTP_X_FORWARDED');
        }else if(getenv('HTTP_FORWARDED_FOR')){
            return getenv('HTTP_FORWARDED_FOR');
        }else if(getenv('HTTP_FORWARDED')){
            return getenv('HTTP_FORWARDED');
        }else if(getenv('REMOTE_ADDR')){
            return getenv('REMOTE_ADDR');
        }else{
            return'UNKNOWN';
        }
    }

    public static  function currentDate(){
        return (new Datetime('now', new DateTimeZone('Europe/Zurich')))->format("Y-m-d H:i:s");
    }


    public static function listSelfCanzoni(){
        $query = "SELECT * FROM canzone WHERE band_id=".$_SESSION["id"]; 
        $result = Database::query($query);
        return Data::cleanAllData($result);
    }

    public static function listSelfCanzoniId(){
        $query = "SELECT id FROM canzone WHERE band_id=".$_SESSION["id"]; 
        $result = Database::query($query);
        return Data::cleanData($result, "id");
    }

    public static function canzoniTable($data){
        echo "<table class='table table-striped'>";
        echo "<tr>";
        echo "<th>Titolo</th>";
        echo "<th>Autore</th>";
        echo "<th>Genere</th>";
        echo "<th class='float-right'>Dettagli</th>";
        echo "</tr>";

        foreach($data as $can){
            echo "<tr>";
            echo "<td>".$can["titolo"]."</td>";
            echo "<td>".$can["autore"]."</td>";
            echo "<td>".$can["genere"]."</td>";
            echo "<td><button type='submit' name='canzoneId' value='".$can["id"]."' class='float-right'>Dettagli</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public static function generi(){
        if(Check::session()){
            $query = "SELECT genere from genere";
            $result = Database::query($query);
            return Data::cleanData($result, "genere");
        }
    }

    public static function tipologie(){
        if(Check::session()){
            $query = "SELECT tipologia from tipologia";
            $result = Database::query($query);
            return Data::cleanData($result, "tipologia");
        }
    }

    public static function strumenti(){
        if(Check::session()){
            $query = "SELECT strumento from strumento";
            $result = Database::query($query);
            return Data::cleanData($result, "strumento");
        }
    }

    private static function canzone(){
        $conn = Database::connect();
       // $idCanzone =  Filter::string($_POST["idCanzone"]);
        $idCanzone= 1;
        $query = "SELECT testo FROM canzone where band_id = ". $_SESSION["id"] ." and id =".$idCanzone .";"; 
        $result = Database::query($query);
        return  Data::cleanData($result, "testo");
    }


    public static function canzoneTable(){
        $conn = Database::connect();
        $query = "SELECT testo FROM canzone WHERE id =?";
        $stmt = $conn->prepare($query);
        $id = $_POST["canzoneId"];
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $testo_canzone = $row['testo'];
        $righe = explode("\n", $testo_canzone);
        foreach ($righe as $i => $riga) {
            echo ($i+1) . ". ";
        
            $query = "SELECT testo FROM annotazione WHERE canzone_id =? AND posizione = $i";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $annotazioni = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
            foreach ($annotazioni as $annotazione) {
                echo "<span>" . $annotazione['testo'] . "</span> ";
            }
        
            echo $riga . "\n";
        }
    }

    public static function listSelfScalette(){
        $query = "SELECT * FROM scaletta WHERE band_id=".$_SESSION["id"]; 
        $result = Database::query($query);
        return Data::cleanAllData($result);
    }

    public static function scaletteTable(){
        $data = self::listSelfScalette();
        echo "<table class='table table-striped'>";
        echo "<tr>";
        echo "<th>Nome</th>";
        echo "<th>Data</th>";
        echo "<th>Ora di inizio</th>";
        echo "<th>Ora di fine</th>";
        echo "<th class='float-right'>Dettagli</th>";
        echo "</tr>";

        foreach($data as $sca){
            echo "<tr>";
            echo "<td>".$sca["nome"]."</td>";
            echo "<td>".$sca["data"]."</td>";
            echo "<td>".$sca["ora_inizio"]."</td>";
            echo "<td>".$sca["ora_fine"]."</td>";
            echo "<td><button type='submit' name='scalettaId' value='".$sca["id"]."' class='float-right'>Dettagli</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public static function listCanzoniScaletta(){
        $conn = Database::connect();
        $query = "SELECT * FROM canzone WHERE id IN(SELECT canzone_id FROM scaletta_canzone WHERE scaletta_id=?)"; 
        $stmt = $conn->prepare($query);
        $id = $_POST["scalettaId"];
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return Data::cleanAllData($result);
    }

    public static function scalettaNome(){
        $conn = Database::connect();
        $query = "SELECT nome FROM scaletta WHERE id=?"; 
        $stmt = $conn->prepare($query);
        $id = $_POST["scalettaId"];
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return Data::cleanSingleData($result, "nome");
    }

    public static function canzoneTitolo(){
        $conn = Database::connect();
        $query = "SELECT titolo FROM canzone WHERE id=?"; 
        $stmt = $conn->prepare($query);
        $id = $_POST["canzoneId"];
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return Data::cleanSingleData($result, "titolo");
    }

}