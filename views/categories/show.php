<div class="container">
    <div class="title-container">
        <h1><?=$data["category"]["name"]?></span></h1>
    </div>
    <div class="posts-container">
        <?php if($data["posts"]): ?>
            <?php foreach($data["posts"] as $post): ?>
                <div class="post">
                    <div class="post-title"><?= $post["title"] ?></div>
                    <div class="post-image-container">
                        <img src="http://<?=$_SERVER["HTTP_HOST"] . $post["img_path"]?>" alt="post 1 image">
                    </div>
                    <div class="post-author">
                        <span class="author"><?=$post["user"]?></span>
                        <span class="post-date"><?=$post["created_at"]?></span>
                    </div>
                    <div class="posts-comments-container">
                        <div class="comment">
                            <div class="comment-text">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus rem quo autem perspiciatis facilis, delectus, odio et nam explicabo veritatis voluptates! Aliquid doloremque repellat praesentium architecto quod sint possimus laudantium.</p>
                                <p class="comment-info"><span class="author">Joao Carlos</span> - 19/07/2023 às 18:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Ainda não há posts cadastrados nesta categoria. Que tal criar um?</p>
            <a href="http://<?=$_SERVER["HTTP_HOST"]?>/posts/create" class="new-entity-link">Criar Post</a>
        <?php endif; ?>
    </div>
</div>