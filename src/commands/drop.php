<?php

global $cwd;

require_once __DIR__ . "/../package-name.php";
require_once __DIR__ . "/../rmdir-recursive.php";
require_once __DIR__ . "/../dep/get.php";



function drop($cwd, $package) {
    global $dropped;
    $dropped[] = $package;

    $path = realpath("$cwd/absol/$package");

    if (!file_exists($path)) {
        echo package_name_pretty($package) ." does not exist.\n";
        return;
    }

    $deps = dep_get("$path/absol.json");

    if ($deps !== false) {
        foreach ($deps as $dep) {
            $p = package_name($dep);

            if (in_array($p, $dropped)) {
                continue;
            }

            drop($cwd, $p);
        }
    }

    $pretty = package_name_pretty($package);

    echo "Do you want to remove $pretty? (dir: '$path')";
    shell_exec("cmd /c rmdir /s $path");

    echo "$pretty has been and dropped on the floor and it shattered into pieces.\n";
}



if (isset($argv[0])) {
    $dropped = [];
    drop($cwd, package_name($argv[0]));
} else {
    echo "You must supply name of package or git repo. To list all packages use the 'absol ls' command";
}
