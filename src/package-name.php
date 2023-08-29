<?php

function package_name($git) {
    return explode(".", basename($git))[0];
}

function package_name_pretty($name) {
    return "📦 '$name'";
}