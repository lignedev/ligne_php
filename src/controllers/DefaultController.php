<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 1/10/2018
 * Time: 3:34 PM
 */
/**
 * Este es el controlador que el framework carga internamente si
 * se ingresa al dominio del sitio.
**/


class DefaultController extends Controller
{
    /**
     * Esto es un metodo de ejemplo, puede ser cambiado a tu gusto
     */
    public function index()
    {
        $data['framework_name'] = "Ligne Framework";
        $data['version'] = "2.0.0 Dev";
        $data['environment'] = "Dev";
        $data['date'] = "* 2019";
        $data['externalComponentsIncluded'] = ["Ligne/Error Handler","Symfony/HttpFoundation","Izniburak/PDOX"];
        $data['autor'] = "Albert Eduardo Hidalgo Taveras";
        $this->setData($data);
        $this->render("index",'Ligne v2');
    }
}