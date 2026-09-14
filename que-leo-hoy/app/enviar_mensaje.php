<?php
session_start();
include("conexion.php");
//comprueba si el usuario esta autentificado
if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}
//Obtiene datos del mensaje
$emisor = $_SESSION['usuario_id'];
$receptor = $_POST['receptor_id'];
$libro_id = $_POST['libro_id'];
$mensaje = trim($_POST['mensaje']);

if($mensaje == ""){
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// INSERTAR MENSAJE
$sql = "INSERT INTO mensajes (emisor_id, receptor_id, libro_id, mensaje, leido)
VALUES ('$emisor', '$receptor', '$libro_id', '$mensaje', 0)";

if($conexion->query($sql)){
    // VOLVER A LA PÁGINA ANTERIOR
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Error al enviar mensaje";
}
?>