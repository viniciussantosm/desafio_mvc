<div class="container">
    <div class="title-container">
        <h1>Editar Dados</h1>
    </div>
    <div class="form-container">
        <form class="post-create-form" action="http://<?=$_SERVER["HTTP_HOST"]?>/tags/update/?id=<?=$data["id"]?>" method="post">
            <div class="form-control">
                <label for="name">Nome:</label>
                <input type="text" name="name" value="<?=trim($data["name"], "#") ?? ""?>" required>
            </div>
            <button class="btn" type="submit">Atualizar</button>
        </form>
    </div>
</div>