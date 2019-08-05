---
description: '(Contenido, css, javascript, imagenes, etc)'
---

# 🗄️ Assets



**Web Assets**

Los recursos web son cosas como CSS, JavaScript, fuentes y archivos de imagen que hacen que la interfaz de su sitio se vea y funcione muy bien. Estos deben ser guardados en el directorio `webassets`

```php

//CSS
<link href="<?= Assets::setAssets('css/bootstrap.min.css') ?>" rel="stylesheet">

//JavaScript
<script src="<?= Assets::setAssets('js/jquery.min.js')?>"></script>
                        
```

Dentro del directorio `webassets` debe existir una carpeta para cada tipo de archivo externo, por ejemplo;

```text

    Webassets
        ├───── css
        ├───── fonts
        ├───── img
        ├───── js

```

Note que para agregar en nuestro ejemplo a cada `Assets` se le ha pasado a la función **setAssets** como prefijo **CSS** y **JS** respectivamente, esto quiere decir que buscara ese recurso dentro de esa carpeta.

{% hint style="info" %}
NOTA: Si por alguna razón el **Asset** que ha indicado no se encuentra disponible es el navegador web quien le dirá que este no se encuentra disponible.
{% endhint %}

La función `SetAssests()` recibe un segundo parámetro opcional para el control de la cache del navegador, ese parámetro es de tipo booleano;

```php

//JavaScript
<script src="<?= Assets::setAssets('js/jquery.min.js', false)?>"></script>
                        
```

Esto ayuda en el entorno de desarrollo a interactuar siempre con la última versión del Assets.

**Enlaces relativos**

Las URL relativas son sumamente importante y para ellas existe un método llamado `href()` de la clase `Assets` el uso de este método es similar a lo que vimos anteriormente.

El método `href()` recibe 2 parámetros, el 1ro es la el **controlador** y la **acción** que queremos llamar y el 2do es opcional, es el parámetro que queramos enviar por la url a la **acción** del **controlador** `foo/bar/1`.

Veamos un ejemplo sencillo. En nuestras vistas a la hora de generar un elemento **&lt;a&gt;** \(hipervínculo\) en su atributo **href** llamaremos el metodo `href()`

```php

 <a href="<?= Assets::href( 'tasks/index')?>"> All Task's </a>
                        
```

Con esto obtendremos una url valida dentro de nuestro proyecto.

Si queremos pasar un parámetro junto a nuestra url lo podemos realizar de la siguiente manera;

```php

<a href="<?= Assets::href( 'tasks/edit',$task['id']) ?>"> Edit </a>
    
```

Note en este ejemplo que se ha pasado **id** a la acción **edit** del controlador **tasks.**

**Algunas observaciones sobre `href()`:**

* Las urls no deben contener slash\(/\) delante.
  * **`foo/bar/1` \(Bien\)**
  * **`/foo/bar/1`** **\(MAL\)**
* Siempre debe ser pasado como primer parámetro el par controlador/acción de lo contrario recibirá una URL no valida.
* Se puede omitir el uso de este método y utilizar URL estáticas, pero esto incluye consigo algunos problemas
  * Si cambia el nombre de su directorio **root** tendrá que cambiar manualmente los enlaces previos que haya creado.
  * No tendrá control sobre los enlaces y dejaran de ser relativos
  * Se disparará muchas veces en el pie

