<?php 
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $this->title; ?></title>
    <link rel="stylesheet" href='<?= HOME . "/_includes/css/boot.css"; ?>'/>
    <link rel="stylesheet" href='<?= HOME . "/_user/css/menu.css"; ?>'/>
    <script src='<?= HOME . "/_includes/js/jquery.js"; ?>' ></script>
</head>
<body class="bg-imagem">

    <!-- MENU PRINCIPAL -->
    <header class="menu_principal">
        <h1 class="fontezero">Menu principal</h1>
        <figure class="menu_logo">
            <img src='<?= HOME . "/_user/img/logotipo.png" ?>' alt="Logotipo">
        </figure>
        <nav class="menu_links">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Content</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- CORPO -->
    <section><?php  $this->view($this->content); ?></section>

    <!-- RODAPE PRINCIPAL -->
    <footer></footer>    

</body>
</html>