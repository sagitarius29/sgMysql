<?php 
require_once('../src/sgMysql.php');
require_once('../src/usuarios.php');

$usuarios = new usuarios();
$usuarios->Where('id','=',1);
$usuarios->Select('nombre');

while ($obj = $usuarios->result->fetch_object()) {
	echo $obj->nombre."\n";
}
?>