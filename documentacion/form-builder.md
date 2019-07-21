# 📃 Form Builder



**Constructor de formularios**

Ligne viene con una pequeña clase llamada **PhpFormBuilder** que facilita la creación y salida de formularios como HTML o XHTML. Los formularios son tediosos y pueden ser difíciles de construir. Además, hay tantas opciones diferentes posibles que es fácil olvidar lo que puedes hacer con ellas.

Esta clase proporciona ventajas como;

* Poder reutilizar los formularios y mantener sus vistas limpias
* Obtiene formularios con unas pocas líneas
* Dispone de las validaciones habituales de HTML5
* Es difícil dispararse en el pie

**Usos Básicos**

Veamos un sencillo ejemplo de un formulario de inicio de sesión bastante básico y posteriormente explicaremos a fondo la funcionalidad de este poderoso constructor de formularios;

Lo primero que debemos hacer es utilizar la clase **PhpFormBuilder** en la cabecera de nuestra clase

```php
 use FormBuilder\PhpFormBuilder;

 class LoginController extends Controller
 {

  //...

 }   
```

Una vez tenemos la clase incluida en nuestra cabecera comenzamos;

```php
 $login_form = new PhpFormBuilder();
 //Atributos del formulario
 $login_form->set_att('action', '/loginCheck');
 $login_form->set_att('method', 'post');
 $login_form->set_att('enctype', 'multipart / form-data');

 //Agregando campo user name
 $login_form->add_input('User',
    array('placeholder' => 'User name',
          'required' => 'true'),
    'user_name');

 //Agregando campo password
 $login_form->add_input('Password',
    array('type' => 'password',
          'placeholder' => '*****',
          'required' => 'true',),
    'password');

 //Agregando checkbox para recordar credenciales
 $login_form->add_input('Remember me', array('type' => 'checkbox'), 'Remember_me');

 //Agregando el boton submit
 $login_form->add_input('Login',
    array('type' => 'submit',
          'value' => 'Login'),
    'login');

 //Enviardo datos a la vista
 $data['form_login'] = $login_form->build_form();
 $this->setData($data);
 $this->render('login');
```

Ahora nuestra vista poseerá un formulario como este;

![](https://itsalb3rt.github.io/ligne_php_framework_documentacion/Constructor%20de%20formularios_archivos/image001.jpg)

Este es un formulario sumamente sencillo de crear y elaborar gracias a constructor de formularios. Ahora veamos paso por paso cada función de lo que acabamos de ver:

**1\) instanciar la clase**

Esto es bastante simple:

```php
$login_form = new PhpFormBuilder();   
```

Esto utiliza todas las configuraciones predeterminadas para el formulario, que son las siguientes:

* action: empty, submit to current URL
* method: post
* enctype: application/x-www-form-urlencoded
* class: none
* id: none
* markup: html
* novalidate: false
* add\_nonce: false
* add\_honeypot: true
* form\_element: true
* add\_submit: true

Las explicaciones para cada uno de los ajustes serán explicadas en las siguientes páginas.

También puede crear una instancia pasando una URL, que se convierte en la acción del formulario:

```php
$login_form = new PhpFormBuilder('http://example.com/loginCheck');   
```

**2\) Cambie cualquier atributo del formulario, si lo desea**

```php
// Agregar un nuevo formulario action
$new_form->set_att('action', 'http://submit-here.com');

// Cambiar el método de envío
$new_form->set_att('method', 'get');

// Cambiar el enctype
$new_form->set_att('enctype', 'multipart/form-data');

// Se puede establecer en 'html' o 'xhtml'
$new_form->set_att('markup', 'xhtml');

// Las clases se agregan como una matriz
$new_form->set_att('class', array('class1', 'class2'));

// Agregar un id al formulario

$new_form->set_att('id', 'xhtml');

// Agrega el atributo HTML5 "novalidate"

$new_form->set_att('novalidate', true);

// Agrega un campo de WordPress nonce usando la cadena que se pasa

$new_form->set_att('add_nonce', 'build_a_nonce_using_this');

// Agrega un campo de texto oculto en blanco para el control de spam

$new_form->set_att('add_honeypot', true);

// Envuelve las entradas con un elemento de formulario

$new_form->set_att('form_element', true);

// Si no se agrega ningún tipo de envío, agregue uno automáticamente

$new_form->set_att('form_element', true);
```

