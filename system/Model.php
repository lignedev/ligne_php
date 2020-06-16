<?php
/**
 * Intermediate class and extendable for all database models.
 * Using Pdox library.
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
            $this->credentials = $_ENV;

            $this->config = [
                'host'		=> $this->credentials["HOST"],
                'driver'	=> $this->credentials["DRIVER"],
                'database'	=> $this->credentials["DB_NAME"],
                'username'	=> $this->credentials["USER"],
                'password'	=> $this->credentials["PASSWORD"],
                'charset'	=> $this->credentials["CHARSET"],
                'collation'	=> $this->credentials["COLLATION"],
                'prefix'	=> $this->credentials["PREFIX"],
                'port'	=> $this->credentials["PORT"],
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