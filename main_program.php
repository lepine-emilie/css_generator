<?php

function merge_no_option($user_args)
{
    $path_array = my_scandir($user_args["input-dir"], $user_args["recursive"]);
    $img_array = open_images($path_array);

    $new_sprite_dimensions = calculate_output_size($img_array);
    $new_sprite = imagecreatetruecolor($new_sprite_dimensions[0], $new_sprite_dimensions[1]);
    $transparent = imagecolorallocatealpha($new_sprite, 0, 0, 0, 127);
    imagefill($new_sprite, 0, 0, $transparent);
    imagesavealpha($new_sprite, true);
    my_generate_css($user_args["output-style"], $user_args["output-image"]);
    $x_pos = 0;
    foreach ($img_array as $current_img)
    {
        $height = imagesy($current_img["resource"]);
        $width = imagesx($current_img["resource"]);

        imagecopy($new_sprite, $current_img["resource"], $x_pos, 0, 0, 0, $width, $height);
        add_css($user_args["output-style"], $current_img["name"],$width, $height, -$x_pos);
        $x_pos += $width;
    }

    imagepng($new_sprite, $user_args["output-image"]);
}

function open_images($path_array)
{
    $ensemble = array();
    foreach ($path_array as $value)
    {
        $info_image = array();
        $info_image['name'] = $value;
        $info_image["resource"] = imagecreatefrompng($value);
        $info_image["width"] = imagesx($info_image["resource"]);
        $info_image["height"] = imagesy($info_image["resource"]);
        array_push($ensemble, $info_image);
    }
    return $ensemble;
}

function calculate_output_size($img_array)
{
    $total_height = 0;
    $total_width = 0;
    foreach ($img_array as $current_image)
    {
        $total_width += imagesx($current_image["resource"]);
        $current_img_height = imagesy($current_image["resource"]);
        if ($current_img_height > $total_height)
        {
            $total_height = $current_img_height;
        }
    }
    return(Array($total_width,$total_height));
}

function my_scandir($dir_path, $recursivity)
{
    $path_prefix = "";
    if ($dir_path !== "."){
        $path_prefix = $dir_path . "/";
    }
    if ($path = opendir($dir_path)){
        $dir_array = array();
        while (false !== ($entry = readdir($path))){
            if ($entry!= ".." && $entry != "."){
                if (is_dir($path_prefix . $entry) && $recursivity){
                    $dir_array2 = my_scandir($path_prefix.$entry, $recursivity);
                    $dir_array = array_merge($dir_array, $dir_array2);
                }
                else{
                    if(strpos($entry, ".png")){
                        array_push($dir_array, $path_prefix.$entry);
                    }
                }
            }
        }
        closedir($path);
        return ($dir_array);
    }
}