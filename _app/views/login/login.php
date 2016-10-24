<?php
    if($this->login->checkLogin()){
        $this->login->redirectUser();
        exit;
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
    <script src='<?= HOME . "/_includes/js/config.js"; ?>' ></script>
</head>
<body>
    <section class="bg-imagem window">
        <!-- NOTIFICAÇÃO DE LOGIN USUARIO -->
        <header>
            <article class="notify jq_right">
                <?php
                $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if(!empty($dataLogin['userLogin'])){
                    $this->login->exeLogin($dataLogin);                    
                    if(!$this->login->getResult()){
                        MSErro($this->login->getError()[0], $this->login->getError()[1]);
                    }else{
                        MSErro("Olá, seja bem-vindo(a) <b>{$_SESSION['userLogin']['user_name']}</b>!", MS_LOAD);
                        switch($_SESSION['userLogin']['user_level']){
                            case 1:
                                header( "refresh:3;url=" . HOME . "user");
                                break;
                            case 2:
                                header("refresh:3;url= " . HOME . "gerente");
                                break;
                            case 3:
                                header("refresh:3;url=" . HOME . "admin");
                                break;                    
                        }
                    }
                }
            ?>
            </article>

            <article>
            <?php
                $get = base64_decode(filter_input(INPUT_GET, 'exe', FILTER_DEFAULT)); 
                if(!empty($get)){
                    if($get == ('restrito')){
                        MSErro("<b>Acesso negado</b>. Convêm logar no sistema!", MS_ERROR);
                    }elseif($get == ('logoff')){
                        $usuario = base64_decode(filter_input(INPUT_GET, 'u', FILTER_DEFAULT));
                            MSErro("Sucesso ao deslogar <b>{$usuario}</b>. Volte sempre!", MS_ACCEPT);
                    }
                }
            ?>
        </article>            
        </header>

        <!-- FORMULARIO DE LOGIN USUARIO -->
        <article class="login">
            <figure>
                <img src='<?= HOME . "/_includes/icon/logotipo.png" ?>' >
            </figure>
            <form  id="formLogin" name="formLogin" action="" method="post">

                <label for="user">Email</label>
                <input class="icon icon-mail" type="email" name="user"   placeholder="Informe seu email" value='<?= $dataLogin['user'] ?>'>
                <label for="pass">Senha</label>
                <input class='icon icon-pass' type="password"   name="pass" placeholder="******" >
                <input type="submit" name="userLogin" class="botao radius"  value="Entrar">

            </form>
            <div class="clear"></div>
        </article>
    </section>
</body>
</html>