<?php
    namespace controllers;
    use core\mvc as mvc;

    class User extends mvc\Controller{

        public function index(){
            $this->title = "Login";
            echo "Rodrigo usuario";
        }#endFunction

    }