<?php
/**
 * Esta clase aun requiere que se maneje cuando el usuario entra
 * a una URL que no existe, todo esto se maneja en los doncionales
 * mas abajo
 *
 * El enrutador toma la url capturada por request.php y explota la url en 3
 * partes diferentes en el carácter "/":
 *
**/
class Router
{

    static public function parse($url, $request)
    {
        $url = trim($url);

        if ($url == "/ligne_php/")
        {
            $request->controller = "tasks";
            $request->action = "index";
            $request->params = [];
        }
        else
        {
            $explode_url = explode('/', $url);
            $explode_url = array_slice($explode_url, 2);
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
        }

    }
}