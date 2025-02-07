<?php
// autoload.php

spl_autoload_register(function ($class) {
    // Convert namespace to file path
    $class = str_replace('App\\', '', $class);
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . '/' . $class . '.php';

//var_dump($file);
//exit;

    if (file_exists($file)) {
        require $file;
    }
});