Actualmente, existen algunas restricciones de los atributos \(de los que vimos\) que se pueden agregar, ni tampoco se comprueba si las clases o los identificadores son válidos, así que tenlo en cuenta/consideración.

**3\) Añade inputs a tu formulario**

Los inputs o entradas se pueden agregar una a la vez o como un grupo. De cualquier manera, el orden en que se agregan es el orden en el que aparecerán.

El método para esto es `add_input()` este método recibe 3 parámetros;

* **Argumento 1 Label:** Una etiqueta legible para el ser humano, que se analiza y se convierte en el nombre y la identificación **cuando esta opción** no está establecida explícitamente. Si usa una etiqueta simple como "correo electrónico" aquí, asegúrese de establecer un nombre más específico en el argumento 3.
* **Argumento 2 Opciones:** Una matriz de configuraciones que se combinan con las configuraciones predeterminadas para controlar la visualización y el tipo de campo. Se exploran las opciones mas adelante.
* **Argumento 3 Slug**: una cadena, válida para un atributo HTML, esta se utilizará para el atributo **name** e **id**. Esto le permite establecer nombres de envío específicos difieren de la etiqueta del campo.

Agregue campos usando su etiqueta \(en forma legible por humanos\), una variedad de configuraciones y un nombre / id slug, si es necesario.

**Opciones**

**name**

* El valor predeterminado es el argumento 3, si está configurado, o el texto de la etiqueta formateada
* Esto se convierte en el atributo "name" en el campo

**id**

* El valor predeterminado es el argumento 3, si está configurado, o el texto de la etiqueta formateada
* Esto se convierte en el atributo "id" en el campo y el atributo "for" en la etiqueta

**label**

* El valor predeterminado es el argumento 1, se puede establecer explícita mente utilizando este argumento

**value**

* El valor predeterminado es vacío
* Si se encuentra un índice `$ _REQUEST` con el mismo nombre, el valor se reemplaza con ese valor encontrado

**placeholder**

* El valor predeterminado es vacío
* Atributo HTML5 para mostrar texto de ejemplo dentro de los inputs.

**class**

* El valor predeterminado es una matriz vacía
* Agregue varias clases usando una matriz de nombres de clase válidos

**options**

* El valor predeterminado es una matriz vacía
* La matriz de opciones se utiliza para campos de tipo "select", "checkbox" y "radio". Para otras entradas, este argumento se ignora.
* La matriz debe ser una matriz asociativa con el valor como la clave y el nombre de la etiqueta como el valor como array\('value' =&gt; 'Name to show'\)
* El nombre de la etiqueta para el campo se usa como encabezado para las múltiples opciones \(establezca "add\_label" en "false" para suprimir\)

**min**

* El valor predeterminado es vacío
* Utilizado para los tipos "range" y "número"

**max**

* El valor predeterminado es vacío
* Utilizado para los tipos "range" y "número"

**step**

* El valor predeterminado es vacío
* Utilizado para los tipos "range" y "número"

**autofocus**

* El valor predeterminado es "falso"
* Un valor "true" simplemente agrega el atributo HTML5 "autofocus"

**checked**

* El valor predeterminado es "falso"
* Un valor "true" simplemente agrega el atributo "checked"

**required**

* El valor predeterminado es "falso"
* Un valor "true" simplemente agrega el atributo "required" de HTML5

**add\_label**

* El valor predeterminado es "true"
* Un valor "falso" suprimirá la etiqueta para este campo

**wrap\_tag**

* El valor predeterminado es "div"
* Un nombre de etiqueta HTML válido para la envoltura de inputs.
* Establezca esto en una cadena vacía para no usar una envoltura para el campo

**wrap\_class**

* El valor predeterminado es una matriz con "form\_field\_wrap" como único valor
* Las clases deben agregarse como una matriz de nombres de clase HTML válidos
* Las envolturas de los inputs tendrán esta clase

**wrap\_id**

* El valor predeterminado es vacío
* Agrega una identificación a este campo pasando una cadena

**wrap\_style**

* El valor predeterminado es vacío
* Esta cadena de texto se agregará dentro de un atributo de estilo

**4\) Obtener el formulario**

Una declaración rápida produce el formulario como HTML:

```php
$data['form_login'] = $login_form->build_form();
```

