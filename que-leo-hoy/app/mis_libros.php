<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM libros WHERE usuario_id = $usuario_id ORDER BY fecha_publicacion DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mis libros - Que leo hoy</title>

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
        <a href="publicar.php">Publicar</a>
        <a href="usuario.php"><?php echo $_SESSION['nombre']; ?></a>
        <a href="logout.php">Salir</a>
    </nav>
</header>

<section class="hero">
    <h1>Mis libros</h1>
    <p>Aquí puedes ver todos tus libros publicados</p>
</section>

<main>

<section class="perfil-section">

<div class="grid-libros">

<?php if($resultado->num_rows > 0): ?>

<?php while($libro = $resultado->fetch_assoc()): ?>

<div class="card">

    <?php if(!empty($libro['imagen'])): ?>
        <img src="<?php echo $libro['imagen']; ?>">
    <?php else: ?>
        <img src="img/libro1.jpg">
    <?php endif; ?>

    <h3><?php echo $libro['titulo']; ?></h3>
    <p><?php echo $libro['categoria']; ?></p>
    <p><?php echo $libro['ciudad']; ?></p>

</div>

<?php endwhile; ?>

<?php else: ?>
    <p>No has publicado ningún libro todavía.</p>
<?php endif; ?>

</div>

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
            <p>Proyecto ASIR</p>
        </div>

    </div>

    <div class="footer-bottom">
        © 2026 Que leo hoy | Proyecto ASIR
    </div>
</footer>

</body>
</html>