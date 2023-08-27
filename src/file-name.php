<?php

function file_name($file) {
    for ($i = strlen($file) - 1; $i >= 0; $i--) {
        if ($file[$i] === ".") {
            return substr($file, 0, $i);
        }
    }

    return "";
}