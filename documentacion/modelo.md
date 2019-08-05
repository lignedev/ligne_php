# 🛢️ Modelo

**Modelos**

Los modelos son las clases que forman la capa empresarial en su aplicación. Deben ser responsables de administrar casi todo lo relacionado con sus datos, su validez y sus interacciones.

Generalmente, las clases modelo representan datos y se usan en las aplicaciones de Ligne para el acceso a datos. Pueden usarse para acceder a cualquier cosa que manipule datos, como archivos, servicios web externos.

**Como funcionan los modelos**

Un modelo representa su modelo de datos. En la programación orientada a objetos, un modelo de datos es un objeto que representa una cosa como una persona o una casa. Un blog, por ejemplo, puede tener muchas publicaciones y cada publicación del blog puede tener muchos comentarios. El Blog, Publicación y Comentario son todos ejemplos de modelos, cada uno asociado con otro.

Aquí hay un ejemplo simple de una definición de modelo en Ligne:

```php
 namespace Models\Tasks;

  class Tasks extends Model
 {
    public function index()
    {
        //code...
    }
 }
    
```

Con solo esta simple declaración, el modelo **Tasks** está dotado de toda la funcionalidad que necesita para crear consultas y guardar y eliminar datos. Estos métodos provienen de la clase Modelo de Ligne por la magia de la herencia. Es esta clase **Model** central la que otorga la funcionalidad a su modelo de **Tasks**.

Para poder trabajar con el modelo **Tasks**, se crea el archivo PHP en el directorio `/Models/Tasks/`. Por convención, debería tener el mismo nombre que la clase, que para este ejemplo será `Tasks.php`

Esta clase debe contener un `namespace` ya que este se utiliza para incluir el modelo en donde sea necesario su uso. El `namespace` no es más que el directorio con barras invertidas donde esta el modelo, por ejemplo, en nuestro caso el modelo está en el directorio `/Models/Tasks/`.

**Recuperar datos Pdox**

El generador de consultas Pdox proporciona una interfaz fluida fácil de usar para crear y ejecutar consultas. Al componer las consultas juntas, puede crear consultas avanzadas utilizando uniones y subconsultas con facilidad.

Debajo de las capas, el generador de consultas utiliza declaraciones preparadas con PDO que protegen contra ataques de inyección SQL

**Ejemplo de selección un único registro**

Podemos obtener un registro con el método `get()` veamos un ejemplo de consulta por un criterio en concreto;

```php

public function showTask($id)
 {
    $req = $this->getBdd()->table('tasks')
        ->select('id, title, description, created_at,updated_at,success')
        ->where('id','=',$id)
        ->get();
    return $req;
 }
    
```

La sintaxis es sumamente sencilla, tenemos un método `getBdd()` el cual nos proporciona una conexión nueva a la base de datos, luego de esto es aquí donde entra la magia de Pdox \(Query Builder\) el mismo nos proporciona una serie de métodos que nos facilitaran la vida.

La salida de esta consulta seria;

```php

array (size=6)
    'id' => string '17' (length=2)
    'title' => string 'New task' (length=8)
    'description' => string 'yes!' (length=4)
    'created_at' => string '2018-10-10 22:54:30' (length=19)
    'updated_at' => string '2018-10-12 15:05:25' (length=19)
    'success' => string '0' (length=1)
    
```

**GetAll\(\)**

Así como realizamos consultas de registros individuales, podemos hacer consultas de un conglomerado de registros con el método `getAll()`. En este caso obtendremos todas las tareas que su valor **success** sea igual a **0** y ordenaremos estos registros por **created\_at** de manera descendente;

```php

public function showAllTasks()
 {
    $req = $this->getBdd()->table('tasks')
        ->select('id, title, description, created_at,updated_at,success')
        ->where('success','=',0)
        ->orderBy('created_at', 'desc')
        ->getAll();
    return $req;
 }
    
```

