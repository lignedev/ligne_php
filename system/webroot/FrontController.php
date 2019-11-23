<?php
//Constantes
define('__ROOT__DIR__', str_replace("system/webroot/FrontController.php", "", $_SERVER["SCRIPT_FILENAME"]));
/**
 * Carga todas las clases que se utilicen con la
 * palabra clase use, esto es gracias al namespace
 **/
require_once __ROOT__DIR__.'vendor/autoload.php';
/**
 * WebRoot Es el archivo que enlaza todos los mecanismos globales del Framework
 **/

/**
 * Verifica la version del servidor, las versiones debajo de la 7.1.3 no soportan
 * ciertas caracteristicas como la palabra recervada const en propiedades de clases.
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
 * Esta constante define el protocolo utilizado en el momento, es utilizado principlamente para
 * agregar los assets y el redireccionamiento con el metodo del Controller principal
 **/
define('PROTOCOL','http');
/**
 * Esta constante se define para determinar en que entorno se encuentra la aplicacion usando
 * el framework, esto para evitar mostrar errores no deseados a los usuarios cuando
 * el sistema esta en produccion
 **/
define('ENVIROMENT','dev');

/**
 * El el nucleo centrar el framework, carga clases escenciales
 * para el funcionamiento
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
