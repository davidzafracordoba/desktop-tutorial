<?php
//Conexion con la base de datos 
$host = "mysql";
$usuario = "david";
$contrasena = "david123";
$base_datos = "queleo";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if($conexion->connect_error){
    die("Error de conexión: " . $conexion->connect_error);
}

?>