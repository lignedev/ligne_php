<?php
/**
 * Todos los controladores creados deben heredar
 * de este controlador para el funcionamiento de los mismos ya que
 * contiene el asignamiento de los datos y el renderizado de la pantilla y vistas
 **/
use Ligne\ErrorHandler;

class Controller
{
    /**
     * Almacena los datos que se quieren pasar a la vista
     **/
    private $vars = [];
    /**
     * Contiene el nombre de la 'vista' donde se renderizaran las vistas, por defecto
     * este sera el "base.php" almacenado en ROOT/template/base.php, el metodo render
     * acepta un argumento para especificar otro archivo de plantilla base que debe
     * estar almacenado dentro de este directorio
     **/
    private $layout = "base";

    /**
     * Esta propiedad esta definida para establecer el titulo de la pagina
     * que este a su vez es pasado por el metodo render y se utiliza en el metodo render_layout
     **/
    private $pageTitle;

    /**
     * fusionará todos los datos que queremos pasar a la vista.
     * Cualquier datos que le pasemos este lo envia a la vista, preferiblemente pasar arreglos.
     *
     * eje: $data['foo'] = 'bar';
     *
     * @param $data
     */
    function setData(array $data):void
    {
        $this->vars = array_merge($this->vars, $data);
    }

    /**
     * importará los datos con el método extract y luego
     * cargará el diseño solicitado en el directorio views. Además, esto nos
     * permite tener un diseño para evitar la estúpida repetición de HTML en nuestras vistas.
     *
     * El parametro @external_view Se utiliza para indicarle al metodo
     * @render si la vista que se esta cargando no esta dentro del ambito
     * del controlador actual, es util para cargar componentes de otras vistas
     * o otras vistas completas
     *
     * @param $filename
     * @param null $title
     * @param bool $external_view
     * @param null $other_layout
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
     * Requiere el layout existente y dentro pasa el contenido
     * que se envio al controlador
     * @param $content_for_layout
     */
    private function renderLayout(string $viewContent):void{
        //Se crea esta propiedad aqui para que este diponible en el layout
        $pageTitle = ($this->pageTitle != null)? $this->pageTitle : null ;
        if(file_exists(__ROOT__DIR__ . "template/" . $this->layout . '.php')){
            require(__ROOT__DIR__ . "template/" . $this->layout . '.php');
        }else {
            $this->defaultLayoutNotFound();
        }
    }

    /**
     * Este metodo es utilizado para redirigir sea a un controlador
     * o a una url fuera del proyecto, tambien admite un segundo parametro opcional
     *
     * array ( 'controller'  =>  'myController' ,  'action'  =>  'foo' , [2])
     *
     * @param $redirecTo
     * @param null $param
     */
    function redirect($redirecTo,$param = null) :void {
        if(is_array($redirecTo)) {
            $root_dir = $_SERVER['REQUEST_URI'];
            $root_dir = explode('/',$root_dir);
            $param_ = ($param == null )? '' : '/' . $param;
            header('Location: '. PROTOCOL . '://' . $_SERVER['SERVER_NAME'] . '/' . $root_dir[1] . '/' . $redirecTo['controller'] . '/' . $redirecTo['action'] . $param_ );
        }else
            header('Location: '.$redirecTo);
    }

    /**
     * Este metodo es llamado si el archivo con el nombre de la vista
     * no existe, muestra el usuario que la vista no existe
     * @param $filename
     */
    private function viewNonexists(string $filename):void{
        $errorHandler = new ErrorHandler(ENVIROMENT);
        $errorHandler->showDevMessages("Error archivo vista",
            "La vista <span class='special_name_element'>' $filename '</span> no fue encontrada");
    }
    /**
     * Este metodo es solo utilizado para mostrar al usuario
     * que el layout que ha elegido no es valido en caso se no serlo
    **/
    private function defaultLayoutNotFound():void {
        $errorHandler = new ErrorHandler(ENVIROMENT);
        $errorHandler->showDevMessages("Problema al cargar el default Layout",
            "No se ha podido cargar el layout por defecto, probablemente no este con el nombre que se ha configurado o no exista.",
            __ROOT__DIR__ . "views/template/" . $this->layout . '.php');
    }

}
