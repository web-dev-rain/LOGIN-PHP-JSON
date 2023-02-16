<?php require __DIR__ . "/login-user-class.php" ?>
<?php require __DIR__ . "/requests/login-user.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Форма авторизации</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="form-header">
        <h2>Авторизация</h2>
        <h4>Все поля <span>обязательны</span></h4>
    </div>

    <label>Логин</label>
    <input type="text" name="login">

    <label>Пароль</label>
    <input type="password" name="password">

    <button type="submit" name="submit">Авторизоваться</button>

    <div class="userNotifications">
        <p class="error"><?php echo @$user->error ?></p>
        <p class="success"><?php echo @$user->success ?></p>
    </div>

    <div class="userInfoMessage">
        <p>Нет аккаунта?</p>
        <a href="index.php">Зарегистрироваться</a>
    </div>
</form>

</body>
</html>