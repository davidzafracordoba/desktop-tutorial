<?php
session_start();
include("conexion.php");
//Usamos la libreria que hemos descargado y adjuntado
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

$mensaje = "";
$tipo = "";

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];
$ciudad = $_POST['ciudad'];
$pais = $_POST['pais'];

$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Generar token
$token = bin2hex(random_bytes(32));

$sql = "INSERT INTO usuarios (nombre, email, password, ciudad, pais, token, verificado)
VALUES ('$nombre', '$email', '$password_hash', '$ciudad', '$pais', '$token', 0)";
//Este bloque lo que hace es enviar un correo de verificacion al usuario
if($conexion->query($sql)){

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'que.leo.hoyy@gmail.com';
        $mail->Password = 'bspsbgzpvrsbkbox';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('que.leo.hoyy@gmail.com', 'Que leo hoy');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Verifica tu cuenta';

        $link = "http://localhost/que-leo-hoy/verificar.php?token=$token";

        $mail->Body = "
            <h2>Verifica tu cuenta</h2>
            <p>Haz clic en el siguiente enlace:</p>
            <a href='$link'>Verificar cuenta</a>
        ";

        $mail->send();

        $mensaje = "Revisa tu correo para verificar tu cuenta 📩";
        $tipo = "ok";

    } catch (Exception $e) {
        $mensaje = "Error al enviar correo ❌";
        $tipo = "error";
    }

} else {
    $mensaje = "Error al registrarse ❌";
    $tipo = "error";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>

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

<section class="hero">
    <h1>Registro</h1>
    <p>Resultado del proceso</p>
</section>

<main>
<section class="perfil-section" style="text-align:center;">

    <h2><?php echo $mensaje; ?></h2>

    <br>

    <?php if($tipo == "ok"): ?>
        <a href="login.php">
            <button style="padding:12px 20px; background:#583427; color:white; border:none; border-radius:8px;">
                Ir al login
            </button>
        </a>
    <?php else: ?>
        <a href="inicio.php">
            <button style="padding:12px 20px; background:#583427; color:white; border:none; border-radius:8px;">
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