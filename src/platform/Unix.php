<?php



require_once __DIR__ . "/Platform.php";



class Unix implements Platform {
    function remove_package_dir($package, $dir) {
        shell_exec("rm -rfI $dir");
    }
}