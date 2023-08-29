<?php

function dep_remove($config_file, $git_repo) {
    if (!file_exists($config_file)) {
        echo "Config file does not exist: '$config_file'";
    }

    $json = json_decode(file_get_contents("$config_file"));

    if (!isset($json->dependencies)) {
        return;
    }

    $index = array_search($git_repo, $json->dependencies);

    if ($index === false) {
        return;
    }

    array_splice($json->dependencies, $index, 1);

    file_put_contents("$config_file", json_encode($json, JSON_PRETTY_PRINT));

    generate_lock_file($config_file);
}