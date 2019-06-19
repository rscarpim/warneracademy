

<?php

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;   
} else { 
    

    /* Starting the Session  */
    session_start();


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);    


    /* Defining the Constants. */
    define('DEFAULT_CONTROLLER', 'home');
    define('DEFAULT_METHOD', 'index');
    define('ROOT', $_SERVER['DOCUMENT_ROOT']);


    /* Definindo as Constrantes SQL. */
    define('sql_select', 'select * from ');    



    /* The Required Classes. */
    require '../vendor/autoload.php';

    require '../App/Functions/functions_twig.php';

    require 'bootstrap/bootstrap.php';
}