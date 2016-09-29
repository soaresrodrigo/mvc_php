<?php
    namespace controllers;
    use core\mvc as mvc;
    use models;

    class Admin extends mvc\Controller{

        function __construct(){
            parent::__construct(3);
        }

        public function index(){            
            $this->title = "Principal";
            echo "Bem vindo adm";   
        }#endFunction

    }