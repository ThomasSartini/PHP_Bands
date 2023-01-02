<?php
// Includi i file necessari per questa classe
require 'application/models/Check.php';
require_once 'application/models/Get.php';
require_once 'application/models/Write.php';
require_once 'application/models/Validate.php';

// Classe Login per la gestione del login utente e la visualizzazione delle pagine
class Login {
    // Funzione per visualizzare la pagina di login o la pagina principale
    public function index(){
        // Inizializza $model come false
        $model = false;
        
        // Se le variabili POST 'password' e 'user' sono impostate, tenta di effettuare il login dell'utente
        if(isset($_POST['password']) && isset($_POST['user'])){
            $model = Check::login($_POST['user'], $_POST['password'], isset($_POST['administrator']));
        }
        
        // Se il login è riuscito, visualizza la pagina principale; altrimenti, visualizza la pagina di login
        if($model){
            $_SESSION["errorMessage"] = false;
            $this->home();
       }else{
            require 'application/views/templates/header.php';
            require 'application/views/login.php';
        }
    }

  // Funzione per visualizzare la pagina principale se la sessione è attiva
    public function home(){
        if(Check::session()){
            require 'application/views/templates/header.php';
            require 'application/views/home.php';
        }
    }

    // Funzione per visualizzare la pagina dell'elenco delle canzoni se la sessione è attiva
    public function canzoni(){
        if(Check::session()){
            require 'application/views/templates/header.php';
            require 'application/views/canzoni.php';
        }
    }

    // Funzione per visualizzare la pagina per aggiungere una canzone se la sessione è attiva
    public function addCanzone(){
        if(Check::session()){
            require 'application/views/templates/header.php';
            require 'application/views/addCanzone.php';
        }
    }

    // Funzione per visualizzare la pagina dell'elenco delle scalette se la sessione è attiva
    public function scalette(){
        if(Check::session()){
            require 'application/views/templates/header.php';
            require 'application/views/scalette.php';
        }
    }

     // Funzione per visualizzare la pagina per aggiungere una scaletta se la sessione è attiva
     public function addScaletta(){
        if(Check::session()){
            require 'application/views/templates/header.php';
            require 'application/views/addScaletta.php';
        }
    }

    // Funzione per visualizzare la pagina di una specifica canzone se la sessione è attiva e l'ID della canzone è valido
    public function canzone(){
        if(Check::session()){
            if(Validate::canzoneId()){
                require 'application/views/templates/header.php';
                require 'application/views/canzone.php';
            }else{
                $this->canzoni();
            }
        }
    }

     // Funzione per visualizzare la pagina di una specifica scaletta se la sessione è attiva e l'ID della scaletta è valido
     public function scaletta(){
        if(Check::session()){
            if(Validate::scalettaId()){
                require 'application/views/templates/header.php';
                require 'application/views/scaletta.php';
            }else{
                $this->scalette();
            }
        }
    }



    // Funzione per aggiungere una nuova canzone se la sessione è attiva e i dati della canzone sono validi
    public function writeCanzone(){
        if(Check::session()){
            if(Validate::canzone()){
                $_SESSION["errorMessage"] = false;
                Write::canzoneCompleta();
                $this->canzoni();
            }else{
                $this->addCanzone();
            }
            
        }
    }

    // Funzione per aggiungere una nuova scaletta se la sessione è attiva e i dati della scaletta sono validi
    public function writeScaletta(){
        if(Check::session()){
            if(!(isset($_POST["automatico"]) || isset($_POST["manuale"])) && Validate::scaletta()){
                $_SESSION["errorMessage"] = false;
                Write::scalettaCompleta();
                $this->scalette();
            }else{
                $this->addScaletta();
            }
            
        }
    }

    // Funzione per effettuare il logout e distruggere la sessione
    public function logout(){
        if(Check::session()){
            if(session_status() != 2){
                session_start();
            }
            session_destroy();
            require 'application/views/templates/header.php';
            require 'application/views/login.php';
        }
    }

    // Funzione per aggiungere una nuova annotazione alla canzone se la sessione è attiva
    public function writeAnnotazione(){
        if(Check::session()){
            if(isset($_POST["aggiungiAnnotazione"])){
                $_SESSION["errorMessage"] = false;
                Write::annotazione();
            }
            require 'application/views/templates/header.php';
            require 'application/views/canzone.php';
            
        }
    }


}