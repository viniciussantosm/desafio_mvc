<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Um blog para você compartilhar suas experiências">
    <meta name="author" content="Vinicius Santos">
    <meta name="keywords" content="blog, experiências, blogueiro, blogueira, criador de conteúdo">
    <title>BloggerO</title>
    <link rel="stylesheet" href="http://<?=$server["host"]?>/css/styles.css">
    <link rel="icon" type="image/x-icon" href="http://<?=$server["host"]?>/img/favicon.ico">
</head>
<body>
    <nav>
        <ul>
            <li><a href="http://<?=$server["host"]?>/posts/index">Home</a></li>
            <li><a href="http://<?=$server["host"]?>/categories/index">Categorias</a></li>
            <li><a href="http://<?=$server["host"]?>/tags/index">Tags</a></li>
            <?php
                use App\Model\Session;
                if(Session::isLoggedIn()):
            ?>
                <li><a href="http://<?=$server["host"]?>/dashboard/index">Dashboard</a></li>
                <li><span>Bem-vindo,</span> <?=Session::getName()?> / <a href="http://<?=$server["host"]?>/auth/logout">Sair</a></li>
            <?php else: ?>
                <li><a href="http://<?=$server["host"]?>/auth/index">Login</a></li>
                <li><a href="http://<?=$server["host"]?>/auth/register">Registrar</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php
        if(Session::getMessage() !== null) {
            require_once("flash-message.php");
        }
     ?>