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
     * Receives an string an set relative path of assets
     *      eje: 'css/main.css'
     *      eje: 'js/jquery.min.js'
     *
     * This no verify if the asset exists, if no exists you get a 404 HTTP Status error
     * in browser console.
     *
     * @param $asset
     * @param bool $cache
     * @return string
     */
    static public function setAssets(string $asset,bool $cache = true):string
    {
        $assets_dir = 'web/assets';
        return '/' . self::rootDir() . '/' . $assets_dir . '/' . $asset . self::cache($cache);
    }

    /**
     * @return string
     *
     * Return relative dir name
     */
    static private function rootDir():string {
        $root_dir = $_SERVER['REQUEST_URI'];
        $root_dir = explode('/',$root_dir);
        return $root_dir[1];
    }

    /**
     * Is a hack for keep in cache the assets, this put "?v1212" subfix
     * in the asset name
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
     * Return a string url for user in anchors
     *
     * Example: <a href=" <?= Assets::href("tasks/index")?> ">
     *                                   ^      ^
     *                               controller ^
     *                                        action
     *
     * @param $url [users/profile]
     * @param $param | mixed [ '1' or array [1 , "services", 2] ]
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
