
<?php
require_once 'Database.php';

class Get{

    /**
     * Questa funzione restituisce l'indirizzo IP dell'utente che ha effettuato la richiesta HTTP.
     *
     * @return string l'indirizzo IP dell'utente
     */
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

    /**
     * Questa funzione restituisce la data e l'ora corrente nel formato "Y-m-d H:i:s" e nel fuso orario "Europe/Zurich".
     *
     * @return string la data e l'ora correnti nel formato specificato
     */
    public static  function currentDate(){
        return (new Datetime('now', new DateTimeZone('Europe/Zurich')))->format("Y-m-d H:i:s");
    }


    /**
     * Questa funzione restituisce un array con le informazioni su tutte le canzoni appartenenti al gruppo musicale correntemente autenticato.
     *
     * @return array un array con le informazioni su tutte le canzoni del gruppo musicale
     */
    public static function listSelfCanzoni(){
        $query = "SELECT * FROM canzone WHERE band_id=".$_SESSION["id"]; 
        $result = Database::query($query);
        return Data::cleanAllData($result);
    }

     /**
     * Questa funzione restituisce un array con gli ID di tutte le canzoni appartenenti al gruppo musicale correntemente autenticato.
     *
     * @return array un array con gli ID di tutte le canzoni del gruppo musicale
     */
    public static function listSelfCanzoniId(){
        $query = "SELECT id FROM canzone WHERE band_id=".$_SESSION["id"]; 
        $result = Database::query($query);
        return Data::cleanData($result, "id");
    }

    /**
     * Questa funzione stampa una tabella HTML con le informazioni su tutte le canzoni passate come parametro.
     *
     * @param array $data un array con le informazioni su tutte le canzoni da visualizzare nella tabella
     */
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

    /**
     * Questa funzione restituisce un array con tutti i generi musicali presenti nel database.
     *
     * @return array un array con tutti i generi musicali presenti nel database
     */
    public static function generi(){
        if(Check::session()){
            $query = "SELECT genere from genere";
            $result = Database::query($query);
            return Data::cleanData($result, "genere");
        }
    }

     /**
     * Questa funzione restituisce un array con tutte le tipologie di evento presenti nel database.
     *
     * @return array un array con tutte le tipologie di evento presenti nel database
     */
    public static function tipologie(){
        if(Check::session()){
            $query = "SELECT tipologia from tipologia";
            $result = Database::query($query);
            return Data::cleanData($result, "tipologia");
        }
    }

     /**
     * Questa funzione restituisce un array con tutti gli strumenti presenti nel database.
     *
     * @return array un array con tutti gli strumenti presenti nel database
     */
    public static function strumenti(){
        if(Check::session()){
            $query = "SELECT strumento from strumento";
            $result = Database::query($query);
            return Data::cleanData($result, "strumento");
        }
    }

         /**
     * Questa funzione restituisce il testo di una canzone a partire dall'ID della canzone e dall'ID del gruppo musicale correntemente autenticato.
     *
     * @return string il testo della canzone
     */
    private static function canzone(){
        $conn = Database::connect();
       // $idCanzone =  Filter::string($_POST["idCanzone"]);
        $idCanzone= 1;
        $query = "SELECT testo FROM canzone where band_id = ". $_SESSION["id"] ." and id =".$idCanzone .";"; 
        $result = Database::query($query);
        return  Data::cleanData($result, "testo");
    }


    /**
     * Questa funzione stampa una tabella HTML con le informazioni sulla canzone selezionata.
     */
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

    /**
     * Questa funzione restituisce tutte le scalette create dal gruppo musicale correntemente loggato.
     *
     * @return array un array di array, dove ogni elemento rappresenta una scaletta con i suoi campi
     */
    public static function listSelfScalette(){
        $query = "SELECT * FROM scaletta WHERE band_id=".$_SESSION["id"]; 
        $result = Database::query($query);
        return Data::cleanAllData($result);
    }

    /**
     * Questa funzione stampa una tabella HTML contenente le scalette create dal gruppo musicale correntemente loggato.
     * La tabella ha una colonna per il nome della scaletta, una per la data, una per l'ora di inizio e una per l'ora di fine.
     * C'è anche un pulsante "Dettagli" per ogni riga della tabella, che permette di visualizzare ulteriori informazioni sulla scaletta.
     */
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

    /**
     * Questa funzione restituisce tutte le canzoni presenti nella scaletta specificata tramite l'ID della scaletta.
     *
     * @return array un array di array, dove ogni elemento rappresenta una canzone con i suoi campi
     */
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


    /**
     * Questa funzione restituisce il nome della scaletta specificata tramite l'ID della scaletta.
     *
     * @return string il nome della scaletta
     */
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

     /**
     * Questa funzione restituisce il titolo della canzone specificata tramite l'ID della canzone.
     *
     * @return string il titolo della canzone
     */
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

    
    /**
     * Questa funzione stampa in una tabella tutte le band presenti nel database.
     */
    public static function bandsTable(){
        $query = "SELECT user FROM band";
        $result = Database::query($query);
        $bands = Data::cleanData($result, "user");
        echo "<table class='table table-striped'>";
        echo "<tr>";
        echo "<th>Nome</th>";
        echo "</tr>";

        foreach($bands as $b){
            echo "<tr>";
            echo "<td>".$b."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

}