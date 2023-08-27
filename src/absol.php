#!/usr/bin/env php

<?php

if (count($argv) < 3) {
    echo "Not enough arguments passed";
    exit;
}

array_shift($argv);
$cwd = array_shift($argv);

$cmd = array_shift($argv);

if (!file_exists(__DIR__ . "/commands/$cmd.php")) {
    echo "Unknown command: $cmd";
    exit;
}

require __DIR__ . "/commands/$cmd.php";