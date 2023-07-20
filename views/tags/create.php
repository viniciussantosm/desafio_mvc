<div class="container">
    <div class="title-container">
        <h1>Criar nova tag</h1>
    </div>
    <div class="form-container">
        <form class="post-create-form" action="http://<?=$server["host"]?>/tags/store" method="post">
            <div class="form-control">
                <label for="name">Nome:</label>
                <input type="text" name="name" value="<?=$_POST["name"] ?? ""?>" required>
            </div>
            <button class="btn" type="submit">Criar</button>
        </form>
    </div>
</div>