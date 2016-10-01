<?php
    namespace models;
    use core\conn as conn;
    class Login{

        private $level;
        private $email;
        private $pass;
        private $result;
        private $error;

        function __construct($level){
            $this->level = (int) $level;
        }

        // PUBLIC METHODS
        public function exeLogin(array $userData){
            $this->email =(string) strip_tags(trim($userData['user']));
            $this->pass = (string) strip_tags(trim($userData['pass']));
            $this->setLogin();
        }#endFunction    

        public function getResult(){
            return $this->result;
        }#endFunction

        public function getError(){
            return $this->error;
        }#endFunction

        public function checkLogin(){
            $this->levelUser();
            if(empty($_SESSION['userLogin']) || $_SESSION['userLogin']['user_level'] != $this->level){
                unset($_SESSION['userLogin']);
                return false;
            }else{
                return true;
            }
        }#endFunction

        public function redirectUser(){
            switch($_SESSION['userLogin']['user_level']){
                case 1:
                     header("Location: " . HOME . "user");
                     break;
                case 2:
                    header("Location: " . HOME . "gerente");
                    break;
                case 3:
                    header("Location: " . HOME . "admin");
                    break;                    
            }
        }

        // PRIVATE METHODS
        private function setLogin(){
           if(!$this->email || !$this->pass){
               $this->error = ['Informe seu E-mail e senha para efetuar o login', MS_ALERT];
               $this->result = false;
           }elseif(!$this->getUser()){
               $this->error = ['Os dados informados não são compatíveis', MS_INFOR];
                $this->result = false;
           }elseif($this->result['user_level'] != $this->level && $this->level != 0){
               $this->error = ["Desculpe {$this->result['user_name']}, mas você não tem permissão para acessar está área!", MS_ERROR]; 
               $this->result = false;
           }else{
               if($this->level == 0){
                   $this->level = $this->result['user_level'];
               }
               $this->Execute();
           }
          
        }#endFunction

        private function getUser(){
            $this->pass = md5($this->pass);
            $read = new conn\Read;
            $read->exeRead('users', "WHERE user_email = :e AND user_password = :p", "e={$this->email}&p={$this->pass}");
            if($read->getResult()){
                $this->result = $read->getResult()[0];
                return true;
            }
        }#endFunction

        private function Execute(){
            if(!session_id()){
                session_start();
            }
            $_SESSION['userLogin'] = $this->result;
            $this->error = ["Olá {$this->result['user_name']}, seja bem vindo(a). Aguarde redirecionamento", MS_ACCEPT];
            $this->result = true;
        }

        private function levelUser(){
            if($this->level == 0){
                if(!empty($_SESSION['userLogin'])){
                    $this->level = $_SESSION['userLogin']['user_level'];
                }                
            }
        }

    }#endClass