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
    if (in_array("-r", $argv) || in_array("--recursive", $argv))
    {
        $default["recursive"] = true;
    }
    if (in_array("-i", $argv))
    {
        $default["output-image"] = $argv[array_search("-i",$argv)+1];
    }
    if (in_array("-s",$argv))
    {
        $default["output-style"] = $argv[array_search("-s",$argv)+1];
    }
    if (in_array("help",$argv))
    {
        $default["display-help"] = true;
    }
    $default["input-dir"] = $argv[1];
    return $default;
}



