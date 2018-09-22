<?php
    class Request
    {
        public $url;

        /**
         * Request constructor.
         * El objetivo de este archivo es obtener la URL solicitada por el usuario.
         */
        public function __construct()
        {
            $this->url = $_SERVER["REQUEST_URI"];
        }
    }
