<?php 
//Ejemplo Para Guardar
$usuario = new usuario();
$usuario->nombre = 'Adolfo';
$usuario->apellido = 'Cuadros';
$usuario->Save(); //Guardar
?>

<?php
//Update
$usuario = new usuario();
$usuario->nombre = 'Nuevo Nombre';
$usuario->Where('id','=',1);
$usuario->Update(); // 
?>

<?php
//eliminar
$usuario = new usuario();
$usuario->id = 3;
$usuario->Delete(); // Eliminar
?>