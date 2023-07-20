<div class="container">
    <div class="title-container">
        <h1>Editar Dados</h1>
    </div>
    <div class="form-container">
        <form class="post-create-form" action="http://<?=$server["host"]?>/categories/update/?id=<?=$data["id"] ?? null?>" method="post">
            <div class="form-control">
                <label for="name">Nome:</label>
                <input type="text" name="name" value="<?=$data["name"] ?? null?>" required>
            </div>
            <button class="btn" type="submit">Atualizar</button>
        </form>
    </div>
</div>