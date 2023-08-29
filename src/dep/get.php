<?php

function dep_get($config_file) {
    if (!file_exists($config_file)) {
        return false;
    }

    $json = json_decode(file_get_contents($config_file));

    if (!isset($json->dependencies)) {
        return [];
    }

    return $json->dependencies;
}