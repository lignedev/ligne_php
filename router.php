<?php
/**
 * Esta clase controla inclusive si en la url se ha ingresado un controlador
 * inexistente o un metodo del controlador que no existe con la siguiente jerarquía:
 *
 * http://host/controller/action/[parameter]
 *                  ^        ^
 *            1ro verifica   2da verifica
 *
 * Hasta que la primera condicion no se de este no continua, siendo esta una manera
 * se asegurarse de que el controlador este correcrto para poder verificar
 * que el metodo sea parte de ese controlador.
 *
 * El enrutador toma la url capturada por request.php y explota la url en 3
 * partes diferentes en el carácter "/":
 *
 **/
class Router
{
    private static $main_project_name = "/ligne_php/";//Reemplaza el contenido con el nombre de tu carpeta root

    static public function parse($url, $request){
        $url = trim($url);
        $explode_url = explode('/', $url);
        $explode_url = array_slice($explode_url, 2);

        if ($url == self::$main_project_name )
            self::load_index($request);
        elseif(self::is_array_url_valid($explode_url))
            self::route_construct($request,$explode_url);
        else
            self::show_nonexistent_controller();
    }

    /**
     * Constuye la url si esta es valida, digase que exista el controlador
     * y su accion
     * @param $request
     * @param $explode_url
     */
    static private function route_construct($request, $explode_url){
        $request->controller = $explode_url[0];
        $request->action = $explode_url[1];
        $request->params = array_slice($explode_url, 2);
    }
    /**
     * Carga el index de la aplicacion esto puede ser configurado
     * para que el usuario vea el index que se desea con solo cambiar el controller y
     * el action que se desea vea el usuario
     * @param $request
     */
    static public function load_index($request){
        $request->controller = "default";
        $request->action = "index";
        $request->params = [];
    }
    /**
     * Verifica que la $url sea un arreglo de 2 o mas posiciones para obtener
     * una url valida
     * eje: http://localhost/ligne_php/Controller/Action/[parameter]
     *                                  ^          ^
     *                                $url[0]     $url[1]
     * @param $url Array
     *
     * @return bool
     */
    static private function is_array_url_valid($url){
        if (count($url) > 1)
            return true;
        else
            return false;
    }
    /**
     * Muestra una pantalla cuando en la ruta se ha insertado un
     * controller que no existe
     */
    static public function show_nonexistent_controller(){
        echo "<h1>El controlador no existe</h1><h3>Debe verificar la ruta que ha insertado</h3>";
        die();
    }

    /**
     * Muestra al usuario que la accion requerida esta vacia, no existe o es incorrecta
     */
    static public function show_invalid_action(){
        echo "<h1>Accion inexistente para la url</h1>" . "<h3>" . $_SERVER['REQUEST_URI'] . "</h3>";
        die();
    }

    /**
     * Muestra al usuario que el metodo del controlador no existe
     * @param $method String
     */
    static public function show_action_no_exists($method){
        echo "El metodo <strong>" . $method . "</strong> no existe. Verifica tu clase.";
        die();
    }
}