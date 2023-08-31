<?php

/**
 * @param string $package get a list of available packages with `absol ls` command
 * @param string $module get a list of available modules with `absol ls {{package}}` command
 * @return void|false
 */
function import($package, $module = "") {
    if ($module === "") {
        $module = "index";
    }

    if (!file_exists(__DIR__ . "/$package")) {
        return false;
    }

    if (!file_exists(__DIR__ . "/$package/absol_modules/$module.php")) {
        return false;
    }

    var_dump(__DIR__ . "/$package/absol_modules/$module.php");
    require_once __DIR__ . "/$package/absol_modules/$module.php";
}