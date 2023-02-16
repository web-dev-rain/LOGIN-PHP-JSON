<?php require __DIR__ . "/register-user-class.php" ?>
<?php require __DIR__ . "/requests/new-user.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <title>Register form</title>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data" autocomplete="off">

    <div class="form-header">
        <h2>Регистрация</h2>
        <h4>Все поля <span>обязательны</span></h4>
    </div>

    <label>Логин</label>
    <input type="text" name="login">
    <p class="error"><?php echo @$user->loginError ?></p>

    <label>Пароль</label>
    <input type="password" name="password">
    <p class="error"><?php echo @$user->passwordError ?></p>

    <label>Подтвердите пароль</label>
    <input type="password" name="confirm_password">
    <p class="error"><?php echo @$user->confirmPasswordError ?></p>

    <label>Email</label>
    <input type="text" name="email">
    <p class="error"><?php echo @$user->emailError ?></p>

    <label>Имя пользователя</label>
    <input type="text" name="username">
    <p class="error"><?php echo @$user->usernameError ?></p>

    <button type="submit" name="submit">Регистрация</button>
    <div class="userNotifications">
        <p class="error"><?php echo @$user->error ?></p>
        <p class="success"><?php echo @$user->success ?></p>
    </div>

    <div class="userInfoMessage">
        <p>Уже есть аккаунт? </p>
        <a href="login.php">Авторизоваться</a>
    </div>

</form>

</body>
</html>