<?php

global $cwd;

require_once __DIR__ . "/../generate-lock-file.php";



function gen($cwd) {
    $config = "$cwd/absol.json";

    if (!file_exists($config)) {
        echo "There is no config file in this project. Looking for: '$config'";
        return;
    }

    $success = generate_lock_file($config);

    if (!$success) {
        echo "Could not generate lock file";
    }
}



gen($cwd);