# ⛓️ Controlador

**Controladores**

Los controladores son el intermediario entre la vista \(Lo que ve el usuario\) y el modelo \(Interacción con la base de datos\).

Los controladores proporcionan una serie de métodos que manejan las solicitudes. Estas son llamadas de acciones. cada método público en un controlador es una acción, y es accesible desde una URL.

Una acción es responsable de interpretar la solicitud y crear la respuesta. Por lo general, las respuestas tienen la forma de una vista rende-rizada, pero también hay otras formas de crear respuestas.

Cada controlador creado debe heredar de la clase **Controller**, el **Controller** es la clase principal para todos los controladores de la aplicación. Esta clase está incluida en la biblioteca principal de Ligne.



```php
class tasksController extends Controller
{
    //Code…
}
```

**Acciones del controlador**

Las acciones del controlador son responsables de convertir los parámetros de solicitud en una respuesta para el usuario que realiza la solicitud.

Por convención, Ligne presenta una vista con una versión modulada del nombre de la acción. Crearemos un controlador de tareas como ejemplo, en el crearemos las acciones `allTack()`, `create()` y `edit()`



```php
class TasksController extends Controller //Herencia
{
    public function allTask()
    {
        //Código
    }
    
    public function create()
    {
        //Código
    }
    
    public function edit($id)
    {
        //Código
    }
}
```

Los archivos de vista de estas acciones serían `/View/Tasks/alltask.php`, `/View/Tasks/create.php` y `/View/Tasks/edit.php` El nombre del archivo de vista convencional es la versión en minúscula de la acción.

**Interactuando con Vistas**

Los controladores interactúan con las vistas de varias maneras. Primero, pueden pasar datos a las vistas, usando `setData()`. También puede decidir qué archivo de vista usar desde el controlador.

El método `setData()` es la forma principal de enviar datos desde su controlador a su vista. Una vez que haya usado `setData()`, se puede acceder a la variable en su vista:

```php

//Algun controlador
$data['date'] = "Oct 2018";
//envía datos a la vista desde el controlador
$this->setData($data);

```

```php

//Accediendo a los datos en la vista
La fecha es: <strong><!--?= $date ?--></strong>

```

El método `setData()` también toma una matriz asociativa como su primer parámetro. A menudo, esto puede ser una forma rápida de asignar un conjunto de información a la vista.

El método `render()` se llama al final de cada acción del controlador. Este método realiza toda la lógica de la vista \(utilizando los datos que ha enviado utilizando el método `setData()`\), coloca la vista dentro del mismo layout.

```php

public function edit()
{
    $data['tasks'] = $tasks->showAllTasks();
    
    //envia datos a la vista
    $this->setData($data);
    
    //Renderiza la vista
    $this->render("index");
}
    
```

El método render\(\) admite un segundo parámetro el cual es utilizado para establecer el título de la página;

```php

$this->render("index",'Index Page'); //Renderiza la vista con un titulo
    
```

Este habitualmente se coloca en la etiqueta `<title>` de `<html>` en el layout

```php

<title><?= $page_title ?></title>
    
```

Otras acciones que puede ejecutar este método es renderizar archivos de vistas de otros controladores o si tiene su proyecto por separado puedes cargar el `<head>`, `<body>` y `<footer>` por separado.

```php

$this->render('layout/head',null,true);
$this->render('layout/body',null,true);
$this->render('layout/footer',null,true);
    
```

Note que se ha especificado una ruta dentro del directorio `views` y el archivo que queremos cargar, pasamos el título de la página como `null` y un tercer parámetro como `true`, este último le indica a render que debe cargar un archivo de vista externo.

**Interactuar con los modelos**

Por convicción los modelos se añaden a los controladores en la cabecera de las clases controladoras utilizando la palabra reservada `use`;

```php
use Models\Tasks\Task;

class TasksController extends Controller
{
         //code...
}
```

Inmediatamente haga uso del modelo, podrá realizar instancias de la clase, si no se realiza esto y se instancia una clase no incluida en la cabecera, resultara en un error fatal que detendrá la ejecución de su programa. Note que el `use` es el `namespace` de su clase. Los modelos se utilizarán siempre que sea necesaria la extracción de datos de la base de datos.



### Recibiendo datos por medio de GET y POST

Las acciones pueden recibir parámetros tanto por `GET` como por `POST` y gracias al complemento `HttpFoundation` podremos realizar una gran cantidad de tareas con un menor esfuerzo;

#### GET

Tomaremos la acción \(metodo\) `edit` como ejemplo, supongamos que el usuario ingreso a la vista de edición de una tarea con el ID 3, una URL válida para esto sería la siguiente`http://localhost/taskapp/tasks/edit/3`

```php

public function edit($id)
{
    $task = new TaskModel();
    // Alguna logica
    $data = $task->getTask($id); //$id = 3
    //envia datos a la vista
    $this->setData($data);
    
    //Renderiza la vista
    $this->render("edit");
}

```

#### POST

Ahora suponemos que el usuario realizo las ediciones de la tarea y envió estos datos por medio de `POST`, es aquí donde entra en juego el componente `HttpFoundation`;

Supondremos que los datos fueron enviados a una acción \(método\) nombrado `updateTask` el cual procesara la solicitud del usuario.

```php
public function updateTask()
{
    $request = $this->easy_request();
    //Nos aseguramos que la petición realmente provenga por POST
    if($request->server->get('REQUEST_METHOD') == 'POST'){
        $task = new TaskModel();
        //Obteniendo los datos que provienen del metodo POST
        $data = [
            'task_id'=> $request->request->get('task_id'),
            'description' => $request->request->get('description')
        ];
        $task->update($data);
        //Algo de logica
    }
}
```



**Control de flujo**

El método de control de flujo que usarás más a menudo es `redirect()`. Este método toma su primer parámetro en forma de una URL relativa a Ligne. Cuando un usuario ha realizado un pedido con éxito, es posible que desee redirigir los a una pantalla de éxito.

```php

public function create()
{
    $task= new Task();
    $request = $this->easy_request();
    $title = $request->request->get('title');
    $description = $request->request->get('description');
    
    $task -> create( $title, $description);
    
    //Llevaremos el usuario hacia el index luego de creada la tarea
    $this -> redirect(array( 'controller'=>'tasks','action'=>'index' ) );
}
    
```

También se puede rediccionar pasando parámetros por la URL, por ejemplo:

```php

$this->redirect( array('controller'=>'tasks','action'=>'view'),$id );
    
```

Esto nos lleva a la siguiente `URL http://localhost/tasks/view/3`

El Segundo parámetro que `redirect()` admite es un parámetro para la `URL` enviada.

También puede usar una URL relativa o absoluta

```php

 $this->redirect ( '/ tasks / index' );
 $this->redirect ( 'http://www.github.com' );
```

