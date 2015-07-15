<?php
function autoload($className) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $className).'.php';

    require_once($path);
}
spl_autoload_register('autoload');

