<div class="container">
    <div class="title-container">
        <h1>Criar novo post</h1>
    </div>
    <div class="form-container">
        <form class="post-create-form" action="http://<?=$server["host"]?>/posts/store" method="post" enctype="multipart/form-data">
            <div class="form-control">
                <label for="title">Título:</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-control">
                <label for="description">Descrição:</label>
                <input type="text" name="description" required>
            </div>
            <div class="form-control">
                <label for="tags">Tags:</label>
                <select name="tags[]" multiple required>
                    <option value="">Selecione</option>
                    <?php foreach($data['tags'] as $tag): ?>
                        <option value="<?=$tag['id']?>"><?=$tag['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-control">
                <label for="categories">Categorias:</label>
                <select name="categories[]" multiple required>
                    <option value="">Selecione</option>
                    <?php foreach($data['categories'] as $category): ?>
                        <option value="<?=$category['id']?>"><?=$category['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-control">
                <label for="image">Imagens</label>
                <input type="file" name="postImages[]" multiple required>
            </div>
            <button class="btn" type="submit">Criar</button>
        </form>
    </div>
</div>