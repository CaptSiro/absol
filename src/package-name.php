<?php

function package_name($git) {
    return explode(".", basename($git))[0];
}