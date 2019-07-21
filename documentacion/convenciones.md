# 📢 Convenciones

**Convenciones de Ligne**

Si bien toma un poco de tiempo aprender las convenciones de Ligne, a la larga se ahorra tiempo. Al seguir las convenciones, obtiene funcionalidad gratuita y se libera de la pesadilla de mantenimiento de los archivos de configuración. Las convenciones también hacen que la experiencia de desarrollo sea muy uniforme, permitiendo a otros desarrolladores participar y ayudar.

**Convenciones del controlador**

Los nombres de clase del controlador son plural y en UpperCamelCase y terminan en `Controller`. `TasksController` `UsersController` ambos son ejemplos de nombres de controladores convencionales.

Los métodos públicos en los Controladores a menudo se exponen como 'acciones' accesibles a través de un navegador web. Por ejemplo, [`http://example.com/app/tasks/create/`](http://example.com/app/tasks/create/)donde **tasks** es el controlador y **create** es la acción.

**Consideraciones de URL para nombres de controladores**

Como acaba de ver, los controladores de una sola palabra se asignan a una ruta URL simple en minúsculas. Por ejemplo, se accede desde `UsersController` \(que se definiría en el nombre de archivo `UsersController.php` \)

**`http://example.com/users`**

![](../.gitbook/assets/image.png)

**Convenciones de archivos y nombres de clases**

En general, los nombres de archivo coinciden con los nombres de clase y siguen el estándar PSR-4 para la carga automática. Los siguientes son algunos ejemplos de nombres de clase y sus nombres de archivo:

* La clase del controlador `TasksController` encontraría en un archivo llamado `TasksController.php`
* Las vistas deben estar en un sub directorio de **Views** con el nombre de la clase y con extensión .php. Las vistas de la clase **Tasks** están en `/Views/Tasks/` ****y un ejemplo de un nombre de vista valido seria `/Views/Tasks/create.php` el nombre de esta hace referencia a la acción.
* Debe haber solo 1 clase por archivo, no se permiten 2 clases por archivo, esto causara errores de carga de clases.

**Convenciones de base de datos**

Los nombres de las tablas correspondientes a los modelos de Ligne son plurales y están subrayados. Por ejemplo, **Tasks**, **create\_at** y **update\_at\_date** respectivamente.

Los nombres de campo / columna con dos o más palabras están subrayadas: **first\_second**.

Además de usar un entero de incremento automático como claves primarias.

{% hint style="info" %}
**Resumen**

Al usar estas convenciones, Ligne sabe que una solicitud para;

`http://example.com/tasks/index`

Está realizando una llamada al método `index()` de **TasksController**, donde el modelo de Tasks está disponible automáticamente \(y automáticamente vinculada a la tabla de "Tasks" en la base de datos\), y se procesa en un archivo. Ninguna de estas relaciones se ha configurado por ningún otro medio que no sea la creación de clases y archivos que necesitaría crear de todos modos.

Los archivos que contienen clases deben llamarse tal cual se llama la clase que contiene.
{% endhint %}

