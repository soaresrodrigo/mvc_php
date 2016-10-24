<?php
    namespace controllers;
    use core\mvc as mvc;
    use models;

    class Register extends mvc\Controller{

        public function index(){                       
            $this->title = "Cadastrar";
            $this->content = 'default/register';
            require_once PATH . '/_default/includes/masterDefault.php';      
        }#endFunction

    }