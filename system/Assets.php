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
     * Tiene parametro opcional para determinar si se permitida que el navegador
     * almacene la cache de los assets
     *
     * @param $asset
     * @param bool $cache
     * @return string
     */
    static public function setAssets(string $asset,bool $cache = true):string
    {
        $domain = $_SERVER['SERVER_NAME'];
        $assets_dir = 'web/assets';
        return PROTOCOL . '://' . $domain . '/' . self::rootDir() . '/' . $assets_dir . '/' . $asset . self::cache($cache);
    }

    /**
     * Retorna el nombre de la carpeta base del proyecto
     * esto es relativo ya que la carpeta donde esta el framework podria
     * llamarse de cualquier manera y con esto se obtiene este nombre para
     * hacer referencia a los assets
     *
     * @return string
     */
    static private function rootDir():string {
        $root_dir = $_SERVER['REQUEST_URI'];
        $root_dir = explode('/',$root_dir);
        return $root_dir[1];
    }

    /**
     * Se utiliza para retornar el tiempo a la url de los assets para
     * evitar que el navegador almacene estos en cache
     *
     * @param $bool
     * @return string
     */
    static private function cache(bool $bool):string {
        if($bool === false){
            return '?' . time();
        }else{
            return '';
        }
    }

    /**
     * Retorna una URL valida dentro del proyecto donde no es necesario
     * especificar la carpeta root explicitamente
     *
     * eje: <a href=" <?= Assets::href("tasks/index")?> ">
     *                                   ^      ^
     *                             controlador  ^
     *                                          accion
     *
     * @param $url
     * @param null | mixed $param
     *
     * @return string
     */
    static public function href(string $url, $param = null):string {
        $new_url = explode('/',$url);
        $root_dir = explode('/',$_SERVER['REQUEST_URI']);
        $param = ($param == null)? '' : self::params($param) ;
        if(count($new_url) > 1){
            return '/' . $root_dir[1] . '/' . trim($new_url[0]) . '/' . trim($new_url[1]) . $param ;
        }else{
            return '/' . $root_dir[1] . '/' . 'novalid/url';
        }
    }

    static private function params($params):string {
        if(is_array($params)){
            $all_params = null;
            foreach ($params as $key => $value) {
                $all_params = $all_params . '/' . $value;
            }
            return $all_params;
        }else{
            $param = '/' . trim($params) ;
            return $param;
        }
    }
}
