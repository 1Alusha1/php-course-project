<?php
// update page;
$action = "Update";

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $descr_min = trim($_POST['descr_min']);
    $description = trim($_POST['description']);
    $cid = trim($_POST['cid']);

    if (isset($_FILES['image']['tmp_name']) and $_FILES['image']['tmp_name'] !== '') {
        move_uploaded_file($_FILES['image']['tmp_name'], 'static/images/' . $_FILES['image']['name']);
        $image = $_FILES['image']['name'];
    } else {
        $image = $result['image'];
    }

    $id = $route[2];

    $update = updateArticle($id, $title, $url, $descr_min, $descr_min, $cid, $image);

    if ($update) {
        setcookie("alert", "update ok", trim() + 60 * 10);
        header("Location: /admin");
    } else {
        setcookie("alert", "update error", trim() + 60 * 10);
    }

    if (isset($_COOKIE['alert'])) {
        $alert = $_COOKIE['alert'];
        setcookie("alert", "", trim() - 60 * 10);
        unset($_COOKIE['alert']);
        echo $alert;
    } else {
        $result = array(
            "title" => "",
            "url" => "",
            "descr_min" => "",
            "description" => "",
            "cid" => "",
            "image" => "",
        );
    }
}

?>

<h1>Update</h1>
<?php
require_once 'template\_form.php';
