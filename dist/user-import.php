<?php

function import($package, $module = "") {
    if ($module === "") {
        $module = "index";
    }

    if (!file_exists(__DIR__ . "/$package")) {
        throw new Exception("Package '$package' does not exists");
    }

    if (!file_exists(__DIR__ . "/$package/absol_modules/$module.php")) {
        throw new Exception("Package '$package' does not include ". ($module === "index" ? "default" : $module) ." absol module");
    }

    var_dump(__DIR__ . "/$package/absol_modules/$module.php");
    require_once __DIR__ . "/$package/absol_modules/$module.php";
}