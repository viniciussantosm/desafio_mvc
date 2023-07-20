<div class="container">
    <div class="title-container">
        <h1>Create</h1>
    </div>
    <div class="login-form-container">
        <form class="login-form" action="http://<?=$server["host"]?>/auth/store" method="post">
            <div class="form-control">
                <label for="name">Nome:</label>
                <input type="name" name="name" required value="<?=$data["name"] ?? ""?>">
            </div>
            <div class="form-control">
                <label for="email">Email:</label>
                <input type="email" name="email" required value="<?=$data["email"] ?? ""?>">
            </div>
            <div class="form-control">
                <label for="password">Senha:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-control">
                <label for="password">Confirme a senha:</label>
                <input type="password" name="passwordConfirm" required>
            </div>
            <button class="btn" type="submit">Login</button>
        </form>
    </div>
</div>