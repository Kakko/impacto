<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo - Impacto</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/admLogin.css">
</head>
<body>
    <div class="loginInfo">
        <div class="loginArea">
            <img src="<?php echo BASE_URL; ?>assets/images/logo-marca.svg">
            <div class="loginInput">
                <form method="POST">
                    <?php if(!empty($viewData['error'])): ?>
                        <div class="loginError">
                            <span><?php echo $viewData['error']; ?></span>
                        </div>
                    <?php endif; ?>
                    <label class="loginLabel">E-mail:</label><br/>
                    <input type="email" class="inputField" name="email" autocomplete="off">
                    <br/><br/>
                    <label class="loginLabel">Senha:</label><br/>
                    <input type="password" class="inputField" name="password" autocomplete="off">
                    <input type="submit" class="inputAccess" value="Entrar">
                </form>
            </div>
        </div>
    </div>
    <div class="brandInfo">
        <div class="bgMask"></div>
    </div>
</body>
</html>