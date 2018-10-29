<?php
/**
 * Created by PhpStorm.
 * User: Albert Eduardo Hidalgo Taveras
 * Date: 26/10/2018
 * Time: 11:31 PM
 *
 * El auto load tiene un problema, no puede cargar clases que extiendan
 * ya que esto implica que php cargue las clases bases de estos y ahi se
 * pierde la clase principal que se intento cargar.
 *
 * Esto se limita a cargar clases utilitarios
 */

spl_autoload_register('_autoload');
/**
 * Constante para evitar slash invertidos
 **/
define('DS','/');

function _autoload( $class ) {
    $class = ROOT  . str_replace("\\",DS,$class) . '.php';

    if(!file_exists($class)){
        //echo "Error al cargar la clase " . $class;
        __show_dev_messages__("Error al cargar clase","No se ha podido cargar <span class='special_name_element'>$class</span> empiece verificando; <div>
<ul>
<li>Si ha hecho uso de una clase que existe</li>
<li>No ha hecho uso de la clase en el encabezado del archivo (palabra clave <span class='special_name_element'>use foo\bar;</span>)</li>
<li><span class='code'>namespace</span> de la clase que esta intentando instanciar esta correcto ?</li>
</ul>
</div>");
        die();
    }else{
        require_once($class);
    }
}