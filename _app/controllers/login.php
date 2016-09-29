<?php
    namespace controllers;
    use core\mvc as mvc;

    class Login extends mvc\Controller{

        function __construct(){
            parent::__construct(0);
        }

        public function index(){        
            $this->title = "Login";
            $this->view('login/login');           
        }#endFunction

    }