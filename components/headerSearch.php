<?php
if (isset($_POST['submit'])) {
    $post = trim($_POST['search']);
    $result = select("select * from info where title='$post'");
    $url = $result[0]['url'];
    header("Location: /article/$url");
}
?>
<div class="header__search">
            <form method="POST">
                <input type="text" name="search" placeholder="Поиск (заголовок) ">
                <input type="submit" name="submit" value="искать">
            </form>
        </div>
