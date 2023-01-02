
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
        $query = "SELECT * FROM canzone WHERE bandId=".$_SESSION["id"]; 
        $result = Database::query($query);
        return Data::cleanAllData($result);
    }

    public static function listSelfCanzoniId(){
        $query = "SELECT id FROM canzone WHERE bandId=".$_SESSION["id"]; 
        $result = Database::query($query);
        return Data::cleanData($result, "id");
    }

    public static function canzoniTable(){
        $data = self::listSelfCanzoni();
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
        $query = "SELECT testo FROM canzone where bandId = ". $_SESSION["id"] ." and id =".$idCanzone .";"; 
        $result = Database::query($query);
        return  Data::cleanData($result, "testo");
    }


    public static function canzoneTable(){
        $data = self::canzone();
        $canzone = (explode(" ",$data[0]));
        $parole =0;
        $start= true;
        echo "<table class='table table-striped'>";
        echo "<tr>";
        for($i =0;  $i <= 4;$i++){
            echo "<th></th>";
        }

        for ($i = 0; $i < count($canzone); $i++) {
            if ($i % 5 == 0) {
              echo '<tr>';
            }
            echo '<td>' . $canzone[$i] . '</td>';
            if ($i % 5 == 4) {
              echo '</tr>';
              for($j =0;  $j <= 4;$j++){
                echo "<th></th>";
                }
            }
          }
        echo "</table>";
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
        echo "<th class='float-right'>Dettagli</th>";
        echo "</tr>";

        foreach($data as $sca){
            echo "<tr>";
            echo "<td>".$sca["nome"]."</td>";
            echo "<td><button type='submit' name='scalettaId' value='".$sca["id"]."' class='float-right'>Dettagli</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

}