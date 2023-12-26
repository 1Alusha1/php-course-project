<?php
$out = '';
$out .= '<div class="card">';
$out .= "<h4 class='card__title'>" . $cat['title'] . "</h4>";
$out .= "<p class='card__descr-min'>" . $cat['description'] . "</p>";
$out .= '</div>';

echo $out;

if (count($result)) {
    render($result);
} else {
    echo '<h3>В категории нет новостей</h3>';
}
