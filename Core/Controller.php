<?php
/**
 * Todos los controladores creados deben heredar
 * De este controlador para el funcionamiento de los mismos
 **/
class Controller
{
    var $vars = [];
    var $layout = "default";

    /**
     * fusionará todos los datos que queremos pasar a la vista.
     * Cualquier datos que le pasemos este lo envia a la vista, preferiblemente pasar arreglos
     *
     * @param $data
     */
    function set($data)
    {
        $this->vars = array_merge($this->vars, $data);
    }

    /**
     * importará los datos con el método extract y luego
     * cargará el diseño solicitado en el directorio Views. Además, esto nos
     * permite tener un diseño para evitar la estúpida repetición de HTML en nuestras vistas.
     * @param $filename
     */
    function render($filename)
    {
        extract($this->vars);
        ob_start();
        require(ROOT . "Views/" . ucfirst(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php');
        $content_for_layout = ob_get_clean();

        if ($this->layout == false){
            $content_for_layout;
        }else{
            require(ROOT . "Views/Layouts/" . $this->layout . '.php');
        }
    }

    private function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function secure_form($form)
    {
        foreach ($form as $key => $value)
        {
            $form[$key] = $this->secure_input($value);
        }
    }

}