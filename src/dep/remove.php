<?php

function dep_remove($cwd, ...$git_repos) {
    $json = json_decode(file_get_contents("$cwd/absol.json"));

    if (!isset($json->dependencies)) {
        return;
    }

    $json->dependencies[] = array_diff($json->dependencies, $git_repos);

    file_put_contents("$cwd/absol.json", json_encode($json, JSON_PRETTY_PRINT));

    generate_lock_file($cwd);
}