<?php
/**
 * El despachador está haciendo el mismo trabajo que un controlador de tránsito aéreo.
 * Cuando se carga una nueva solicitud, selecciona el controlador y la
 * acción con parámetros. Entonces, con un solo método (dispatch ()),podemos
 * iniciar toda esta lógica de enrutamiento.
 *
 *  http://host/controller/action/[parameter]
 *
 **/
class Dispatcher
{

    private $request;

    public function dispatch():void
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $name = ucfirst($this->request->controller) . "Controller";
        $file = __ROOT__DIR__ . 'src/controllers/' . $name . '.php';

        if($this->isControllerFileExtis($file)){
            $controller = $this->getController($name,$file);
            $this->isEmptyAction($this->request->action);

            if(method_exists($controller, $this->request->action)){
                call_user_func_array([$controller, $this->request->action], $this->request->params);
            }else{
                Router::showActionNoExists($this->request->action);
            }
        }else{
            Router::showNonexistentController($this->request->controller);
        }
    }

    /**
     * Carga un controlador segun la URL solicitada
     * @return mixed
     */
    public function getController(string $name, string $file):object
    {
        require($file);
        $controller = new $name();
        return $controller;
    }

    private function isControllerFileExtis(string $file):bool{
        if(file_exists($file))
            return true;
        else
            return false;
    }

    /**
     * Se utiliza para saber si la variable que contiene la accion
     * Esta vacia, de estar vacia no se ha ingresado una accion valida
     * o metodo del controlador
     * @param $action [Metodo del controlador]
     *
     * @return bool
     */
    public function isEmptyAction(string $action):void{
        if(empty($action)){
            Router::showInvalidAction();
        }
    }
}
