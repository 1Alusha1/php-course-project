<?php
require_once 'config/db.php';
require_once 'core/function_db.php';
require_once 'core/function.php';
$conn = connect();
$route = $_GET['route'];
$route = explodeURL($route);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="\static\css\mian.css" rel="stylesheet">
    <link href="\static\css\header.css" rel="stylesheet">
</head>
<body>
<div class="main">
    <div class="header">
        <div class="logo">
            <a href="/">CP</a>
        </div>
        <div class="header__wrap">
        <ul class="header__nav">
            <li class="header__nav-item">
                <a href="/">Главаная</a>
            </li>
            <li class="header__nav-item">
                <a href="https://cabinet.itgid.info/ru/course/php">php_stage2</a>
            </li>
        </ul>

        <?php
require_once './components/headerSearch.php'
?>
        <?php
        if(getUser()){
            echo '<div class="login">
            <button>
                <a href="/logout">Выйти</a>
        </button>
        </div>';
        }
        else{
            echo '<div class="login">
            <button>
                <a href="/login">Войти</a>
            </button>
            <button>
                <a href="/register">Регистрация</a>
        </button>
        </div>';
        }


        ?>
        </div>
    </div>
<div class="wrap">
    <?php
require_once 'components/sideBar.php';
?>
<div class="container">
<?php

switch ($route) {
    case ($route[0] == ''):
        ?>
                    <h4>Новости:</h4>
        <?php
$query = "select * from info";
        $result = select($query);
        require_once 'template/main.php';
        break;
        ?>
        <?php

    case ($route[0] == 'admin' and $route[1] === 'delete' and isset($route[2])):
        $id = $route[2];
        if (getUser()) {
            $query = "delete from info where id = $id";
            execQuery($query);
            header('Location: /admin');
            exit();
        }
        header('Location: /');
        break;
    case ($route[0] == 'admin' and $route[1] === 'create'):
        if (getUser()) {
            $query = "select id,title from category";
            $cat = select($query);
            require_once 'template/create.php';
        }
        break;
    case ($route[0] == 'admin' and $route[1] === 'update' and isset($route[2])):
        if (getUser()) {
            $id = $route[2];
            $query = "select id,title from category";
            $cat = select($query);
            $query = "select * from info where id =$id";
            $result = select($query)[0];
            require_once 'template/update.php';
        }
        break;
    case ($route[0] == 'admin'):
        $query = "select * from info";
        $result = select($query);
        require_once 'template/admin.php';
        break;

    case ($route[0] == 'logout'):
        require_once 'template/logout.php';
        break;
    case ($route[0] == 'article' and isset($route[1])):
        $url = $route[1];
        $result = getArticle($url);
        require_once 'template/article.php';
        break;
    case ($route[0] == 'cat' and isset($route[1])):
        $url = $route[1];
        $cat = getCat($url);
        $result = getCatArticle($cat['id']);
        require_once 'template/cat.php';
        break;
    case ($route[0] == 'login'):
        require_once 'template/login.php';
        break;
    case ($route[0] == 'register'):
        require_once 'template/register.php';
        break;

    default:
        require_once 'template/404.php';
        break;
}
?>
</div>
</div>
<footer class="footer">
<div class="logo">
            <a href="/">CP</a>
        </div>
        <p class="footer__text">
            made in course <strong>PHP Stage 2</strong>
        </p>
        <a href="https://cabinet.itgid.info/ru/course/php">course</a>
</footer>
</div>
<script src="\static\js\script.js"></script>
</body>
</html>
