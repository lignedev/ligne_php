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
            /**
             * Load the database credentials of the config file
            */
            $this->credentials = parse_ini_file( str_replace('\\','/',__DIR__) . "/config/config.php.ini");

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
             * Load PDOX query builder for create a OOP abstraction for
             * database
             **/
            $this->bdd = new Pdox($this->config);
        }
        return $this->bdd;
    }
}