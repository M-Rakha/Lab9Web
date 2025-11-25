<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    header('Location: index.php?page=user/list');
    exit;
}
?>
<h2>Login</h2>
<form method="post">
    <label>Username<br><input type="text" name="username"></label><br>
    <label>Password<br><input type="password" name="password"></label><br>
    <button type="submit">Login</button>
</form>
