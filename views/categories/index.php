<div class="container">
    <div class="title-container">
        <h1>Bem-vindo ao Blogger O</h1>
    </div>
    <div class="container">
        <div class="category-title-container">
            <h2>Categorias</h2>
        </div>
        <div class="categories-container">
            <?php foreach($data as $category): ?>
            <div class="category-item">
                <a href=""><h3><?=$category["name"]?></h3></a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>