# ⌛ Time Difference

**Diferencia de tiempo entre fechas**

Como parte del utilitario de Ligne existe la clase llamada **TimeDiff** para realizar cálculos de diferencia de tiempo entre fechas;

```php
//Hacemos uso de la clase
use TimeDifference\TimeDiff;

//Creamos una instancia de la clase
$new_time = new TimeDiff('2018-10-12','2018-10-15');

//Obtenemos su resultados y lo mostramos por pantalla
var_dump($new_time->timeDiff());    
```

Esto retorna un arreglo asociativo como el siguiente;

```php
 array (size=5)
  'total_days' =>
    array (size=2)
      0 => string '12' (length=2)
      1 => string '15' (length=2)
  'first_day_time' => int 61200
  'last_day_time' => int 61200
  'timeDiff' => int 122400
  'total_time' => int 0    
```

`total_days` Es el total de los días que pasaron entre las 2 fechas.

`First_day_time` Es el total de segundos que existe en el primer día.

`last_day_time` Es el total de segundos que existe en el último día.

`timeDiff` Es el total de tiempo en segundos que existe entre las 2 fechas.

**Consideraciones**

Hay algunas cosas a considerar en este ejemplo y es que a la hora de instanciar la clase se deben especificar algunos datos como parámetro;

`$start_date`Fecha inicial.

`$end_date`Fecha Final.

`$start_work_hour` Hora de inicio de la jornada, por defecto es 8:00:00.

`$end_work_hour` Hora de fin de jornada, por defecto es 17:00:00.

Estos 2 parámetros se refieren en caso de que se deban de tomar en consideración horas no hábiles dentro de la diferencia de tiempo, si se quiere tener la diferencia neta estos dos valores deben ser especificados de la siguiente manera 00:00:00 y 23:59:59 respectivamente.

`$hours_per_day` cantidad de horas por día.

En caso que las fechas superen los 2 días y se pretenda obtener tiempo hábil, por ejemplo, en una jornada laboral de 8:00:00 a 17:00:00 las horas hábiles son 8, se dio el rango de 2018-10-15 a 2018-10-18 el resultado es;

```php
 $new_time = new TimeDiff('2018-10-15','2018-10-18','08:00:00','17:00:00',8);    
```

```php
 array (size=5)
  'total_days' =>
    array (size=4)
      0 => string '15' (length=2)
      1 => string '16' (length=2)
      2 => string '17' (length=2)
      3 => string '18' (length=2)
  'first_day_time' => int 61200
  'last_day_time' => int 61200
  'timeDiff' => int 180000
  'total_time' => int 57600
```

Tenemos que han pasado 4 días entre estas fechas y un tiempo total transcurrido entre ellas.

**Días de semana hábiles**

Otra facilidad que tiene esta clase es que le puedes especificar cuáles son los días hábiles en la semana, por ejemplo, de lunes a viernes. Esto es gracias a un array que recibe 2 posiciones;

`$work_days = array(dia_inicio,dia_final);`

Por defecto estos están establecidos en 1 y 5 respectivamente y significa que el lunes \(1\) es el primer día hábil y viernes \(5\) es el último día hábil por lo que restan el 6\(sábado\) y 7\(domingo\).

```php
$new_time = new TimeDiff(
    '2018-10-15',
    '2018-10-18',
    '08:00:00',
    '17:00:00',
    8,
    array(1,5)
);
```

Por último, También recibe un arreglo como parámetro para los días festivos.

