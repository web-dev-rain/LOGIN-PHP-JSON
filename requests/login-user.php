<?php
if (isset($_POST['submit'])) {
    $user = new LoginUser($_POST['login'], $_POST['password']);
}
?>
