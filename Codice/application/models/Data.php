<?php

class data {

    /**
     * Questa funzione pulisce i dati di una singola riga di una tabella del database e restituisce il valore del campo specificato.
     *
     * @param $result è il risultato della query al database
     * @param $field è il nome del campo da restituire
     * @return string il valore del campo specificato
     */
    public static function cleanSingleData($result, $field) {
        $return = ""; 
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $return = $row[$field];     
        }
        return $return;
    }

    /**
     * Questa funzione pulisce i dati di tutte le righe di una tabella del database e restituisce un array di array associativi, dove ogni elemento rappresenta una riga.
     *
     * @param $result è il risultato della query al database
     * @return array l'array di righe della tabella
     */
    public static function cleanAllData($result) {
        $return = []; 
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $return[] = $row;
            }
        }
        return $return;
    }

    /**
     * Questa funzione genera una stringa HTML con una lista di opzioni per una select, a partire da un array di stringhe.
     *
     * @param $list è l'array di stringhe da utilizzare come opzioni
     * @return string la stringa HTML con le opzioni
     */
    public static function getSelect($list) {
        $str = "";
        foreach($list as $l){
            $str .= "<option value='".$l."'>".$l."</option>";
        }
        return $str;
    }

    /**
     * Questa funzione pulisce i dati di una tabella del database e restituisce un array con i valori di un determinato campo, per ogni riga.
     *
     * @param $result è il risultato della query al database
     * @param $field è il nome del campo da restituire
     * @return array l'array con i valori del campo specificato
     */
    public static function cleanData($result, $field) {
        $return = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $return[] = $row[$field];
            }
        }
        return $return;
    }

    /**
     * Questa funzione stampa a schermo una serie di checkbox, con etichette uguali agli elementi dell'array fornito.
     * 
     * @param $list è l'array di stringhe da utilizzare come etichette per le checkbox
     * @param $type è il nome da utilizzare per le checkbox (si riferisce al valore del campo 'name' nell'HTML)
     */
    public static function printCheckBox($list, $type){
        foreach($list as $l){
            $name = $type."[]";
            echo "<input type='checkbox' name='$name' value='$l'>";
            echo "<label style='margin-left:5px'>$l</label>";
            echo "<br>";
        }
    }

    /* Questa funzione stampa a schermo una serie di checkbox, con etichette uguali ai valori di un determinato campo per ogni elemento dell'array fornito.
    *
    * @param $list è l'array di elementi da utilizzare come fonte di dati per le checkbox
    * @param $type è il nome da utilizzare per le checkbox (si riferisce al valore del campo 'name' nell'HTML)
    * @param $field è il nome del campo da utilizzare come etichetta per le checkbox
    */
    public static function printCompleteCheckBox($list, $type, $field) {
        foreach($list as $l){
            $name = $type."[]";
            echo "<input type='checkbox' name='$name' value='".$l['id']."'>";
            echo "<label style='margin-left:5px'>".$l[$field]."</label>";
            echo "<br>";
        }
    }

}