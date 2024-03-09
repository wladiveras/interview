<?php
function __autoload($class_name)
{
    $dirs = [
        'controllers/',
        'models/'
    ];

    foreach ($dirs as $dir) {
        $file = $dir . $class_name . '.php';
        if (file_exists($file)) {
            require_once($file);
        }
    }
}