<?php
/**
 * Implementations of PSR-4
 *
 * @link https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
 *
 * After registering this autoload function with SPL, the following line
 * would cause the function to attempt to load the \Foo\Bar\Baz\Qux class
 * from /path/to/project/src/Baz/Qux.php:
 *
 *      new \Foo\Bar\Baz\Qux;
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = null;

    // base directory for the namespace prefix
    $base_dir = ROOT;

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }else{
        showAutoLoadClassError($class);
    }
});

function showAutoLoadClassError($class){
            __show_dev_messages__("Error al cargar clase","No se ha podido cargar <span class='special_name_element'>$class</span> empiece verificando; <div>
<ul>
<li>Si ha hecho uso de una clase que existe</li>
<li>No ha hecho uso de la clase en el encabezado del archivo (palabra clave <span class='special_name_element'>use foo\bar;</span>)</li>
<li><span class='code'>namespace</span> de la clase que esta intentando instanciar esta correcto ?</li>
</ul>
</div>");
}
