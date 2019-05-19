<?php

function my_generate_css($css_name, $name)
{
    $css_file = fopen($css_name, "w");
    fwrite($css_file, ".sprite {
        background-image: url('$name');
        background-repeat: no-repeat;
        display: block;}");
}
function add_css($css_name, $img_name, $width, $height, $x_pos)
{
    $css_file = fopen($css_name, "a");
    $img_name = basename($img_name, ".png");
    fwrite($css_file, "\n .$img_name {
        width: ${width}px;
        height: ${height}px;
        background-position: ${x_pos}px 0px;}");
}
