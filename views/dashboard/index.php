<?php  
use App\Model\Session;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="top-container">
            <div class="dashboard-title-container">
                <h1>Dashboard</h1>
            </div>
        </div>
        <div class="dashboard-items-container">
            <div class="dashboard-item">
                <a href="http://<?=$server["host"]?>/users/edit/<?=Session::getUserId()?>"><h3>Editar usuário</h3></a>
            </div>
            <div class="dashboard-item">
                <a href="http://<?=$server["host"]?>/users/index"><h3>Meus posts</h3></a>
            </div>
            <div class="dashboard-item">
                <a href="http://<?=$server["host"]?>/dashboard/tags"><h3>Gerenciar Tags</h3></a>
            </div>
            <div class="dashboard-item">
                <a href="http://<?=$server["host"]?>/dashboard/categories"><h3>Gerenciar Categorias</h3></a>
            </div>
        </div>
    </div>
</body>
</html>