<?php

// create page;

$action = "Create";
if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $descr_min = trim($_POST['descr_min']);
    $description = trim($_POST['description']);
    $cid = trim($_POST['cid']);

    move_uploaded_file($_FILES['image']['tmp_name'], 'static/images/' . $_FILES['image']['name']);
    $image = $_FILES['image']['name'];

    $create = createArticle($title, $url, $descr_min, $descr_min, $cid, $image);

    if ($create) {
        header("Location: /admin");
    } else {
        setcookie("alert", "create error", trim() + 60 * 10);
    }

    if (isset($_COOKIE['alert'])) {
        $alert = $_COOKIE['alert'];
        setcookie("alert", "create error", trim() - 60 * 10);
        unset($_COOKIE['alert']);
        echo $alert;
    } else {
        $result = array(
            "title" => "",
            "url" => "",
            "descr_min" => "",
            "description" => "description",
            "cid" => "",
            "image" => "",
        );
    }
}

?>

<h1>Create</h1>
<?php
require_once 'template\_form.php';
