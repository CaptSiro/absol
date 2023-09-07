<?php



require_once __DIR__ . "/Platform.php";



class Dos implements Platform {
    function remove_package_dir($package, $dir) {
        echo "Do you want to remove ". package_name_pretty($package) ."? (dir: '$dir')\n[y/n]: ";
        shell_exec("cmd /c rmdir /s $dir");
    }
}