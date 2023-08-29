<?php

function dep_add($config_file, $git_repo) {
    if (!file_exists($config_file)) {
        echo "Config file does not exist: '$config_file'";
    }

    $json = json_decode(file_get_contents("$config_file"));

    if (!isset($json->dependencies)) {
        $json->dependencies = [$git_repo];
    } else {
        if (in_array($git_repo, $json->dependencies)) {
            return;
        }

        $json->dependencies[] = $git_repo;
    }

    file_put_contents("$config_file", json_encode($json, JSON_PRETTY_PRINT));

    generate_lock_file($config_file);
}