<?php

global $cwd;

function init($cwd) {
    if (file_exists("$cwd/absol.lock.json")) {
        echo "absol has been already initialized";
    }

    if (!file_exists("$cwd/absol")) {
        mkdir("$cwd/absol");
    }

    if (!file_exists("$cwd/absol/tmp")) {
        mkdir("$cwd/absol/tmp");
    }

    if (!file_exists("$cwd/absol_modules")) {
        mkdir("$cwd/absol_modules");
    }

    copy(__DIR__ . "/../../dist/import.php", "$cwd/absol/import.php");
    copy(__DIR__ . "/../../dist/user-defined-index-import.php", "$cwd/absol_modules/index.php");

    touch("$cwd/absol/packages.json");

    copy(__DIR__ . "/../../dist/absol.json", "$cwd/absol.json");
    copy(__DIR__ . "/../../dist/absol.json", "$cwd/absol.lock.json");
}

init($cwd);