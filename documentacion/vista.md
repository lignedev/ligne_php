# 👁️ Vista



**Vistas**

Las vistas son responsables de generar la salida específica requerida para la solicitud. A menudo, esto es en forma de HTML o PHP.

La capa de visualización de Ligne es la forma en que le hablas a tus usuarios. La mayoría de las veces, sus vistas mostrarán \(X\) documentos HTML en los navegadores.

Por defecto, los archivos de vista de Ligne están escritos en PHP plano. Estos archivos contienen toda la lógica de presentación necesaria para obtener los datos que recibió del controlador en un formato que está listo para el usuario al que se dirige.

Un archivo de vista se almacena en `/View/` una subcarpeta que lleva el nombre del controlador que usa el archivo. Tiene un nombre de archivo correspondiente a su acción. Por ejemplo, el archivo de vista para la acción "`create ()`" del controlador Task normalmente se encuentra en `/View/Tasks/create.php`

La capa de vista de Ligne puede estar compuesta de varias partes diferentes. Cada parte tiene diferentes usos:

* **vistas**: Las vistas son la parte de la página que es exclusiva de la acción que se está ejecutando.
* **Layout**: Esto es el esqueleto de tus vistas, dentro de esta carpeta está el main layout \(por nombrarlo de una manera\), este te permite mantener una única estructura en todo tu proyecto ya que todas las vistas se renderizan dentro de este.



**Diseños**

Un diseño contiene un código de presentación que se ajusta a una vista. Cualquier cosa que desee ver en todas sus vistas debe colocarse en un diseño.

El diseño por defecto de Ligne se encuentra en `/View/Layouts/default.php` Si desea cambiar el aspecto general de su aplicación, este es el lugar correcto para comenzar, ya que el código de vista renderizado por el controlador se coloca dentro del diseño predeterminado cuando se representa la página.

Otros archivos de diseño deben colocarse en `/View/Layouts/`. Cuando creas un diseño, necesitas decirle a Ligne dónde colocar la salida de tus vistas. Para hacerlo, asegúrese de que su diseño incluya un lugar para `$content_for_layout` Aquí hay un ejemplo del aspecto que podría tener un diseño predeterminado:

```php

< !doctype html>
 < html>
  < head>
    <meta charset="utf-8">
    <title>Ligne Framework</title>
  < /head>
  < body>
    <!--?=
    /**
     * Aqui se renderizan todas las vistas con el mismo layout
     **/
     $content_for_layout;
    ?-->
  < /body>
 < /html>
```

**Assets o recursos**

Los Assets o recursos son todas aquellas cosas que complementa una página web llámese a estos JavaScript, CSS, fuentes, imágenes, etc...

Ligne cuenta con una clase Assets estática que le brinda una ayuda para enlazar recursos a sus vistas;

```php

< !doctype html>
 < html>
  < head>
     <meta charset="utf-8">
     <title>Ligne Framework</title>

   //Agregando una hoja de estilos
   <link href="<?= Assets::setAssets('css/style.css') ?>" rel="stylesheet">
   //Agregando un script
   <script src="<?= Assets::setAssets('js/myscript.js') ?>"></script>

 < /head>
    
```

Notese que se ha indicado dentro del método `setAssets()` el directorio **css** y el recurso que se solicita **style.css** esto ayuda a la clase a saber en que lugar buscar los recursos.

Esto no se limita solo a esto ya que puede buscar en subdirectorios;

```php

<script src="<?= Assets::setAssets('js/foo/myscript.js') ?>"></script>
    
```

La llamada siempre debe estar acompañada del directorio raíz, si este recurso no se encuentra, el navegador es quien le dirá esto.

**Las vistas y la interacción con los datos**

Las vistas pueden recibir una cantidad de datos enormes, inclusive matrices. Estos datos son pasados del controlador a la vista por el método `setData()` por lo que podemos pasar una consulta de las tareas que tenemos en nuestra app;

```php

use Models\Tasks\Task;

 class TasksController extends Controller
 {
    public function index()
    {
        $tasks = new Task();

        //Consultando todos los datos en la base de datos
        $data['tasks'] = $tasks->showAllTasks();

        //envia datos a la vista
        $this->setData($data);

        //Renderiza la vista
        $this->render("index");
    }

 }
    
```

En este caso el controlador **`TaskController`** en su método **index** está solicitando todas las tareas que existen en la base de datos mediante el modelo Task \(El modelo se explica más adelante\).

En la vista `/views/Tasks/index.php` ya podremos interactuar con los datos que le hemos enviado desde el controlador;

| **ID** | **Task** | **Description** | **Date Success** |
| :--- | :--- | :--- | :--- |
| 1 | Other | Foo | 2018-10-09 09:56:19 |
| 2 | Bar | One breack at 14:00 | 2018-10-08 10:07:12 |

Note que hemos usado el ciclo **foreach** para iterar el arreglo que hemos recibido con las tareas ya creadas. Los índices **id**, **title**, **description** y **created\_at** de la matriz son los nombres de los campos de nuestra tabla **tasks** en la base de datos.

```php
< ?php foreach ($tasks as $task): ?>
    < tr>
        < td>< ?= $task["id"] ? > < / td>
        < td>< ?= $task["title"] ? > < / td>
        < td>< ?= $task["description"] ? > < / td>
        < td>< ?= $task["created_at"] ? > < / td>
    < / tr>
< ?php endforeach; ?>
    
```

**Funciones extras**

El método `render()` es capaz de renderizar varias vistas, esto puede ser útil cuando quieres tener tus vistas fragmentadas **header**, **side,** **body** y **footer** por separado, un ejemplo de esto sería lo siguiente;  


```php
public function home()
{
    $this->render('header');
    $this->render('aside');
    $this->render('body');
    $this->render('footer');
}
```

