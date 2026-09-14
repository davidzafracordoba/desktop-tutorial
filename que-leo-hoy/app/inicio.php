<?php
session_start();
include("conexion.php");

//Esto es una consulta de los ultimos 10 libros
$sql_novedades = "SELECT * FROM libros ORDER BY fecha_publicacion DESC LIMIT 10";
$res_novedades = $conexion->query($sql_novedades);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Inicio - Que leo hoy</title>

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

<main>

<!-- Banda marron -->
<section class="hero">
    <h1>Sobre nosotros</h1>
    <p>Conectando lectores y dando una segunda vida a los libros</p>
</section>

<!-- Texto en el que esxplicamos quienes somos -->
<section class="about">
    <h2>¿Quiénes somos?</h2>
    <p>
Somos una plataforma dedicada al intercambio de libros entre lectores, creada con la idea de hacer la lectura más accesible para todos. Creemos firmemente que los libros no deberían quedarse olvidados en una estantería, sino que deberían seguir viajando de mano en mano, compartiendo historias, conocimientos y emociones.
Nuestro objetivo es fomentar la lectura y, al mismo tiempo, ayudar a las personas a ahorrar dinero. A través de nuestra web, cualquier usuario puede ofrecer libros que ya ha leído y descubrir otros nuevos sin necesidad de comprarlos, promoviendo así un consumo más responsable y sostenible.
Además, buscamos crear una comunidad de lectores donde compartir intereses, recomendaciones y experiencias. No se trata solo de intercambiar libros, sino de conectar personas que disfrutan leyendo y dar una segunda vida a cada ejemplar.
En “Que leo hoy” apostamos por una forma más inteligente, económica y ecológica de disfrutar de la lectura.
    </p>
</section>

<!-- Aqui es donde se va contener los 10 libros y se vam ir pasando -->
<section class="slider-section">

    <h2>Novedades</h2>

    <div class="slider-container">

        <button class="slider-btn left" onclick="moverSlide(-1)">❮</button>

        <div class="slider" id="slider">

        <?php if($res_novedades->num_rows > 0): ?>

            <?php while($libro = $res_novedades->fetch_assoc()): ?>

                <a href="libro.php?id=<?php echo $libro['id']; ?>" style="text-decoration:none; color:inherit;">

                    <div class="card">

                        <?php if(!empty($libro['imagen'])): ?>
                            <img src="<?php echo $libro['imagen']; ?>">
                        <?php else: ?>
                            <img src="img/libro1.jpg">
                        <?php endif; ?>

                        <h3><?php echo $libro['titulo']; ?></h3>

                    </div>

                </a>

            <?php endwhile; ?>

        <?php else: ?>
            <p>No hay libros todavía.</p>
        <?php endif; ?>

        </div>

        <button class="slider-btn right" onclick="moverSlide(1)">❯</button>

    </div>

</section>

<!-- aaEstas son las cards de abajo -->
<section class="features">

    <div class="feature-card">
        <h3> Intercambio de libros</h3>
        <p>Publica tus libros y encuentra otros lectores interesados en intercambiar.</p>
    </div>

    <div class="feature-card">
        <h3> Búsqueda sencilla</h3>
        <p>Encuentra rápidamente libros por título, categoría o estado.</p>
    </div>

    <div class="feature-card">
        <h3> Comunidad</h3>
        <p>Conecta con personas que comparten tu pasión por la lectura.</p>
    </div>

</section>

<!-- La banda marron de abajo que nos reedirige a explorar -->
<section class="cta">
    <h2>Empieza a intercambiar hoy</h2>
    <p>Únete a nuestra comunidad y descubre nuevos libros cada día</p>
    <a href="explorar.php">
        <button>Explorar libros</button>
    </a>
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

<!-- Mueve los libros de derecha a izquierda -->
<script>

let index = 0;

const slider = document.getElementById("slider");
const libros = document.querySelectorAll("#slider .card");

function moverSlide(direccion) {

    index += direccion;

    if (index < 0) index = 0;
    if (index >= libros.length) index = libros.length - 1;

    const ancho = libros[0].offsetWidth;

    slider.scrollTo({
        left: index * ancho,
        behavior: "smooth"
    });
}

</script>

</body>
</html>