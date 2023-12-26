<?php
require_once 'function_db.php';

function explodeURL($url)
{
    return explode("/", $url);
}

function getArticle($url)
{
    $query = "select * from info WHERE url = '$url'";
    return select($query);
}

function getCat($url)
{
    $query = "select * from category WHERE url = '$url'";
    return select($query)[0];
}

function getAllCat()
{
    $query = "SELECT * FROM `category`";
    return select($query);
}

function getCatArticle($cid)
{
    echo $cid;
    $query = "select * from info WHERE cid = '$cid'";
    return select($query);
}

function render($arr)
{
    $out = '';
    for ($i = 0; $i < count($arr); $i++) {
        $out .= '<div class="card">';
        $out .= "<h4 class='card__title'>" . $arr[$i]['title'] . "</h4>";
        $out .= "<p class='card__descr-min'>" . $arr[$i]['descr_min'] . "</p>";
        $out .= "<img class='card__img' src='/static/images/" . $arr[$i]['image'] . "'>";
        $out .= "<div><a  href='/article/" . $arr[$i]['url'] . "'>Читать польностью<a/></div>";
        $out .= '</div>';
    }
    echo $out;
}

function renderArticlesforAdmin($arr)
{
    $out = '';
    for ($i = 0; $i < count($arr); $i++) {
        $out .= '<div class="card">';
        $out .= "<h3 class='card__title'>" . $arr[$i]['title'] . "</h3>";
        $out .= "<img class='card__img' src='/static/images/" . $arr[$i]['image'] . "'>";
        $out .= "<div><a  href='/admin/delete/" . $arr[$i]['id'] . "' onclick='return confirm(\"Точно?\")' >удалить</a></div>";
        $out .= "<div><a  href='/admin/update/" . $arr[$i]['id'] . "' onclick='return confirm(\"Точно?\")' >Обновить</a></div>";
        $out .= '</div>';
    }
    echo $out;
}

function renderCatList($arr)
{
    $out = '';
    $out .= '<ul class="cat__list">';
    foreach ($arr as $key => $value) {
        $title = $value['title'];
        $url = $value['url'];
        $out .= "<li class='cat__list-item'><a href='/cat/$url'>$title</a></li>";
    }
    $out .= '</ul>';

    echo $out;
}

function isLoginExist($login)
{
    $query = "select id from users where login = '$login'";
    $result = select($query);

    if (count($result) === 0) {
        return false;
    }
    return true;

}

function createUser($login, $password)
{
    $password = md5(md5(trim($password)));
    $login = trim($login);
    $query = "insert into users set login='$login', password='$password'";
    return execQuery($query);
}

function login($login, $password)
{
    $password = md5(md5(trim($password)));
    $login = trim($login);
    $query = "select id,login from users where login='$login' AND password='$password'";
    $result = select($query);
    if (count($result) != 0) {
        return $result;
    }
    return false;
}

function generateCode($length = 7)
{
    $chars = "qwertyuiopasdasddasdxcvvfghbwevxslASDMVLXMVXMVXCMVLKFMDL123456789";
    $code = "";
    $clen = strlen($chars);

    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0, $clen)];
    }

    return $code;
}

function updateUser($id, $hash, $ip)
{
    if (is_null($ip)) {
        $query = "UPDATE users SET hash='$hash' where id=$id";

    } else {
        $query = "UPDATE users SET hash='$hash', ip=INET_ATON('$ip') where id='$id'";
    }
    return execQuery($query);
}

function getUser()
{
    if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
        $id = (int) $_COOKIE['id'];
        $query = "select id,login,hash,INET_NTOA(ip) as ip from users where id=$id limit 1";
        $user = select($query);

        if (count($user) === 0) {
            return false;
        } else {
            $user = $user[0];
            if ($user['hash'] != $_COOKIE['hash']) {
                clearCookies();
                return false;
            }
            if (!is_null($user['ip'])) {
                if ($user['ip'] != $_SERVER['REMOTE_ADDR']) {
                    clearCookies();
                    return false;
                }
            }
            $_GET['login'] = $user['login'];
            return true;
        }
    } else {
        clearCookies();
        return false;
    }
}

function clearCookies()
{
    setcookie('id', "", time() - 60 * 60 * 24 * 30, "/", );
    setcookie('hash', "", time() - 60 * 60 * 24 * 30, "/", null, null, true);
    unset($_GET['login']);
}

function createArticle($title, $url, $descr_min, $description, $cid, $image)
{
    $query = "INSERT INTO info (title,url,descr_min,description,cid,image) VALUES ('$title','$url','$descr_min','$description',$cid,'$image')";
    return execQuery($query);
}

function updateArticle($id, $title, $url, $descr_min, $description, $cid, $image)
{
    $query = "UPDATE info SET title = '$title',url = '$url',descr_min='$descr_min',description='$description',cid=$cid,image ='$image' where id=$id";
    return execQuery($query);
}


function logout(){
    clearCookies();
    header('Location: /');
    exit();
}