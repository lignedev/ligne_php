<?php
/**
 * Este archivo enlaza partes principales del Framework
 * El manejo de la base de datos, el Modelo y el Controlador
 **/
require(ROOT . "Core/System/DataBase.php");
require(ROOT . "Core/Model.php");
require(ROOT . "Core/Controller.php");

/**
 * Agregando utilitario
 *
 * Diponibles;
 * - Form Builder
 **/
$form_builder = ROOT . "Core/Util/form_builder/PhpFormBuilder.php";
$timeDiff = ROOT . "Core/Util/time/TimeDiff.php";
/**
 * Inclusion segura, si alguno no esta diponible arrojara error.
**/
if (file_exists($form_builder) && file_exists($timeDiff)){
    include_once ($form_builder);
    include_once ($timeDiff);
}else{
    echo "<h1>Error, archivo Utilitario perdido</h1>";
    echo "<h3>Ha ocurrido un error al tratar de incluir un archivo Utilitario, verifique el archivo Core del directorio Core/System/Core</h3>";
    die();
}