| Método | Descripción |
| :--- | :--- |
| table\(\) | Nombre de la tabla \(‘tasks’\) |
| select\(\) | Campos que queremos obtener \(‘campo1, campo2, campo3,….’\) |
| where\(\) | Criterio \(‘campo’,’operador’,’valor’\) |
| orderBy\(\) | Ordena los datos \(‘campo’,’orden’\) |
| getAll\(\); | Obtener todos los resultados |

Salida;

```php

array (size=2)
 0 =>
    array (size=6)
            'id' => string '17' (length=2)
            'title' => string 'New task' (length=8)
            'description' => string 'yes!' (length=4)
            'created_at' => string '2018-10-10 22:54:30' (length=19)
            'updated_at' => string '2018-10-12 15:05:25' (length=19)
            'success' => string '0' (length=1)
 1 =>
    array (size=6)
            'id' => string '15' (length=2)
            'title' => string 'new config' (length=13)
            'description' => string 'a new config, yeah!' (length=22)
            'created_at' => string '2018-10-10 20:32:37' (length=19)
            'updated_at' => string '2018-10-10 20:32:37' (length=19)
            'success' => string '0' (length=1)
    
```

**Insertando datos**

A diferencia de los ejemplos anteriores, no debe utilizar `get()` ni `getAll()` para crear consultas de inserción. En lugar de esto creamos un arreglo asociativo el cual puede ser como el ejemplo a continuación;

```php

 $data = [
    'title' => $title,
    'description' => $description,
    'created_at' => date('Y-m-d H:i:s')
 ];
    
```

Este arreglo es pasado al método `insert()` de la siguiente manera;

```php

 $data = [
    'title' => $title,
    'description' => $description,
    'created_at' => date('Y-m-d H:i:s')
 ];

 $this->getBdd()->table('tasks')->insert($data);
    
```

Puedes obtener el **id** insertado con una simple línea luego de realizada la inserción de datos;

```php

 $data = [
    'title' => $title,
    'description' => $description,
    'created_at' => date('Y-m-d H:i:s')
 ];

 $this->getBdd()->table('tasks')->insert($data);

 //Obteniendo el id insertado
 $last_insert_id = $this->getBdd()->insertId();
    
```

**Actualizando registros**

Como vimos en el ejemplo se inserción de datos en el caso de actualizar tampoco usaremos los métodos `get()` y `getAll()` en lugar de esto usaremos `update()`;

Crearemos un arreglo asociativo como en el ejemplo anterior, esta vez solo con los datos que se actualizarán, no es necesario enviar todos los campos;

```php

 $data = [
    'title' => $title,
    'description' => $description,
    'updated_at' => date('Y-m-d H:i:s')
 ];

 $this->getBdd()->table('tasks')->where('id','=', $id)->update($data);
    
```

En este caso como actualizaremos un registro por su **id** debemos usar el método `where()` seguido del método `update()`, a este ultimo le pasamos nuestro arreglo.

**Eliminar registros**

Es mas sencillo eliminar registros ya que en esta ocasión no necesitamos crear ningún arreglo, esto es tan sencillo como especificar con el método `where()` los criterios;

```php

$this->getBdd()->table('tasks')->where('id','=', $id)->delete();
    
```

**Consultas método Query**

También puedes realizar consultas SQL utilizando el método `query()`

```php

 //Select todos por criterio
 $this->getBdd()->query('SELECT * FROM test WHERE id=? AND status=?', [10, 1])->fetchAll();

 //Selecionar 1 registro
 $this->getBdd()->query('SELECT * FROM test WHERE id=? AND status=?', [10, 1])->fetch();

 //Puedes usar consultas como update, insert, select, etc...
 $this->getBdd()->query('DELETE FROM test WHERE id=?', [10])->exec();
    
```

Se recomienda utilizar los método del Query Builder en todos los casos ya que tienes una sintaxis más organizada y legible, inclusive escalable.

{% hint style="info" %}
#### Resumen

En general es mas sencillo que las consultas anteriores. En esta sección solo veremos consultas simples como las anteriores, para ampliar más puede visitar la documentación del Query Builder [Query Builder](https://itsalb3rt.github.io/ligne_php_framework_documentacion/query_builder.htm)
{% endhint %}

