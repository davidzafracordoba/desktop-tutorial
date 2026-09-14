<?php
session_start();
include("conexion.php");

if(!isset($_GET['id'])){
    echo "Libro no encontrado";
    exit();
}

$id = (int)$_GET['id'];

//Aqui es donde consultamos los libros
$sql = "SELECT libros.id AS libro_id, libros.*, usuarios.nombre AS usuario_nombre 
        FROM libros 
        JOIN usuarios ON libros.usuario_id = usuarios.id 
        WHERE libros.id = $id";

$resultado = $conexion->query($sql);

if($resultado->num_rows == 0){
    echo "Libro no encontrado";
    exit();
}

$libro = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title><?php echo htmlspecialchars($libro['titulo']); ?></title>
<link rel="stylesheet" href="css/styles.css">
</head>

<body>

<!-- El header -->
<header class="navbar">
    <div class="logo-container">
        <img src="img/logo.png" class="logo-img">
        <span class="logo-text">Que leo hoy</span>
    </div>
</header>

<!--  Banda marron -->
<section class="hero">
    <h1><?php echo htmlspecialchars($libro['titulo']); ?></h1>
</section>

<!--  Para volver atras -->
<div style="padding: 20px;">
    <button onclick="history.back()" 
            style="background:#7a4a2c; color:white; border:none; padding:10px 15px; border-radius:5px; cursor:pointer;">
        ← Volver
    </button>
</div>

<main>
<div class="container">

<div class="detalle-wrapper">
<div class="detalle-libro">

<img src="<?php echo !empty($libro['imagen']) ? $libro['imagen'] : 'img/libro1.jpg'; ?>" class="detalle-img">

<div class="detalle-info">

<h2><?php echo htmlspecialchars($libro['titulo']); ?></h2>

<p><strong>Categoría:</strong> <?php echo htmlspecialchars($libro['categoria']); ?></p>
<p><strong>Ciudad:</strong> <?php echo htmlspecialchars($libro['ciudad']); ?></p>

<p><?php echo htmlspecialchars($libro['descripcion']); ?></p>

<hr>

<p><strong>Propietario:</strong> <?php echo htmlspecialchars($libro['usuario_nombre']); ?></p>

<!--  Contro de envio de mensajes -->
<?php if(isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] != $libro['usuario_id']): ?>

<form action="enviar_mensaje.php" method="POST" class="mensaje-form">

<input type="hidden" name="libro_id" value="<?php echo $libro['libro_id']; ?>">
<input type="hidden" name="receptor_id" value="<?php echo $libro['usuario_id']; ?>">

<textarea 
    name="mensaje" 
    placeholder="Escribe un mensaje al propietario..."
    required
></textarea>

<button type="submit" class="btn-mensaje">
    Enviar mensaje
</button>

</form>

<?php endif; ?>

</div>
</div>
</div>

</div>
</main>

</body>
</html>