<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="title-container">
            <h1>Minhas postagens</h1>
        </div>
        <div class="my-posts-container">
            <?php foreach($data as $post): ?>
                <div class="my-post">
                    <div class="my-post-image-container">
                        <img src="http://<?=$_SERVER["HTTP_HOST"] . $post["img_path"]?>" alt="">
                    </div>
                    <div class="my-post-actions">
                        <a href="http://<?=$_SERVER["HTTP_HOST"]?>/posts/edit/?id=<?=$post["post_id"]?>" class="post-edit-button">Editar</a>
                        <a href="http://<?=$_SERVER["HTTP_HOST"]?>/posts/edit/?id=<?=$post["post_id"]?>" class="post-delete-button">Excluir</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>