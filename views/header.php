<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Um blog para você compartilhar suas experiências">
    <meta name="author" content="Vinicius Santos">
    <meta name="keywords" content="blog, experiências, blogueiro, blogueira, criador de conteúdo">
    <title>BloggerO</title>
    <link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/css/styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/posts/index">Home</a></li>
            <li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/categories/index">Categorias</a></li>
            <li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/tags/index">Tags</a></li>
            <?php if(isset($_SESSION["isLoggedIn"])): ?>
                <li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/users/index">Meus Posts</a></li>
                <li><span>Bem-vindo,</span> <a href="http://<?=$_SERVER["HTTP_HOST"]?>/users/edit/<?=$_SESSION["userId"]?>"><?=$_SESSION["name"]?></a> / <a href="http://<?=$_SERVER["HTTP_HOST"]?>/auth/logout">Sair</a></li>
            <?php else: ?>
                <li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/auth/login">Login</a></li>
                <li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/auth/register">Registrar</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php if(isset($_SESSION["message"])): ?>
    <div class="flash-message-container">
        <div class="flash-message <?=$_SESSION["message"]["type"]?>">
            <p><?php
                echo $_SESSION["message"]["value"];
                unset($_SESSION["message"]);
            ?></p>
        </div>
    </div>
    <?php endif; ?>