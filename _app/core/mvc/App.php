<?php
    namespace core\mvc;
    use controllers;

    class App{

        private $controller = 'login';
        private $method = 'index';
        private $params;
        private $result = null;

        // PUBLIC METHODS
        function __construct(){
            $url = $this->parseUrl();

            // NOT FOUND
            $index = (PATH . "/_app/controllers/.php");
            if ((PATH . "/_app/controllers/{$url[0]}.php") != $index and !file_exists(PATH . "/_app/controllers/{$url[0]}.php")):
                echo "Pagina nao existe";
                die;
            endif;

            // PAGE CONTROLLERS
            if(file_exists(PATH . "/_app/controllers/{$url[0]}.php")){
                $this->controller = $url[0];
                unset($url[0]);
            }
            require_once PATH . "/_app/controllers/{$this->controller}.php";
            $controller = 'controllers\\'.$this->controller;
            $this->controller = new $controller;

            // PAGE METHODS
            if(isset($url[1])){
                if(method_exists($this->controller, $url[1])){
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }
            // PAGE PARAMS
            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->controller, $this->method], $this->params);

        }#endConstruct

        // PRIVATE METHODS
        private function parseUrl(){
            if(isset($_GET['url'])){
                return $url = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            }
        }#endFunction

    }#endClass