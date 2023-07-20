<div class="container">
        <div class="tag-title-container">
            <h1>Tags</h1>
        </div>
        <div class="tags-container">
            <?php foreach($data as $tag): ?>
                <div class="tag-item">
                    <a href="http://<?=$server["host"]?>/tags/show/?id=<?=$tag["id"]?>"><h3><?=$tag["name"]?></h3></a>
                </div>
            <?php endforeach; ?>
        </div>
</div>