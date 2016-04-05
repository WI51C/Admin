<?php

spl_autoload_register(function ($class) {
    $file = '../src/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        include_once $file;
    }
});