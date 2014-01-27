sgMysql
=======

Descripcion
======
Esta es una clase para trabajar Mysql como Objeto

Uso Basico
===========
Todas las tablas deberán tener un archivo indicando su estructura, para este ejemplo tendremos la tabla "usuarios" de la siguiente manera

* Cabe resaltar que la clase tiene que tener el nombre de la tabla.

usuario.php

```php
class usuario extends sgMysql
{
	
	var $principal_table = __CLASS__; //no cambiar
	var $primary_key 	= 'id'; // Indicamos la llave primaria
	var $engine = 'InnoDB'; // Indicamos el tipo de motor

	//Aqui la estructura de la tabla
	var $structure = array(
			'id'		=>	'INT NOT NULL AUTO_INCREMENT',
			'nombre'	=>	'VARCHAR(200) NULL',
			'apellidos'	=>	'VARCHAR(200) NULL'
			);
}
```

CONSUTAS MYSQL
=========
Guardar Datos
```php
require_once('sgMysql.php');
require_once('usuario.php');

$usuario = new usuario();
$usuario->nombre = 'Adolfo';
$usuario->apellidos = 'Cuadros';
$usuario->Save();
```

Seleccionar
```php
require_once('sgMysql.php');
require_once('usuario.php');

$usuario = new usuario();
$usuario->Where('id','=',2);
$usuario->Select('nombre', 'apellido');
while ($obj = $usuarios->result->fetch_object()) {
	echo 'Nombre y apellidos: '.$obj->nombre.' '.$obj->apellidos;
}
```

Modificar Datos
```php
require_once('sgMysql.php');
require_once('usuario.php');

$usuario = new usuario();
$usuario->nombre = 'Nuevo Nombre';
$usuario->Where('id','=',1);
$usuario->Update();
```

Eliminar Datos
```php
require_once('sgMysql.php');
require_once('usuario.php');

$usuario = new usuario();
$usuario->id = 3;
$usuario->Delete();
```

Para crear la tabla basta con hacer
```php
require_once('sgMysql.php');
require_once('usuario.php');

$usuario = new usuario();
$usuario->CreateTable();
```