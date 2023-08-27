<?php

function rmdir_recursive($dir) {
    $entries = scandir($dir);

    $c = count($entries);

    for ($i = 0; $i < $c; $i++) {
        if ($entries[$i] === "." || $entries[$i] === "..") {
            continue;
        }

        $path = "$dir/$entries[$i]";

        if (is_dir($path)) {
            rmdir_recursive($path);
            continue;
        }

        unlink($path);
    }

    echo "\n";
    foreach (scandir($dir) as $item) {
        if ($item === "." || $item === "..") {
            continue;
        }

        echo "$item ";
    }

    rmdir($dir);
}