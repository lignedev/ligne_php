<?php
/**
 * Esta clase es el intermediario entre los modelos y
 * la clase Database, esto con el objetivo de mantener
 * una estructura solida y poco confusa
 **/
namespace System;

use Buki\Pdox;

class Model
{
    private $bdd = null;
    private $credentials;
    private $config;

    public function db() {
        if(is_null($this->bdd)) {
            // Leer credenciales desde el  archivo ini
            $this->credentials = parse_ini_file(__ROOT__DIR__ . "system/config/config.php.ini");

            $this->config = [
                'host'		=> $this->credentials["host"],
                'driver'	=> $this->credentials["driver"],
                'database'	=> $this->credentials["dbname"],
                'username'	=> $this->credentials["user"],
                'password'	=> $this->credentials["pass"],
                'charset'	=> $this->credentials["charset"],
                'collation'	=> $this->credentials["collation"],
                'prefix'	=> $this->credentials["prefix"],
                'port'	=> $this->credentials["port"],
                'debug' =>false
            ];
            /**
             * Pdox es un Query Builder usado para facilitar la manera en que se
             * hacen las consultas a la base de datos, es una clase bien completa
             * que contiene metodos para toda clase de consultas
             **/
            $this->bdd = new Pdox($this->config);
        }
        return $this->bdd;
    }
}