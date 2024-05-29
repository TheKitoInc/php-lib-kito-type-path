<?php

spl_autoload_register(
    function ($classNameSpace) {
        $classNameSpace = explode(DIRECTORY_SEPARATOR, str_replace('/', DIRECTORY_SEPARATOR, str_replace("\\", DIRECTORY_SEPARATOR, $classNameSpace)));

        foreach ($classNameSpace as $key => $value) {
            if(empty($value) || $value == '.' || $value == '..') {
                unset($classNameSpace[$key]);
            }
        }

        $classPath = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $classNameSpace) . '.php';

        if(file_exists($classPath)) {
            require_once $classPath;
        }
    }
);
