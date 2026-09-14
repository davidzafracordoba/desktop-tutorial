<?php
session_start();
include("conexion.php");

// Recogemos los datos que ingresas
$email = $_POST['email'];
$password = $_POST['password'];

// Hacemos una consulta para buscar el usuario
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$resultado = $conexion->query($sql);
//Aqui es donde comprueba si existe
if($resultado->num_rows > 0){

    $usuario = $resultado->fetch_assoc();

    // NO VERIFICADO
    if($usuario['verificado'] == 0){
        header("Location: login.php?error=verificar");
        exit();
    }

    //  Verifica la contraseña
    if(password_verify($password, $usuario['password'])){

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];

        header("Location: inicio.php");
        exit();
    //La contrasela es incorrecta
    } else {
        header("Location: login.php?error=password");
        exit();
    }

} else {
    header("Location: login.php?error=usuario");
    exit();
}
?>