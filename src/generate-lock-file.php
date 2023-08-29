<?php

function generate_lock_file($config_file) {
    $dir = dirname($config_file);

    return copy("$config_file", "$dir/absol.lock.json");
}