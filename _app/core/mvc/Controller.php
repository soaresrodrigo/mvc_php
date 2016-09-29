<?php
    namespace core\mvc;
    use models;

    abstract class Controller{
        protected $title;
        protected $login = null;
        protected $level = null;

        function __construct($level){
            $this->level = $level;
            $this->login = new models\Login($this->level);
        }

        protected function model($dir, $model){
            # Your code here...
        }#endFunction

        protected function view($view, $data = []){
            require_once PATH . "/_app/views/{$view}.php";
        }#endFunction

    }