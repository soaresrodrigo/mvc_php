<?php
    namespace controllers;
    use core\mvc as mvc;
    use models;

    class User extends mvc\Controller{

        function __construct(){
            $this->login = new models\Login(1);
        }

        public function index(){                       
            $this->title = "Principal";
            $this->content = 'user/home';
            require_once PATH . '/_user/includes/masterUser.php';      
        }#endFunction

    }