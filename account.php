<?php
session_start();
if (!isset($_SESSION['user'])) {
    if (!isset($_COOKIE['user'])) {
        header("location: login.php");
        exit();
    }
}

if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    if (isset($_COOKIE['user'])) {
        unset($_COOKIE['user']);
        setcookie('user', null, -1, '/');
        header("location: login.php");
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Страница пользователя</title>
</head>
<body>

<div class="content">
    <header>
        <h2>Hello <?php echo $_SESSION['user']; ?></h2>
        <div class="link-to-login">
            <a href="?logout">Выйти</a>
        </div>
    </header>

    <main>
        <h3>Страница пользователя...</h3>
    </main>
</div>

</body>
</html>