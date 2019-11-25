<?php

use Ligne\ErrorHandler;

/**
  * This class controls even if a driver has been entered in the url
  * nonexistent or a controller method that does not exist with the following hierarchy:
  *
  * http: // host / controller / action / [parameter]
  * ^ ^
  * 1st verify 2nd verify
  *
  * Until the first condition of this is not given, it does not continue, this being a way
  * make sure the controller is correct to verify
  * that the method be part of that controller.
  *
  * The router takes the url captured by request.php and exploits the url in 3
  * different parts in the "/" character:
  *
  **/
class Router
{
    /**
     * Load the controller, action and params user request from a URL.
     *
     * @param $url
     * @param $request
     */
    static public function parse(string $url, object $request): void
    {
        $url = strtok(trim($url), '?');

        $controllerName = self::subtractControllerName($url);
        $actionNAme = self::subtractActionName($url);
        $params = self::subtractParams($url);

        if ($url == '/' . self::rootDir() . '/' || $controllerName === null)
            self::loadIndex($request);
        elseif ($controllerName !== null && $actionNAme !== null)
            self::routeConstruct($request, $controllerName,$actionNAme,$params);
        else
            self::showNonexistentController($controllerName);
    }

    /**
     * Construct the route base on URL
     * 
     * @param object $request
     * @param string $controllerName
     * @param string $actionName
     * @param array $params
     */
    static private function routeConstruct(object $request, string $controllerName,string $actionName,array $params): void
    {
        $request->controller = $controllerName;
        $request->action = $actionName;
        $request->params = $params;
    }

    /**
     * The default root project controller
     *
     * http://localhost/project/
     *
     * @param $request
     */
    static public function loadIndex(object $request): void
    {
        $request->controller = "default";
        $request->action = "index";
        $request->params = [];
    }

    /**
     * Check if the url have an controller and action
     * eje: http://localhost/ligne_php/Controller/Action/[parameter]
     *                                  ^          ^
     *                                $url[0]     $url[1]
     * @param $url Array
     *
     * @return bool
     */
    static private function isArrayUrlValid(array $url): bool
    {
        if (count($url) > 1)
            return true;
        else
            return false;
    }

    /**
     * Return main project dir for load controllers class files
     *
     * @return string
     */
    static private function rootDir(): string
    {
        $root_dir = str_replace('/system/core', '', __DIR__);
        $root_dir = explode('/', $root_dir);
        return $root_dir[count($root_dir) - 1];
    }

    /**
     * When the user insert a invalid controller this show a 500 HTTP Status error
     */
    static public function showNonexistentController(string $controller_name = null): void
    {
        $erroHandler = new ErrorHandler(ENVIROMENT);
        $erroHandler->showDevMessages("El controlador no existe",
            "Debe verificar la ruta que ha insertado, en realidad tiene un controlador con el nombre <span class='special_name_element'>$controller_name</span>", $_SERVER['REQUEST_URI']);
    }

    /**
     * Show HTTP 500 Status code and error if the actions not valid
     */
    static public function showInvalidAction(): void
    {
        $erroHandler = new ErrorHandler(ENVIROMENT);
        $erroHandler->showDevMessages("Acción  inexistente para la url",
            "Puede que este intentado realizar una acción que no exista, por ejemplo, para un controlador foo que tenga una acción bar la ruta seria http://dominio/foo/bar",
            $_SERVER['REQUEST_URI']);
    }

    /**
     * Show HTTP 500 Status code and error if the actions not exists
     * @param $method String
     */
    static public function showActionNoExists(string $method): void
    {
        $erroHandler = new ErrorHandler(ENVIROMENT);
        $erroHandler->showDevMessages("La acción ' " . $method . " ' no existe",
            "La acción solicitada al parecer no existe en el controlador");
    }

    /**
     * @param $url
     * @return mixed
     *
     * Subtract the controller name of the url using a root dir for
     * get relative url
     */
    static public function subtractControllerName($url)
    {
        $explodeUrl = explode('/', $url);
        $explodeRootDir = explode('/', __ROOT__DIR__);

        $explodeUrl = self::unsertKeysFromSourceArray($explodeUrl,$explodeRootDir);

        $explodeUrl = array_values($explodeUrl);
        return isset($explodeUrl[0]) ? $explodeUrl[0] : null;
    }

    static public function subtractActionName($url)
    {
        $explodeUrl = explode('/', $url);
        $explodeRootDir = explode('/', __ROOT__DIR__);

        $explodeUrl = self::unsertKeysFromSourceArray($explodeUrl,$explodeRootDir);

        $explodeUrl = array_values($explodeUrl);
        return isset($explodeUrl[1]) ? $explodeUrl[1] : null;
    }

    static public function subtractParams($url):array
    {
        $explodeUrl = explode('/', $url);
        $explodeRootDir = explode('/', __ROOT__DIR__);

        $params = self::unsertKeysFromSourceArray($explodeUrl,$explodeRootDir);

        $params = array_values($explodeUrl);
        //Exclude the controller and action from url
        for ($i = 0; $i <= 3; $i++)
            unset($params[$i]);
        $params = array_values($params);
        return (empty($params)) ? [] : $params;
    }

    /**
     * @param array $source
     * @param array $target
     * @return array
     *
     * Use for get the controller, action and paras from url
     * this recibe a $source (explode URL user request) and $target (explode root dir project)
     *
     * Unsert project "values" from the $url for determinate if the user specific the
     * controller, action and params
     */
    static private function unsertKeysFromSourceArray(array $source, array $target){
        foreach ($source as $key => $value) {
            if (in_array($value, $target)) {
                unset($source[$key]);
            }
        }
        return $source;
    }
}
