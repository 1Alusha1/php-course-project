<?php
// register page
if (isset($_POST['submit'])) {
    $err = [];
    if (strlen($_POST['login']) < 4 || strlen($_POST['login']) > 30) {
        $err[] = 'Не меньше 3 и не больше 30';
    }
    if (isLoginExist($_POST['login'])) {
        $err[] = 'Логин существует';
    }

    if (count($err) === 0) {
        createUser($_POST['login'], $_POST['password']);
        header('Location: /login');
        exit();
    } else {
        echo "<h4>Ошибки регестрации</h4>";
        foreach ($err as $error) {
            echo $error . '<br>';
        }
    }

}
?>

<div class="auth">
    <h2>Регистрация</h2>
    <form method="POST" class="form">
        <p>Login:</p>
         <input type="text" name="login" required>
         <p>Pass:</p>
         <input type="password" name="password" required>
        <div>
        <input type="submit" name="submit" value="Регистрация">
        </div>
    </form>
</div>
