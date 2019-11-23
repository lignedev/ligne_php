<?php
/**
 * Get the project relative dir for internal framework tasks
 */
define('__ROOT__DIR__', str_replace('system/webroot','',str_replace('\\','/',__DIR__)));

require_once __ROOT__DIR__.'vendor/autoload.php';

/**
 * Check if the version of php server is the current compatible version
 **/
if(version_compare(PHP_VERSION, '7.2', '>=') == false ){
    echo '<meta charset="UTF-8">';
    echo '<title>Versión | Error</title>';
    echo '<div style="margin: auto;text-align: center;font-family: sans-serif;margin-top: 70px;">';
    echo '<h1>Versión no compatible</h1>';
    echo '<h3>La versión de PHP que está utilizando no es compatible con LIGNE, favor utilizar una versión igual o superior a 7.1.3</h3>';
    echo '</div>';
    die();
}

/**
 * Global scope constant for specific the protocol to use
 **/
define('PROTOCOL','http');

/**
 * Enviroment specific to internal framework use.
 *
 * Examples;
 *
 * The framework use this constant for check if an error ocurred, show another
 * view and HTTP status code error
 **/
define('ENVIROMENT','dev');

/**
 * Load the main framework parts
 **/

require_once(__ROOT__DIR__ . 'system/Controller.php');
require_once(__ROOT__DIR__ . 'system/core/Router.php');
require_once(__ROOT__DIR__ . 'system/core/Request.php');
require_once(__ROOT__DIR__ . 'system/core/Dispatcher.php');
require_once(__ROOT__DIR__ . 'system/Assets.php');

use Ligne\ErrorHandler;

new ErrorHandler(ENVIROMENT);

$dispatch = new Dispatcher();
$dispatch->dispatch();
