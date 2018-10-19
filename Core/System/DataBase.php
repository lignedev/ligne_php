<?php
/**
 * Esto es un singleton para la conexion a la base de datos utilizando PDO
 **/


class Database
{
    private $bdd = null;
    private $credentials;
    private $config;

    public function getBdd() {
        // Leer credenciales desde el  archivo ini
        $this->credentials = parse_ini_file(ROOT . "Config/config.php.ini");

        $this->config = [
            'host'		=> $this->credentials["host"],
            'driver'	=> $this->credentials["driver"],
            'database'	=> $this->credentials["dbname"],
            'username'	=> $this->credentials["user"],
            'password'	=> $this->credentials["pass"],
            'charset'	=> $this->credentials["charset"],
            'collation'	=> $this->credentials["collation"],
            'prefix'	=> $this->credentials["prefix"]
        ];

        try {
            if(is_null($this->bdd)) {
                /**
                 * Pdox es un Query Builder usado para facilitar la manera en que se
                 * hacen las consultas a la base de datos, es una clase bien completa
                 * que contiene metodos para toda clase de consultas
                **/
                require(ROOT . "Core/System/pdox/Pdox.php");

                $this->bdd = new Pdox($this->config);
            }
            return $this->bdd;
        }
        catch (PDOException $e) {
            error_log($e->getMessage(),0);
            echo $e->getMessage();

            echo '<h4>Code: ' . $e->getCode() . '</h4>';
            die();
        }
    }

    /**
     * Este metodo se utiliza para obtener una conexiona  la base de datos y realizar consultas normales
     * @return null|PDO
     */
    public function getConection(){
        /* Leer credenciales desde el  archivo ini */
        $this->credentials = parse_ini_file(ROOT . "Config/config.php.ini");
        $dsn = 'mysql:dbname=' . $this->credentials["dbname"] . ';host=' . $this->credentials["host"] . '';
        $pwd = $this->credentials["pass"];
        $usr = $this->credentials["user"];
        /**
         *	El array $options es muy importante para tener un PDO bien configurado
         *
         *	1. PDO::ATTR_PERSISTENT => false: sirve para usar conexiones persistentes
         *      se puede establecer a true si se quiere usar este tipo de conexión. Ver: https://es.stackoverflow.com/a/50097/29967
         *      Aunque en la práctica, el uso de conexiones persistentes podría ser problemático
         *	2. PDO::ATTR_EMULATE_PREPARES => false: Se usa para desactivar emulación de consultas preparadas
         *      forzando el uso real de consultas preparadas.
         *      Es muy importante establecerlo a false para prevenir Inyección SQL. Ver: https://es.stackoverflow.com/a/53280/29967
         *	3. PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION También muy importante para un correcto manejo de las excepciones.
         *      Si no se usa bien, cuando hay algún error este se podría escribir en el log revelando datos como la contraseña !!!
         *	4. PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'": establece el juego de caracteres a utf8,
         *      evitando caracteres extraños en pantalla. Ver: https://es.stackoverflow.com/a/59510/29967
         */
        $options = array(
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
        );

        try {
            if(is_null($this->bdd)) {
                $this->bdd = new PDO($dsn, $usr, $pwd, $options);
            }
            return $this->bdd;
        }
        catch (PDOException $e) {
            error_log($e->getMessage(),0);
        }

    }
}