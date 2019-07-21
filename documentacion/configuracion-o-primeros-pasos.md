# ⚙️ Configuración o primeros pasos

**Configuración básica**

Ligne requiere una configuración mínima para su funcionamiento, usted solo debe indicarle en que base de datos, con que usuario y contraseña e inmediatamente podrá comenzar con el desarrollo de la app, fácil, ¿no?

**Configuración de la base de datos**

E**l** archivo `/config/config.php.ini` es donde tiene lugar la configuración de su base de datos. Este archivo viene por defecto, con unos datos que usted debe cambiar dependiendo de su necesidad. Cuando el archivo es abierto vera lo siguiente:

```php
<!--?php return; ?-->
host=localhost
user=root
pass="1234"
dbname=taskapp
driver=mysql
charset=utf8
collation=utf8_general_ci
prefix=""
```

Reemplace la información provista por defecto con la información de conexión de base de datos para su aplicación.

Ligne soporta los siguientes controladores de base de datos:



| **Nombre del controlador** | **Bases de datos admitidas** |
| :--- | :--- |
| MYSQL | MySQL 3.x/4.x/5.x/8.x |
| PGSQL | PostgreSQL |
| SQLITE | SQLite 3 and SQLite 2 |
| Oracle | Oracle |

