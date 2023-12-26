<?php
// admin page

if (!getUser()) {
    header('Location: /login');
}
?>

<h1>Admin panel</h1>
<div><a href="/admin/create">Создать</a></div>
<div><a href="/logout">Выйти</a></div>
<?php
renderArticlesforAdmin($result);
?>

