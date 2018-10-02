<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 1/10/2018
 * Time: 3:34 PM
 */

/**
 * Esta clase es practicamente para ejemplos, se recomienda dejarla intacta
 * generalmente se utiliza para asegurarse que el framework esta funcionando
 * correctamente
**/
class defaultController extends Controller
{
    /**
     * Default index, se usa para ejemplo
     */
    function index()
    {
        $data['framework_name'] = "Ligne Framework";
        $data['version'] = "v0.2";
        $data['environment'] = "Dev";
        $data['date'] = "Oct 2018";
        $this->set($data); //envia datos a la vista
        $this->render("index"); //Renderiza la vista
    }
}