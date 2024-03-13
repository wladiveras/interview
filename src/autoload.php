<?php
spl_autoload_register(function ($class_name) {
    $dirs = [
        'core/',
        'controllers/',
        'models/',
        'helpers/',
        'core/',
        'config/'
    ];

    foreach ($dirs as $dir) {
        $file = $dir . $class_name . '.php';
        if (file_exists($file)) {
            require_once ($file);
        }
    }
});