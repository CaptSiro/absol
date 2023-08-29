<?php

global $cwd;

require_once __DIR__ . "/../package-name.php";
require_once __DIR__ . "/../rmdir-recursive.php";
require_once __DIR__ . "/../dep/add.php";
require_once __DIR__ . "/../generate-lock-file.php";

function pickup($cwd, $git_repo, $add_to_dep = true) {
    $package = package_name($git_repo);

    $path = "$cwd/absol/$package";

    if (file_exists($path)) {
        echo "Skipped ". package_name_pretty($package) ." because it has been already picked up.\n";
        return;
    }

    shell_exec("git clone -q --depth=1 $git_repo $path");

    if (!file_exists($path)) {
        echo "\nError while cloning git repository";
        return;
    }

    if (!file_exists("$path/absol.json")) {
        echo "Invalid package: '$package' does not include file: 'absol.json'\n";
        rmdir_recursive($path);
        return;
    }

    if (!file_exists("$path/absol_modules/index.php")) {
        echo "Invalid package: '$package' does not include default import file: 'absol_modules/index.php'\n";
        rmdir_recursive($path);
        return;
    }

    if (!file_exists("$path/absol")) {
        mkdir("$path/absol");
    }

    if (file_exists("$path/absol/import.php")) {
        unlink("$path/absol/import.php");
    }

    link(__DIR__ . "/../../dist/library-import.php", "$path/absol/import.php");

    if ($add_to_dep) {
        dep_add("$cwd/absol.json", $git_repo);
    }

    pickup_deps($cwd, "$path/absol.json");

    echo package_name_pretty($package) ." has been picked up. It is rather heavy.\n";
}

function pickup_deps($cwd, $file) {
    $json = json_decode(file_get_contents($file));

    if (isset($json->dependencies)) {
        foreach ($json->dependencies as $dependency) {
            pickup($cwd, $dependency, false);
        }
    }
}

if (isset($argv[0])) {
    pickup($cwd, $argv[0]);
} else {
    pickup_deps($cwd, "$cwd/absol.php");
}
