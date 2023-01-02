<?php
    class home{
        public function index(){
            if (isset($_SESSION['user']) && isset($_SESSION['check'])) {
                require 'application/views/home/index.php';
            } else {
                require 'application/views/login/index.php';
            }
        }

    }
?>