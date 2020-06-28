<?php
//自动加载
define('BANJULOG_ROOT', dirname(__FILE__) . '/');
function banjulogAutoload($classname) {
    $parts = explode('\\', $classname);
    $path = BANJULOG_ROOT . 'log/src/' . implode('/', $parts) . '.php';
    if (file_exists($path)) {
        include($path);
    }
}
spl_autoload_register('banjulogAutoload');
