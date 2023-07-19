<div class="container">
    <div class="title-container">
        <h1>Bem-vindo ao Blogger O</h1>
    </div>
    <div class="container">
        <div class="tag-title-container">
            <h2>Tags</h2>
        </div>
        <div class="tags-container">
            <?php foreach($data as $tag): ?>
                <div class="tag-item">
                    <a href=""><h3><?=$tag["name"]?></h3></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>