<?php

class Database {

    // Indirizzo del server del database
    private static $HOST = "localhost";
    // Nome dell'utente per la connessione
    private static $USER = "root";
    // Password dell'utente per la connessione
    private static $PASS = "";
    // Nome del database da utilizzare
    private static $DB = "bands";

    /**
     * Questa funzione crea e restituisce un nuovo oggetto mysqli per la connessione al database.
     *
     * @return mysqli l'oggetto per la connessione al database
     */
    public static function connect() {
        return new mysqli(self::$HOST, self::$USER, self::$PASS, self::$DB);
    }

    /**
     * Questa funzione esegue la query specificata sulla connessione al database aperta dalla funzione `connect()` e restituisce il risultato della query.
     * Inoltre, chiude la connessione al database prima di restituire il risultato.
     *
     * @param string $query la query da eseguire
     * @return mixed il risultato della query
     */
    public static function query($query) {
        $conn = self::connect();
        $result = $conn->query($query);
        mysqli_close($conn);
        return $result;
    }

}
