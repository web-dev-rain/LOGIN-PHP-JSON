<?php
if (isset($_POST['submit'])) {
    $user = new RegisterUser(
        $_POST['login'],
        $_POST['password'],
        $_POST['confirm_password'],
        $_POST['email'],
        $_POST['username']
    );
}
?>
