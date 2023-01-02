<?php 
class Filter {
    /**
     * Questa funzione pulisce una stringa rimuovendo i caratteri speciali e le eventuali tag HTML.
     *
     * @param string $str la stringa da pulire
     * @return string la stringa pulita
     */
    public static function string($str) {
        $str = filter_var($str, FILTER_SANITIZE_STRING);
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }
}
?>
