<form action="" method="POST" enctype="multipart/form-data" class="form formU ">
    <p>Title:</p>
    <input type="text" name="title" value="<?php echo $result['title'] ?>">
    <p>Url:</p>
    <input type="text" name="url" value="<?php echo $result['url'] ?>">
    <p>Min descr:</p>
    <textarea name="descr_min"> <?php echo $result['descr_min'] ?></textarea>
    <p>Description:</p>
    <textarea name="description"  ><?php echo $result['description'] ?></textarea>
    <p>Category:
        <select name="cid" >
            <?php
$out = '';
for ($i = 0; $i < count($cat); $i++) {
    $category = $cat[$i]['id'];
    $catTitle = $cat[$i]['title'];
    if ($category === $result['cid']) {
        $out .= "<option value='$category' selected>$catTitle</option>";
    } else {
        $out .= "<option value='$category'>$catTitle</option>";
    }
}
echo $out;
?>
        </select>
    </p>
    <p>Photo:</p>
    <input type="file" name="image" value="<?php echo $result['image'] ?>">
    <?php
if (isset($result['image']) and $result['image'] !== '') {
    $img = $result['image'];
    echo "<img width='100px' src='/static/images/$img'>";
}
?>
    <p><input type="submit" name="submit" value="<?php echo $action ?>"></p>
</form>



