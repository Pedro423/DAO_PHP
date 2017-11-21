<?php
// Faz o autoload das classes que são necessarias por (include/require)
spl_autoload_register(function($className) {
    $filename = "class".DIRECTORY_SEPARATOR.$className.".php";
    if(file_exists($filename)) {
        require_once($filename);
    }
});
