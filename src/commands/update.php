<?php

global $cwd;

require_once __DIR__ . "/../package-name.php";
require_once __DIR__ . "/../rmdir-recursive.php";



function update($cwd, $package) {
    $path = realpath("$cwd/absol/$package");

    if (!file_exists($path)) {
        echo package_name_pretty($package) ." does not exist";
        return;
    }

    $out = shell_exec("cd $path && git pull && cd $cwd");

    if (strpos($out, "Already up to date.") === false) {
        echo "Updated ". package_name_pretty($package) ."\n";
    }
}



function update_cwd($cwd) {
    if (!file_exists("$cwd/absol")) {
        echo "Package directory not found. Searching for '$cwd/absol'\n";
    }

    $entries = scandir("$cwd/absol");

    if ($entries === false) {
        return;
    }

    foreach ($entries as $entry) {
        if ($entry === "." || $entry === ".." || !is_dir("$cwd/absol/$entry")) {
            continue;
        }

        update($cwd, $entry);
    }
}



if (isset($argv[0])) {
    update($cwd, package_name($argv[0]));
} else {
    update_cwd($cwd);
}
