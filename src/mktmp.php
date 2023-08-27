<?php

function mktmp($cwd) {
    return "$cwd/absol/tmp/tmp_". microtime(true);
}