<?php
// login page
if (isset($_POST['submit'])) {
    $user = login($_POST['login'], $_POST['password']);
    if ($user) {
        $user = $user[0];
        $hash = md5(generateCode(10));
        $ip = null;

        if (!empty($_POST['ip'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        updateUser($user['id'], $hash, $ip);
        setcookie('id', $user['id'], time() + 60 * 60 * 24 * 30, "/");
        setcookie('hash', $hash, time() + 60 * 60 * 24 * 30, "/");
        header('Location: /admin');
        exit();
    } else {
        echo 'Неправиль ввели логин или пароль';
    }
}

?>

<div class="auth">
<h2>Авторизация</h2>
<form method="POST" class="form">
        <p>Login</p>
    <input type="text" name="login" required>
        <p>Pass</p>
        <input type="password" name="password" required>
        <p>Прикреплять к IP:</p>
         <input type="checkbox" name="ip">
    <input type="submit" name="submit" value="Войти">
</form>
</div>
