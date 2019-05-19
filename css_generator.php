<?php
include "main_program.php";
include "style.php";
include "init.php";


function start($argv)
{
    $user_args = verify_args($argv);
    merge_no_option($user_args);
}

function help()
{
    echo "\n\033[1mNAME\033[0m\n\tCSS Generator\n\n";
    echo "\033[1mDESCRIPTION\033[0m\n";
    echo "\tCSS Generator is an automated sprite and CSS generator";
    echo "\n\n\033[1mCOMMANDS\033[0m\n\t\033[1m-r, --recursive\n";
    echo "\t\t\033[0mTo look for files recursively\n\n\t";
    echo "\033[1m-s, --output-style=STYLE\n";
    echo "\t\t\033[0mTo select the name of the CSS file.\n\n";
    echo "\t\033[1m-i, --output-image=IMAGE\n\t\t\033[0mT select the name of ";
    echo "the image.\n\n\t\033[1mhelp\n\t\t\033[0mTo view the info about ";
    echo "the CSS Generator and visualize the command list.\n\n";
}

start($argv);