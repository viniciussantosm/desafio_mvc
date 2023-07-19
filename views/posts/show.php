<div class="container">
    <div class="title-container">
        <h1><?= $data["post"]["title"] ?></h1>
    </div>
    <div class="posts-show-container">
        <div class="post-show">
            <div class="post-show-image-container">
                <img src="http://<?=$_SERVER["HTTP_HOST"] . $data["post"]["img_path"]?>" alt="post 1 image">
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
                <form action="http://<?=$_SERVER["HTTP_HOST"]?>/comments/store/?id=<?=$data["post"]["id"]?>" method="POST">
                    <textarea name="comment" id="show-comment" rows="6" maxlength="450" required></textarea>
                    <button id="show-btn">Enviar</button>
                </form>
            </div>
            <div class="post-show-comments-container">
                <div class="show-comment">
                    <div class="show-comment-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus rem quo autem perspiciatis facilis, delectus, odio et nam explicabo veritatis voluptates! Aliquid doloremque repellat praesentium architecto quod sint possimus laudantium.</p>
                        <p class="show-comment-info"><span class="show-author">Joao Carlos</span> - 19/07/2023 às 18:00</p>
                    </div>
                    <div class="show-comment-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus rem quo autem perspiciatis facilis, delectus, odio et nam explicabo veritatis voluptates! Aliquid doloremque repellat praesentium architecto quod sint possimus laudantium.</p>
                        <p class="show-comment-info"><span class="show-author">Joao Carlos</span> - 19/07/2023 às 18:00</p>
                    </div>
                    <div class="show-comment-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus rem quo autem perspiciatis facilis, delectus, odio et nam explicabo veritatis voluptates! Aliquid doloremque repellat praesentium architecto quod sint possimus laudantium.</p>
                        <p class="show-comment-info"><span class="show-author">Joao Carlos</span> - 19/07/2023 às 18:00</p>
                    </div>
                    <div class="show-comment-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus rem quo autem perspiciatis facilis, delectus, odio et nam explicabo veritatis voluptates! Aliquid doloremque repellat praesentium architecto quod sint possimus laudantium.</p>
                        <p class="show-comment-info"><span class="show-author">Joao Carlos</span> - 19/07/2023 às 18:00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>