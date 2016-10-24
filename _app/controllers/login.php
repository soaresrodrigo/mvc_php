<?php
    namespace controllers;
    use core\mvc as mvc;
    use models;

    class Login extends mvc\Controller{

        function __construct(){
            $this->login = new models\Login(0);
        }

        public function index(){        
            $this->title = "Login";
            $this->view('login/login');           
        }#endFunction

    }