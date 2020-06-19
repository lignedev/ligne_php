<?php
/**
 * The dispatcher is doing the same job as an air traffic controller.
 * When a new request is loaded, select the driver and the
 * action with parameters. So with a single method (dispatch ()), we can
 * start all this routing logic.
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
     * Loads a driver based on the requested URL
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
     * It is used to know if the variable that contains the action
     * This empty, if empty, no valid action has been entered
     * or controller method
     * @param $ action [Controller method]
     *
     * @return bool
     */
    public function isEmptyAction(string $action):void{
        if(empty($action)){
            Router::showInvalidAction();
        }
    }
}
