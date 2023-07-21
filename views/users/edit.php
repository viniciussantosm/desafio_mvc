<div class="container">
    <div class="title-container">
        <h1>Editar Dados</h1>
    </div>
    <div class="login-form-container">
        <form class="login-form" action="http://<?=$server["host"]?>/users/update" method="post">
            <input type="hidden" value="<?=$data["id"]?>" name="id">
            <div class="form-control">
                <label for="name">Nome:</label>
                <input type="name" name="name" value="<?=$data["name"]?>" required>
            </div>
            <div class="form-control">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?=$data["email"]?>" readonly required>
            </div>
            <div class="form-control">
                <label for="password">Senha:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-control">
                <label for="password">Confirme a senha:</label>
                <input type="password" name="passwordConfirm" required>
            </div>
            <button class="btn" type="submit">Editar</button>
        </form>
    </div>
</div>