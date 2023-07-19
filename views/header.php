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
    <link rel="icon" type="image/x-icon" href="http://<?=$_SERVER["HTTP_HOST"]?>/img/favicon.ico">
</head>
<body>
    <nav>
        <ul>
            <li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/posts/index">Home</a></li>
            <li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/categories/index">Categorias</a></li>
            <li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/tags/index">Tags</a></li>
            <?php
                use App\Model\Session;
                // var_dump(Session::getUserId());
                if(Session::isLoggedIn()):
            ?>
                <!-- <li><span>Bem-vindo,</span> <a href="http://<?=$_SERVER["HTTP_HOST"]?>/users/edit/<?=Session::getUserId()?>"><?=Session::getName()?></a> / <a href="http://<?=$_SERVER["HTTP_HOST"]?>/auth/logout">Sair</a></li> -->
                <li><span>Bem-vindo,</span> <a href="http://<?=$_SERVER["HTTP_HOST"]?>/dashboard/index"><?=Session::getName()?></a> / <a href="http://<?=$_SERVER["HTTP_HOST"]?>/auth/logout">Sair</a></li>
            <?php else: ?>
                <li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/auth/index">Login</a></li>
                <li><a href="http://<?=$_SERVER["HTTP_HOST"]?>/auth/register">Registrar</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php
        if(Session::getMessage() !== null) {
            require_once("flash-message.php");
        }
     ?>