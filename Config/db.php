<?php

class Database
{
    private static $bdd = null;
    private static $credentials;

    private function __construct() {
    }

    public static function getBdd() {

        /* Leer credenciales desde el  archivo ini */
        self::$credentials = parse_ini_file("config.php.ini");
        $dsn = 'mysql:dbname=' . self::$credentials["dbname"] . ';host=' . self::$credentials["host"] . '';
        $pwd = self::$credentials["pass"];
        $usr = self::$credentials["user"];
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
            if(is_null(self::$bdd)) {
                self::$bdd = new PDO($dsn, $usr, $pwd, $options);
            }
            return self::$bdd;
        }
        catch (PDOException $e) {
            # Escribir posibles excepciones en el error_log
            error_log($e->getMessage(),0);
        }
    }
}