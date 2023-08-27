<?php

global $cwd;

function init($cwd) {
    if (file_exists("$cwd/absol.lock.json")) {
        echo "absol has been already initialized";
    }

    if (!file_exists("$cwd/absol")) {
        mkdir("$cwd/absol");
    }

    copy(__DIR__ . "/../dist/import.php", "$cwd/absol/import.php");
    touch("$cwd/absol/packages.json");
    copy(__DIR__ . "/../dist/absol.json", "$cwd/absol.json");
    copy(__DIR__ . "/../dist/absol.json", "$cwd/absol.lock.json");
}

init($cwd);