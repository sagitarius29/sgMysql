<?php 
/**
* Clase de prueba de una tabla
*/
class usuarios extends sgMysql
{
	//Valores de Base de datos
	var $principal_table = __CLASS__;
	var $primary_key 	= 'id';
	var $engine = 'InnoDB';

	var $structure = array(
			'id'		=>	'INT NOT NULL AUTO_INCREMENT',
			'nombre'	=>	'VARCHAR(200) NULL'
			);
}
?>