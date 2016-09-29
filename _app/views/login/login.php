<?php
    if($this->login->checkLogin()){
        header("Location: " . HOME . "user");
    }
    $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if(!empty($dataLogin['userLogin'])){
                    $this->login->exeLogin($dataLogin);
                    if(!$this->login->getResult()){
                        MSErro($this->login->getError()[0], $this->login->getError()[1]);
                    }
                    $level  = $this->login->getResult()['user_level'] ;
                    if($level == 1){
                        header("Location: " . HOME . "user");
                    }elseif($level == 2){
                        header("Location: " . HOME . "gerente");
                    }elseif($level == 3){
                        header("Location: " . HOME . "admin");
                    }
                }

                $get = base64_decode(filter_input(INPUT_GET, 'exe', FILTER_DEFAULT)); 
                if(!empty($get)){
                    if($get == ('restrito')){
                        MSErro('<b>Acesso negado</b>. Convém logar no sistema.', MS_ERROR);
                    }elseif($get == ('logoff')){
                        $usuario = base64_decode(filter_input(INPUT_GET, 'u', FILTER_DEFAULT));
                            MSErro("<b>Sucesso ao deslogar</b>. Volte sempre {$usuario}.", MS_ACCEPT);
                    }
                }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $this->title ?></title>
    <link rel="stylesheet" href='<?= HOME . "/_includes/css/boot.css"; ?>'/>
    <link rel="stylesheet" href='<?= HOME . "/_includes/css/login.css" ;?>'/>
    <script src='<?= HOME . "/_includes/js/jquery.js"; ?>' ></script>
    <script src='<?= HOME . "/_includes/js/main.js"; ?>' ></script>
</head>
<body class="bg-imagem">
    <section>
        <!-- NOTIFICAÇÃO DE LOGIN USUARIO -->
        <aside class="notify">
        </aside>

        <!-- FORMULARIO DE LOGIN USUARIO -->
        <article class="login">
                <figure>
                    <img src='<?= HOME . "/_includes/icon/logotipo.png" ?>' >
                </figure>

                <form  id="formLogin" name="formLogin" action="" method="post">

                    <label for="user">Email</label>
                    <input class="icon icon-mail" type="email" name="user" required title="informe seu email"  placeholder="Informe seu email" value="">

                    <label for="pass">Senha</label>
                    <input class='icon icon-pass' type="password" required title="Informe sua senha" name="pass" placeholder="******" >

                    <input type="submit" name="userLogin" class="botao radius"  value="Entrar">

                </form>
                <div class="clear"></div>
            </article>
    </section>
</body>
</html>