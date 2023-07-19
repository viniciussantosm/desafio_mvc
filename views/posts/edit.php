<div class="container">
    <div class="title-container">
        <h1>Editar post</h1>
    </div>
    <div class="form-container">
        <form class="post-create-form" action="http://<?=$_SERVER["HTTP_HOST"]?>/posts/update/?id=<?=$data["id"]?>" method="post" enctype="multipart/form-data">
            <div class="form-control">
                <label for="title">Título:</label>
                <input type="text" name="title" value="<?=$data["title"]?>" required>
            </div>
            <div class="form-control">
                <label for="text">Descrição:</label>
                <input type="text" name="text" value="<?=$data["text"]?>" required>
            </div>
            <div class="form-control">
                <label for="tags">Tags:</label>
                <select name="tags[]" id="" multiple required>
                    <option value="">Selecione</option>
                    <?=$data["tags"]?>
                </select>
            </div>
            <div class="form-control">
                <label for="categories">Categorias:</label>
                <select name="categories[]" id="" multiple required>
                    <option value="">Selecione</option>
                    <?=$data["categories"]?>
                </select>
            </div>
            <div class="form-control">
                <label for="image">Imagens</label>
                <input type="file" name="postImages[]" multiple required>
            </div>
            <button class="btn" type="submit">Atualizar</button>
        </form>
    </div>
</div>