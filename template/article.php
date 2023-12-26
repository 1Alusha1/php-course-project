<?php

$out = '';
$out .= '<div class="card">';
$out .= "<h4 class='card__title'>" . $result[0]['title'] . "</h4>";
$out .= "<p class='card__descr-min'>" . $result[0]['descr_min'] . "</p>";
$out .= "<img class='card__img' src='/static/images/" . $result[0]['image'] . "'>";
$out .= "<p>" . $result[0]['description'] . "</p>";

$out .= '</div>';

echo $out;