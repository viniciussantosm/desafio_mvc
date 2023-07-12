<div class="container">
    <div class="title-container">
        <h1>Login</h1>
    </div>
    <div class="login-form-container">
        <form class="login-form" action="http://<?=$_SERVER["HTTP_HOST"]?>/auth/login" method="post">
            <div class="form-control">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-control">
                <label for="password">Senha:</label>
                <input type="password" name="password" required>
            </div>
            <button class="btn" type="submit">Login</button>
        </form>
    </div>
</div>