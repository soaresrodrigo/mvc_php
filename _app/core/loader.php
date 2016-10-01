<?php
    if(!defined('PATH')){die;}
    session_start();

    if(!defined('DEBUG') || DEBUG === false){
        error_reporting(0);
        ini_set("display_errors", 0);
    }else{
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    }

    function __autoload($class){
        $result = null;
        $file = PATH . "/_app/" . str_replace("\\", "/", $class) . ".php";

        if(!$result && file_exists($file) && !is_dir($file)){
            include_once $file;
            $result = true;
        }elseif(!$result){
            trigger_error("Não foi possível incluir {$file}", E_USER_ERROR);
            die;
        }
    }

        //PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? MS_INFOR : ($ErrNo == E_USER_WARNING ? MS_ALERT : ($ErrNo == E_USER_ERROR ? MS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

//WSErro :: Exibe erros lançados :: Front
function MSErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? MS_INFOR : ($ErrNo == E_USER_WARNING ? MS_ALERT : ($ErrNo == E_USER_ERROR ? MS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";

    if ($ErrDie):
        die;
    endif;
}
// Altera os erros padroes do php
set_error_handler('PHPErro');

$iniciaAplicacao = new core\mvc\App;