<?php


function default_settings()
{
    return (array(
        "recursive" => false,
        "output-image" => 'sprite.png',
        "output-style" => 'style.css',
        "input-dir" => null,
        "display-help" => false
    ));
}

function verify_args($argv)
{
    $default = default_settings();
    if (in_array("-r", $argv) || in_array("--recursive", $argv)) {
        $default["recursive"] = true;
    }
    if (in_array("-i", $argv)) {
        $default["output-image"] = $argv[array_search("-i",$argv)+1];
    }
    if (in_array("-s",$argv)) {
        $default["output-style"] = $argv[array_search("-s",$argv)+1];
    }
    if (preg_grep('/--output-image.*/', $argv)) {
        $default["output-image"] = sub_string("--output-image=", $argv);
    }
    if (preg_grep('/--output-style.*/', $argv)) {
        $default["output-style"] = sub_string("--output-style=", $argv);
    }
    if (in_array("-help",$argv)) {
        help();
        exit(0);
    }
    $default["input-dir"] = $argv[1];
    return $default;
}

function sub_string($ref, $argv)
{
    $value = preg_grep('/'.$ref.'.*/', $argv);
    @$key = array_shift(array_keys($value));
    $value = str_replace($ref, "",$value[$key]);
    return $value;
}





// trouver key output-image
// remove jusqu'a =
// return ce qui reste jusqu'a l'espace


// array 0 = initi.php
// array 1 .
// array 2 -r
// array 3 --output-image=blu.png