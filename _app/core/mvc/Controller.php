<?php
    namespace core\mvc;

    abstract class Controller{

        protected $title;
        protected $login = null;

        protected function model($dir, $model){
            # Your code here...
        }#endFunction

        protected function view($view, $data = []){
            require_once PATH . "/_app/views/{$view}.php";
        }#endFunction

    }