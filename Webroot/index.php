<?php
/**
 * WebRoot Es el archivo que enlaza todos los mecanismos globales del Framework
**/

//Constantes
define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));
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
 * Esta funcion es utilizada para mostrar los errores mas comunes en una vista
 * mas amigable para el desarrollador, no deberia estar en modo de produccion ya que
 * prodria revelar datos que usted no desea que los usuarios sepan
 *
 * Acceso a base de datos, rutas, nombre de clases, directorios, etc...
**/
function __show_dev_messages__($header,$description,$route = null){
    if(ENVIROMENT == 'dev'){
        include (ROOT . 'Core/System/Core/pages_messages/Views/code_messages/messages.php');
        die();
    }else{
        include (ROOT . 'Core/System/Core/pages_messages/Views/for_production_page/index.html');
        die();
    }
}

//algunos archivos
require(ROOT . 'Core/System/Core/core.php');

require(ROOT . 'router.php');
require(ROOT . 'request.php');
require(ROOT . 'dispatcher.php');
require(ROOT . 'Core/Assets.php');

$dispatch = new Dispatcher();
$dispatch->dispatch();