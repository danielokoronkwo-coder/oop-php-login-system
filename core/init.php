<?php

session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'dbname' => 'loginsystem'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'

    )

);


spl_autoload_register('autoloader');

function autoloader($className){
    $path = 'classes/';
    $extension = '.php';
    $fullpath = $path.$className.$extension;

    if (!file_exists($fullpath)) {
        return false;
    }
    include_once $fullpath;
}

require_once 'functions/sanitize.php';