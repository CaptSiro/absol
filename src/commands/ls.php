<?php

global $cwd;

require_once __DIR__ . "/../const.php";
require_once __DIR__ . "/../file-name.php";
require_once __DIR__ . "/../starts-with.php";



function ls($cwd, $args) {
    $package = array_shift($args);

    if ($package !== null) {
        if (in_array($package, CORE_DIR)) {
            echo "Can not list '$package' because its name is reserved for core utility";
            return;
        }

        ls_package($cwd, $package);
        return;
    }

    $packages = scandir("$cwd/absol");

    foreach ($packages as $package) {
        if ($package === "." || $package === ".." || !is_dir("$cwd/absol/$package") || in_array($package, CORE_DIR)) {
            continue;
        }

        echo "$package\n";
    }
}



function ls_package($cwd, $package) {
    if (!file_exists("$cwd/absol/$package")) {
        $entries = scandir("$cwd/absol");

        foreach ($entries as $entry) {
            if ($entry === "." || $entry === ".." || is_dir("$cwd/absol/$package") || !starts_with($entry, $package) || in_array($package, CORE_DIR)) {
                continue;
            }

            echo "$entry\n";
        }

        return;
    }

    $mod_path = "$cwd/absol/$package/absol_modules";

    if (!file_exists($mod_path)) {
        echo "Invalid package: '$package' must have absol_modules directory";
        return;
    }

    $modules = scandir($mod_path);

    foreach ($modules as $module) {
        if ($module === "." || $module === "..") {
            continue;
        }

        if ($module === "index.php") {
            echo "$module -> default package importer\n";
            continue;
        }

        $name = file_name($module);

        if ($name === "") {
            echo "WARNING: Unreachable module file '$module'\n";
            continue;
        }

        echo "$name\n";
    }
}



ls($cwd, $argv);