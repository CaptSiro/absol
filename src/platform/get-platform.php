<?php



require_once __DIR__ . "/Dos.php";
require_once __DIR__ . "/Unix.php";



/**
 * @return Platform
 */
function get_platform() {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        return new Dos();
    }

    return new Unix();
}