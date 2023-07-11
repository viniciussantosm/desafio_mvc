<div class="container">
    <div class="title-container">
        <h1>Editar post 1</h1>
    </div>
    <div class="form-container">
        <form class="post-create-form" action="http://<?=$_SERVER["HTTP_HOST"]?>/posts/udpate" method="post" enctype="multipart/form-data">
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
                <select name="tags" id="" multiple required>
                    <option value="">Selecione</option>
                    <option value="1">Tag A</option>
                    <option value="2">Tag B</option>
                </select>
            </div>
            <div class="form-control">
                <label for="categories">Categorias:</label>
                <select name="categories" id="" multiple required>
                    <option value="">Selecione</option>
                    <option value="1">Category A</option>
                    <option value="2">Category B</option>
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