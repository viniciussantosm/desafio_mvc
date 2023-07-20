<?php
use App\Model\Session;
?>
<div class="container">
    <div class="title-container">
        <h1><?= $data["post"]["title"] ?></h1>
    </div>
    <div class="posts-show-container">
        <div class="post-show">
            <div class="post-show-image-container">
                <img src="http://<?=$server["host"] . $data["post"]["img_path"]?>" alt="post 1 image">
            </div>
            <div class="post-show-author">
                <span class="author"><?=$data["post"]["name"]?></span>
                <span class="post-date"><?=$data["post"]["created_at"]?></span>
            </div>
            <div class="post-show-text-container">
                <p><?=$data["post"]["text"]?></p>
            </div>
            <div class="post-show-info-container">
                <div class="show-tags">
                    <?=$data["tags"]?>
                </div>
                <div class="show-categories">
                    Categorias: <?=$data["categories"]?>
                </div>
            </div>
            <div class="comment-input-container">
                <h2>Comentários</h2>
                <form action="http://<?=$server["host"]?>/comments/store/?id_post=<?=$data["post"]["id"]?>" method="POST">
                    <textarea name="comment" id="show-comment" rows="6" maxlength="450" required></textarea>
                    <button id="show-btn">Enviar</button>
                </form>
            </div>
            <div class="post-show-comments-container">
                <div class="show-comment">
                    <?php foreach($data["comments"] as $comment): ?>
                        <div class="show-comment-text">
                            <p><?=$comment["text"]?></p>
                            <p class="show-comment-info"><span class="show-author"><?=$comment["name"]?></span> - <?=$comment["created_at"]?></p>
                            <?php if($comment["id_user"] == Session::getUserId()):?>
                                <div class="comment-action-btns">
                                    <a href="http://<?=$server["host"]?>/comments/edit/?id=<?=$comment["id_comment"]?>" class="comment-edit-btn">E</a>
                                    <a href="http://<?=$server["host"]?>/comments/edit/?id=<?=$comment["id_comment"]?>" class="comment-delete-btn">D</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>