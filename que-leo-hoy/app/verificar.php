<?php
include("conexion.php");

$mensaje = "";
$tipo = "";
//Recibe el token y lo comprueba
if(isset($_GET['token'])){
    $token = $_GET['token'];

    $sql = "SELECT * FROM usuarios WHERE token='$token'";
    $resultado = $conexion->query($sql);

    if($resultado->num_rows > 0){

        $sql_update = "UPDATE usuarios SET verificado=1, token=NULL WHERE token='$token'";
        $conexion->query($sql_update);

        $mensaje = "Cuenta verificada correctamente ";
        $tipo = "ok";

    } else {
        $mensaje = "Token inválido ";
        $tipo = "error";
    }

} else {
    $mensaje = "No hay token ";
    $tipo = "error";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Verificación</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/styles.css">

</head>

<body>

<header class="navbar">
    <div class="logo-container">
        <img src="img/logo.png" class="logo-img">
        <span class="logo-text">Que leo hoy !</span>
    </div>

    <nav>
        <a href="inicio.php">Inicio</a>
        <a href="explorar.php">Explorar</a>
        <a href="login.php">Login</a>
    </nav>
</header>

<!-- HERO -->
<section class="hero">
    <h1>Verificación de cuenta</h1>
    <p>Resultado del proceso</p>
</section>

<main>
<!-- mUESTRA UN MENSAJE DINAMICO -->
<section class="perfil-section" style="text-align:center;">

    <h2><?php echo $mensaje; ?></h2>

    <br>

    <?php if($tipo == "ok"): ?>
        <a href="login.php">
            <button style="padding:12px 20px; background:#583427; color:white; border:none; border-radius:8px; cursor:pointer;">
                Iniciar sesión
            </button>
        </a>
    <?php else: ?>
        <a href="inicio.php">
            <button style="padding:12px 20px; background:#583427; color:white; border:none; border-radius:8px; cursor:pointer;">
                Volver al inicio
            </button>
        </a>
    <?php endif; ?>

</section>

</main>

<footer class="footer">
    <div class="footer-container">

        <div class="footer-section">
            <h3>Que leo hoy</h3>
            <p>Plataforma para intercambiar libros entre lectores.</p>
        </div>

        <div class="footer-section">
            <h4>Enlaces</h4>
            <a href="inicio.php">Inicio</a>
            <a href="explorar.php">Explorar</a>
        </div>

        <div class="footer-section">
            <h4>Contacto</h4>
            <p>Email: que.leo.hoyy@gmail.com</p>
        </div>

    </div>

    <div class="footer-bottom">
        © 2026 Que leo hoy
    </div>
</footer>

</body>
</html>