<?php

global $cwd;

require_once __DIR__ . "/../package-name.php";
require_once __DIR__ . "/../rmdir-recursive.php";
require_once __DIR__ . "/../mktmp.php";

function pickup($cwd, $git_repo) {
    $name = package_name($git_repo);

    $path = "$cwd/absol/$name";

    $git_dir = mktmp($cwd);
    echo $git_dir;

    shell_exec("git clone --separate-git-dir=$git_dir --depth=1 $git_repo $path");

    if (!file_exists($path)) {
        echo "\nError while cloning git repository";
        return;
    }

    if (!file_exists("$path/absol.json")) {
        echo "Invalid package: '$name' does not include file: 'absol.json'\n";
        rmdir_recursive($path);
        return;
    }

    if (!file_exists("$path/absol_modules/index.php")) {
        echo "Invalid package: '$name' does not include default import file: 'absol_modules/index.php'\n";
        rmdir_recursive($path);
        return;
    }

    echo "\nDo not forget to clean $cwd/absol/tmp folder\nI would do it but I'm too cool 😎 to do your work";
}

pickup($cwd, $argv[0]);