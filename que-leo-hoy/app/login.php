<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login - Que leo hoy</title>

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
        <a href="login.php">Login</a>
    </nav>

</header>

<!-- HERO -->
<section class="hero">
    <h1>Accede a tu cuenta</h1>
    <p>Inicia sesión o regístrate para empezar a intercambiar libros</p>
</section>

<main>

<section class="login-section">

    <div class="login-box">

        <!--  Si ponemos las credenciales incorrecta lo comprueba -->
        <?php if(isset($_GET['error'])): ?>

            <?php if($_GET['error'] == "usuario"): ?>
                <p style="color:#583427; text-align:center; font-weight:bold;">
                    Usuario no encontrado
                </p>

            <?php elseif($_GET['error'] == "password"): ?>
                <p style="color:#583427; text-align:center; font-weight:bold;">
                    Contraseña incorrecta
                </p>

            <?php elseif($_GET['error'] == "verificar"): ?>
                <p style="color:red; text-align:center; font-weight:bold;">
                    Debes verificar tu cuenta antes de iniciar sesión
                </p>

            <?php endif; ?>

        <?php endif; ?>


        <!-- Botones -->
        <div class="login-tabs">
            <button onclick="mostrarLogin()">Iniciar sesión</button>
            <button onclick="mostrarRegistro()">Registrarse</button>
        </div>

        <!-- Formulario para iniciar sesion -->
        <form id="form-login" class="formulario" action="procesar_login.php" method="POST">
            <h2>Iniciar sesión</h2>

            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>

            <button type="submit">Entrar</button>
        </form>

        <!-- Para crear cuenta -->
        <form id="form-register" class="formulario oculto" action="procesar_registro.php" method="POST">
            <h2>Crear cuenta</h2>

            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>

            <select name="ciudad" required>
                <option value="">Selecciona tu provincia</option>
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

            <input type="text" name="pais" placeholder="País" required>

            <button type="submit">Registrarse</button>
        </form>

    </div>

</section>

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

<!-- Este scrip lo que hace es cambiar entre el login y el registro -->
<script>
const loginForm = document.getElementById("form-login");
const registerForm = document.getElementById("form-register");

function mostrarLogin() {
    loginForm.classList.remove("oculto");
    registerForm.classList.add("oculto");
}

function mostrarRegistro() {
    registerForm.classList.remove("oculto");
    loginForm.classList.add("oculto");
}
</script>

</body>
</html>