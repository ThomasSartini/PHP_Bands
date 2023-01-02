<?php

// Classe home per visualizzare la pagina principale o la pagina di login
class home{
    // Funzione per visualizzare la pagina principale o la pagina di login
    public function index(){
        if (isset($_SESSION['user']) && isset($_SESSION['check'])) {
            require 'application/views/home/index.php';
        } else {
            require 'application/views/login/index.php';
        }
    }
}

?>