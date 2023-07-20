<div class="container">
    <div class="category-title-container">
        <h1>Categorias</h1>
    </div>
    <div class="categories-container">
        <?php foreach($data as $category): ?>
        <div class="category-item">
            <a href="http://<?=$server["host"]?>/categories/show/?id=<?=$category["id"]?>"><h3><?=$category["name"]?></h3></a>
        </div>
        <?php endforeach; ?>
    </div>
</div>