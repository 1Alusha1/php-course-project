<div class="side-bar">
        <div class="container">
           <?php
if ($route[0] !== 'register') {
    echo '<h4 class="cat__title" >Категории:</h4>';
    $categories = getAllCat();
    renderCatList($categories);
}
?>
        </div>
</div>

<?php
