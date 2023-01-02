<?php
require 'application/models/Check.php';
require_once 'application/models/Get.php';
require_once 'application/models/Write.php';
require_once 'application/models/Validate.php';
class Login {
    public function index(){
        $model = false;
        if(isset($_POST['password']) && isset($_POST['user'])){
            $model = Check::login($_POST['user'], $_POST['password'], isset($_POST['administrator']));
        }
        
        if($model){
            $_SESSION["errorMessage"] = false;
            $this->home();
       }else{
            require 'application/views/templates/header.php';
            require 'application/views/login.php';
        }
    }

    public function home(){
        if(Check::session()){
            require 'application/views/templates/header.php';
            require 'application/views/home.php';
        }
    }

    public function canzoni(){
        if(Check::session()){
            require 'application/views/templates/header.php';
            require 'application/views/canzoni.php';
        }
    }

    public function addCanzone(){
        if(Check::session()){
            require 'application/views/templates/header.php';
            require 'application/views/addCanzone.php';
        }
    }

    public function scalette(){
        if(Check::session()){
            require 'application/views/templates/header.php';
            require 'application/views/scalette.php';
        }
    }

    public function writeCanzone(){
        if(Check::session()){
            if(Validate::canzone()){
                $_SESSION["errorMessage"] = false;
                Write::all();
                $this->canzoni();
            }else{
                $this->addCanzone();
            }
            
        }
    }

    public function logout(){
        if(Check::session()){
            session_start();
            session_destroy();
            require 'application/views/login.php';
        }
    }


}