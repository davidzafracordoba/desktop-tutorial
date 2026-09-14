<?php
session_start();
include("conexion.php");
//Comprobar si el usuario esta logeado
if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}
//Obtenemos el ID del usuario logeado
$usuario_id = $_SESSION['usuario_id'];
//Recibe los datos del formulario
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];

//  Saca la ciudad del usario
$sql_user = "SELECT ciudad FROM usuarios WHERE id = $usuario_id";
$result_user = $conexion->query($sql_user);
$user = $result_user->fetch_assoc();

$ciudad = $user['ciudad'];

// Sube la imagen
$imagen = "";

if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0){
    $nombre = time() . "_" . $_FILES['imagen']['name'];
    move_uploaded_file($_FILES['imagen']['tmp_name'], "img/" . $nombre);
    $imagen = "img/" . $nombre;
}

// Inserta los libros
$sql = "INSERT INTO libros (usuario_id, titulo, descripcion, categoria, ciudad, imagen)
VALUES ('$usuario_id', '$titulo', '$descripcion', '$categoria', '$ciudad', '$imagen')";

if($conexion->query($sql)){
    header("Location: usuario.php");
} else {
    echo "Error al publicar";
}
?>