<?php

function generate_lock_file($cwd) {
    return copy("$cwd/absol.json", "$cwd/absol.lock.json");
}