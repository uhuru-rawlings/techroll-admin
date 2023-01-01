<?php
    session_start();
    define ('ROOT_PATH', realpath(dirname(__FILE__)));
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    if($_SERVER['HTTP_HOST'] == "127.0.0.1" || $_SERVER['HTTP_HOST'] == "localhost"){
        define('BASE_URL', 'http://localhost/Techroll/');
    }else{
        define('BASE_URL', 'https://admin.techrollblogs.com');
    }
?>
