sgMysql
=======

Descripcion
======
Esta es una clase para trabajar Mysql como Objeto

Uso Basico
===========

usuario.php

```php
class usuario
{
	
	var $principal_table = __CLASS__;
	var $primary_key 	= 'id';
	var $engine = 'InnoDB';

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
$usuario = new usuario();
$usuario->nombre = 'Adolfo';
$usuario->apellidos = 'Cuadros';
$usuario->Save();
```

Seleccionar
```php
$usuario = new usuario();
$usuario->Where('id','=',2);
$usuario->Select('nombre', 'apellido');
while ($obj = $usuarios->result->fetch_object()) {
	echo 'Nombre y apellidos: '.$obj->nombre.' '.$obj->apellidos;
}
```

Modificar Datos
```php
$usuario = new usuario();
$usuario->nombre = 'Nuevo Nombre';
$usuario->Where('id','=',1);
$usuario->Update();
```

Eliminar Datos
```php
$usuario = new usuario();
$usuario->id = 3;
$usuario->Delete();
```

