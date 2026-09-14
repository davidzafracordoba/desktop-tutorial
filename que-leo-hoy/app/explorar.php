<?php
session_start();
include("conexion.php");

// PAGINACIÓN
$por_pagina = 36;

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if($pagina < 1) $pagina = 1;

$offset = ($pagina - 1) * $por_pagina;

// Aqui es donde obtenemos los libros y lo mostramos
$sql = "SELECT * FROM libros ORDER BY fecha_publicacion DESC LIMIT $offset, $por_pagina";
$resultado = $conexion->query($sql);

// TOTAL LIBROS
$sql_total = "SELECT COUNT(*) as total FROM libros";
$res_total = $conexion->query($sql_total);
$total = $res_total->fetch_assoc()['total'];

$total_paginas = ceil($total / $por_pagina);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Explorar - Que leo hoy</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/styles.css">

<style>
.card-link {
    text-decoration: none;
    color: inherit;
}
</style>

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

<!-- HERO -->
<section class="hero">
    <h1>Encuentra tu próximo libro</h1>
    <p>Intercambia libros fácilmente con otros lectores</p>
</section>

<main>

<!--BUSCADOR -->
<div class="search-container">
    <input type="text" id="buscador" placeholder="Buscar libros..." class="search">
</div>

<!-- FILTROS -->
<div class="filtros">

    <select id="filtroCategoria">
        <option value="">Todas las categorías</option>
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

    <select id="filtroCiudad"> 
    <option value="">Todas las ciudades</option>

    <option>Álava</option>
    <option>Albacete</option>
    <option>Alicante</option>
    <option>Almería</option>
    <option>Asturias</option>
    <option>Ávila</option>
    <option>Badajoz</option>
    <option>Barcelona</option>
    <option>Burgos</option>
    <option>Cáceres</option>
    <option>Cádiz</option>
    <option>Cantabria</option>
    <option>Castellón</option>
    <option>Ciudad Real</option>
    <option>Córdoba</option>
    <option>Cuenca</option>
    <option>Girona</option>
    <option>Granada</option>
    <option>Guadalajara</option>
    <option>Guipúzcoa</option>
    <option>Huelva</option>
    <option>Huesca</option>
    <option>Illes Balears</option>
    <option>Jaén</option>
    <option>La Coruña</option>
    <option>La Rioja</option>
    <option>Las Palmas</option>
    <option>León</option>
    <option>Lleida</option>
    <option>Lugo</option>
    <option>Madrid</option>
    <option>Málaga</option>
    <option>Murcia</option>
    <option>Navarra</option>
    <option>Ourense</option>
    <option>Palencia</option>
    <option>Pontevedra</option>
    <option>Salamanca</option>
    <option>Santa Cruz de Tenerife</option>
    <option>Segovia</option>
    <option>Sevilla</option>
    <option>Soria</option>
    <option>Tarragona</option>
    <option>Teruel</option>
    <option>Toledo</option>
    <option>Valencia</option>
    <option>Valladolid</option>
    <option>Vizcaya</option>
    <option>Zamora</option>
    <option>Zaragoza</option>
</select>
</div>

<!-- LIBROS -->
<section class="grid-libros" id="contenedorLibros">

<?php if($resultado->num_rows > 0): ?>

<?php while($libro = $resultado->fetch_assoc()): ?>

<a href="libro.php?id=<?php echo $libro['id']; ?>" class="card-link">

    <div class="card"
        data-titulo="<?php echo strtolower($libro['titulo']); ?>"
        data-categoria="<?php echo strtolower($libro['categoria']); ?>"
        data-ciudad="<?php echo strtolower($libro['ciudad']); ?>">

        <?php if(!empty($libro['imagen'])): ?>
            <img src="<?php echo $libro['imagen']; ?>">
        <?php else: ?>
            <img src="img/libro1.jpg">
        <?php endif; ?>

        <h3><?php echo $libro['titulo']; ?></h3>
        <p><?php echo $libro['categoria']; ?></p>
        <p><?php echo $libro['ciudad']; ?></p>

    </div>

</a>

<?php endwhile; ?>

<?php else: ?>
    <p>No hay libros publicados todavía.</p>
<?php endif; ?>

</section>

<!-- PAGINACIÓN -->
<div style="text-align:center; margin-top:40px;margin-bottom:40px;">

<?php if($pagina > 1): ?>
    <a href="?pagina=<?php echo $pagina - 1; ?>" style="margin-right:20px;">
        ⬅ Anterior
    </a>
<?php endif; ?>

<?php if($pagina < $total_paginas): ?>
    <a href="?pagina=<?php echo $pagina + 1; ?>">
        Siguiente ➡
    </a>
<?php endif; ?>

</div>

</main>

<!-- FOOTER -->
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

<!-- SCRIPT FILTROS MEJORADO -->
<script>

const buscador = document.getElementById("buscador");
const filtroCategoria = document.getElementById("filtroCategoria");
const filtroCiudad = document.getElementById("filtroCiudad");

const contenedor = document.getElementById("contenedorLibros");
const tarjetas = Array.from(document.querySelectorAll(".card-link"));
//Filtra libro con javascript
function filtrarLibros() {

    const texto = buscador.value.toLowerCase();
    const categoria = filtroCategoria.value.toLowerCase();
    const ciudad = filtroCiudad.value.toLowerCase();

    contenedor.innerHTML = "";

    tarjetas.forEach(cardLink => {

        const libro = cardLink.querySelector(".card");

        const tituloLibro = libro.dataset.titulo;
        const categoriaLibro = libro.dataset.categoria;
        const ciudadLibro = libro.dataset.ciudad;

        let coincideTexto = tituloLibro.includes(texto);
        let coincideCategoria = categoria === "" || categoriaLibro === categoria;
        let coincideCiudad = ciudad === "" || ciudadLibro === ciudad;

        if (coincideTexto && coincideCategoria && coincideCiudad) {
            contenedor.appendChild(cardLink);
        }

    });

    //  si no hay resultados
    if (contenedor.children.length === 0) {
        contenedor.innerHTML = "<p>No hay resultados</p>";
    }
}
//Para que se actualices los resultados automaticamente
buscador.addEventListener("keyup", filtrarLibros);
filtroCategoria.addEventListener("change", filtrarLibros);
filtroCiudad.addEventListener("change", filtrarLibros);

</script>

</body>
</html>