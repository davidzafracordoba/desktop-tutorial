<?php
session_start();

//  proteger la página (solo usuarios logueados)
if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Publicar libro - Que leo hoy</title>

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

        <?php if(isset($_SESSION['usuario_id'])): ?>
            <a href="publicar.php">Publicar</a>
            <a href="usuario.php"><?php echo $_SESSION['nombre']; ?></a>
            <a href="logout.php">Salir</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>

    </nav>

</header>

<!-- HERO -->
<section class="hero">
    <h1>Publica tu libro</h1>
    <p>Comparte tus libros y dales una nueva vida</p>
</section>

<main>

<section class="publicar-section">

    <div class="publicar-box">

        <h2>Añadir libro</h2>

        <!--  Formulario  -->
          <!--  conectamos el formulario con procesar_publicar  -->
        <form class="form-publicar" action="procesar_publicar.php" method="POST" enctype="multipart/form-data">

            <input type="text" name="titulo" placeholder="Título del libro" required>

            <textarea name="descripcion" placeholder="Descripción del libro..." rows="4" required></textarea>

            <select name="categoria" required>
                <option value="">Categoría</option>
                <option>Novela</option>
                <option>Ciencia ficción</option>
                <option>Historia</option>
                <option>Fantasía</option>
                <option>Misterio</option>
                <option>Ensayo</option>
                <option>Filosofia</option>
                <option>Romance</option>
                <option>Poesia</option>

            </select>

            <input type="file" name="imagen" accept="image/*">

            <button type="submit">Publicar libro</button>

        </form>

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
            <a href="login.php">Login</a>
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