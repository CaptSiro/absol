<?php

function starts_with($haystack, $needle) {
    $len = strlen($needle);

    if ($len > strlen($haystack)) {
        return false;
    }

    for ($i = 0; $i < $len; $i++) {
        if ($needle[$i] !== $haystack[$i]) {
            return false;
        }
    }

    return true;
}