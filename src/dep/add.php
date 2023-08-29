<?php

function dep_add($cwd, ...$git_repos) {
    $json = json_decode(file_get_contents("$cwd/absol.json"));

    if (!isset($json->dependencies)) {
        $json->dependencies = [];
    }

    foreach ($git_repos as $git_repo) {
        if (!in_array($git_repo, $json->dependencies)) {
            $json->dependencies[] = $git_repo;
        }
    }

    file_put_contents("$cwd/absol.json", json_encode($json, JSON_PRETTY_PRINT));

    generate_lock_file($cwd);
}