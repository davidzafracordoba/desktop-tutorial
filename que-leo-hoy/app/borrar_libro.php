<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['libro_id'])){

    $libro_id = (int)$_POST['libro_id'];
    $usuario_id = $_SESSION['usuario_id'];

    $sql = "DELETE FROM libros WHERE id = $libro_id AND usuario_id = $usuario_id"; //Borra el libro en concreto

    if($conexion->query($sql)){
        header("Location: usuario.php?borrado=1");
        exit();
    } else {
        echo "Error al borrar";
    }
}
?>