<?php

global $cwd;

require_once __DIR__ . "/../package-name.php";
require_once __DIR__ . "/../rmdir-recursive.php";
require_once __DIR__ . "/../dep/remove.php";
require_once __DIR__ . "/../dep/get.php";
require_once __DIR__ . "/../platform/get-platform.php";



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

    get_platform()->remove_package_dir($package, $path);

    dep_remove("$cwd/absol.json", $git_repo);
}



if (isset($argv[0])) {
    $dropped = [];
    drop($cwd, package_name($argv[0]));
} else {
    echo "You must supply name of package or git repo. To list all packages use the 'absol ls' command";
}
