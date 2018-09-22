<?php
/**
 * Created by PhpStorm.
 * User: Albert Eduardo Hidalgo Taveras
 * Date: 21/9/2018
 * Time: 5:40 PM
 */

class Assets
{
    /**
     * Recibe un string con el elemento que se pretende agregar al proyecto
     *      eje: 'css/main.css'
     *      eje: 'js/jquery.min.js'
     * Este retorna una url absoluta
     *
     * @param $asset
     *
     * @return string
     */
    static public function setAssets($asset)
    {
        $protocol = 'http';
        $domain = $_SERVER['SERVER_NAME'];
        $assets_dir = 'webassets';
        $url = $protocol . '://' . $domain . '/' . self::root_dir() . '/' . $assets_dir . '/' . $asset;
        return $url;
    }

    /**
     * Retorna el nombre de la carpeta base del proyecto
     * esto es relativo ya que la carpeta donde esta el framework podria
     * llamarse de cualquier manera y con esto se obtiene este nombre para
     * hacer referencia a los assets
     * @return string
     */
    static private function root_dir(){
        $root_dir = $_SERVER['REQUEST_URI'];
        $root_dir = explode('/',$root_dir);
        return $root_dir[1];
    }
}