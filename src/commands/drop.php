<?php

global $cwd;

require_once __DIR__ . "/../package-name.php";
require_once __DIR__ . "/../rmdir-recursive.php";
require_once __DIR__ . "/../dep/remove.php";



function drop($cwd, $git_repo) {
    global $dropped;

    $dropped[] = $git_repo;

    $package = package_name($git_repo);
    $path = realpath("$cwd/absol/$package");

    if (!file_exists($path)) {
        echo package_name_pretty($package) ." does not exist.\n";
        return;
    }

    $deps = dep_get("$path/absol.json");

    if ($deps !== false) {
        foreach ($deps as $dep) {
            if (in_array($dep, $dropped)) {
                continue;
            }

            drop($cwd, $dep);
        }
    }

    $pretty = package_name_pretty($package);

    echo "Do you want to remove $pretty? (dir: '$path')\n[y/n]: ";
    $out = shell_exec("cmd /c rmdir /s $path");
    echo "out = '". json_encode($out) ."'\n";

    dep_remove("$cwd/absol.json", $git_repo);
}



if (isset($argv[0])) {
    $dropped = [];
    drop($cwd, package_name($argv[0]));
} else {
    echo "You must supply name of package or git repo. To list all packages use the 'absol ls' command";
}
