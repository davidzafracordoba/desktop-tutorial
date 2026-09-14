<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

//  Consulta de mis libros
$sql_libros = "SELECT * FROM libros WHERE usuario_id = $usuario_id";
$resultado_libros = $conexion->query($sql_libros);

//  Consulta de mis conversaciones
$sql_mensajes = "
SELECT 
    u.id,
    u.nombre,
    MAX(m.fecha) as ultima_fecha,
    SUM(CASE 
        WHEN m.leido = 0 AND m.receptor_id = $usuario_id 
        THEN 1 
        ELSE 0 
    END) as no_leidos
FROM mensajes m
JOIN usuarios u ON (
    u.id = CASE 
        WHEN m.emisor_id = $usuario_id THEN m.receptor_id
        ELSE m.emisor_id
    END
)
WHERE m.emisor_id = $usuario_id OR m.receptor_id = $usuario_id
GROUP BY u.id
ORDER BY ultima_fecha DESC
";

$resultado_mensajes = $conexion->query($sql_mensajes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mi perfil</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/styles.css">
</head>

<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="logo-container">
        <img src="img/logo.png" class="logo-img">
        <span class="logo-text">Que leo hoy !</span>
    </div>

    <nav>
        <a href="inicio.php">Inicio</a>
        <a href="explorar.php">Explorar</a>

        <?php if(isset($_SESSION['usuario_id'])): ?>
            <a href="publicar.php">Publicar</a>
            <a href="usuario.php"><?php echo $_SESSION['nombre']; ?></a>
            <a href="logout.php">Salir</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>

<section class="hero">
    <h1>Mi perfil</h1>
    <p>Bienvenido <?php echo $_SESSION['nombre']; ?></p>
</section>

<main>

<!--  Muestra mensajes dinamicos y recorre resultados de MySQL -->
<?php if(isset($_GET['enviado'])): ?>
<p style="color:green; text-align:center; font-weight:bold;">
    Mensaje enviado correctamente
</p>
<?php endif; ?>

<?php if(isset($_GET['borrado'])): ?>
<p style="color:color:#9b796c; text-align:center; font-weight:bold;">
    Libro eliminado correctamente
</p>
<?php endif; ?>

<div class="container">

<!--  MIS LIBROS -->
<h2 style="margin-left:40px;">Mis libros</h2>

<?php if($resultado_libros->num_rows > 0): ?>
<div class="grid-libros">

<?php while($libro = $resultado_libros->fetch_assoc()): ?>

<div class="card">

<img src="<?php echo !empty($libro['imagen']) ? $libro['imagen'] : 'img/libro1.jpg'; ?>">

<h3><?php echo $libro['titulo']; ?></h3>
<p><?php echo $libro['categoria']; ?></p>
<p><?php echo $libro['ciudad']; ?></p>

<!--  Borrar libos -->
<form action="borrar_libro.php" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este libro?');">
    <input type="hidden" name="libro_id" value="<?php echo $libro['id']; ?>">
    
    <button 
        type="submit" 
        style="margin-top:10px; background:#583427; color:white; border:none; padding:8px 12px; border-radius:5px; cursor:pointer;">
        Borrar
    </button>
</form>

</div>

<?php endwhile; ?>

</div>

<?php else: ?>
<p style="margin-left:40px;">No tienes libros publicados.</p>
<?php endif; ?>

<!--  Muestra mis conversaciones -->
<h2 style="margin-top:60px;margin-left:40px;">Conversaciones</h2>

<?php if($resultado_mensajes->num_rows > 0): ?>

<?php while($conv = $resultado_mensajes->fetch_assoc()): ?>

<a href="chat.php?usuario=<?php echo $conv['id']; ?>" 
   style="text-decoration:none; color:inherit;">

<div style="background:white; padding:20px; margin-bottom:15px; border-radius:10px; box-shadow:0 3px 10px rgba(0,0,0,0.1);">

<p><strong><?php echo $conv['nombre']; ?></strong></p>

<?php if($conv['no_leidos'] > 0): ?>
    <p style="color:#7a4a39; font-weight:bold;">
        MENSAJES NO LEÍDOS
    </p>
<?php else: ?>
    <p style="color:#9b796c; font-weight:bold;">
        MENSAJES LEÍDOS
    </p>
<?php endif; ?>

<p style="font-size:12px; color:gray;">
    Último: <?php echo $conv['ultima_fecha']; ?>
</p>

</div>

</a>

<?php endwhile; ?>

<?php else: ?>
<p style="margin-left:40px;">No tienes conversaciones.</p>
<?php endif; ?>

</div>

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