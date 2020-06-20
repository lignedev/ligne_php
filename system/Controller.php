<?php
/**
 * All created drivers must inherit
 * of this controller for the operation of the same since
 * contains the data mapping and rendering of the caliper and views
 **/
use Ligne\ErrorHandler;

class Controller
{
    /**
     * $vars is the data you want pass to view, arrays, string, class, object.
     **/
    private $vars = [];

    /**
     * Default layout views, if you want render by default in another file
     * change this value
     **/
    private $layout = "base";

    /**
     * A page title, you can pass this in render method
     **/
    private $pageTitle;

    /**
     * This method send all the data to you views, arrays, strings, objects.
     *
     * Example: $data['foo'] = 'bar';
     *
     * @param $data
     */
    function setData(array $data):void
    {
        $this->vars = array_merge($this->vars, $data);
    }

    /**
     * Load your view file and pass all data you pass in setData method
     *
     * @param string $filename | You view file name, in general this have same name of the action or other name in view dir controller learn more https://ligne-framework.gitbook.io/ligne-framework-php/documentacion/controlador
     * @param string $title | Title page you want display to user
     * @param bool $external_view | Use for specific another view is you want not load the default controller view
     * @param string $other_layout | If you want specific other layout to render your view
     */
    function render(string $filename,string $title = null,bool $external_view = false,string $other_layout = null):void
    {
        extract($this->vars,EXTR_OVERWRITE);
        ob_start();
        if($external_view){
            $view_file = __ROOT__DIR__ . "src/views/" . $filename . '.php';
        }else{
            $view_file = __ROOT__DIR__ . "src/views/" . strtolower(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php';
        }

        if(file_exists($view_file))
            require($view_file);
        else
            $this->viewNonexists($filename);

        $this->pageTitle = $title;
        $this->layout = ($other_layout != null)? $other_layout : $this->layout;
        http_response_code(200);
        $this->renderLayout(ob_get_clean());
    }


    /**
     * @param $content_for_layout
     */
    private function renderLayout(string $viewContent):void{
        //The pageTitle var create here for scope visibility
        $pageTitle = ($this->pageTitle != null)? $this->pageTitle : null ;
        if(file_exists(__ROOT__DIR__ . "template/" . $this->layout . '.php')){
            require(__ROOT__DIR__ . "template/" . $this->layout . '.php');
        }else {
            $this->defaultLayoutNotFound();
        }
    }

    /**
     * Redirect user to internal route in project or external route
     *
     * array ( 'controller'  =>  'myController' ,  'action'  =>  'foo' , [2])
     * Or internet route 'https://google.com'
     *
     * @param $redirecTo
     * @param null $param
     */
    function redirect($redirecTo,$param = null) :void {
        if(is_array($redirecTo)) {
            $root_dir = $_SERVER['REQUEST_URI'];
            $root_dir = explode('/',$root_dir);
            $param_ = ($param == null )? '' : '/' . $param;
            header('Location: '. '/' . $root_dir[1] . '/' . $redirecTo['controller'] . '/' . $redirecTo['action'] . $param_ );
        }else
            header('Location: '.$redirecTo);
    }

    /**
     * Show error 500 HTTP status if the view you specific in your controller
     * @param $filename
     */
    private function viewNonexists(string $filename):void{
        $errorHandler = new ErrorHandler(ENVIROMENT);
        $errorHandler->showDevMessages("View not found",
            "<span class='special_name_element'>' $filename '</span> view not found");
    }
    /**
     * Is the default layout no exits
    **/
    private function defaultLayoutNotFound():void {
        $errorHandler = new ErrorHandler(ENVIROMENT);
        $errorHandler->showDevMessages("Problem loading the default layout",
            "The default layout could not be loaded, probably it is not with the name that has been configured or does not exist.",
            __ROOT__DIR__ . "views/template/" . $this->layout . '.php');
    }

}
