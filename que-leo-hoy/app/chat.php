<?php 
session_start();
include("conexion.php");
//Comprobar si el usuario a iniciado sesion
if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['usuario'])){
    echo "Chat no encontrado";
    exit();
}

$yo = $_SESSION['usuario_id'];
$otro = (int)$_GET['usuario']; //Obtiene el ID del usuario con el que queremos hablar

// USUARIO
$sqlUser = "SELECT nombre FROM usuarios WHERE id = $otro";
$resUser = $conexion->query($sqlUser);
$usuario = $resUser->fetch_assoc();

// LIBRO 
$sqlLibro = "
SELECT libro_id 
FROM mensajes 
WHERE 
(
    (emisor_id = $yo AND receptor_id = $otro)
    OR
    (emisor_id = $otro AND receptor_id = $yo)
)
AND libro_id != 0
ORDER BY fecha DESC 
LIMIT 1
";

$resLibro = $conexion->query($sqlLibro);

$libro = null;
$libro_id = 0;

if($resLibro && $resLibro->num_rows > 0){
    $row = $resLibro->fetch_assoc();
    $libro_id = $row['libro_id'];

    $resDatosLibro = $conexion->query("SELECT * FROM libros WHERE id = $libro_id");
    $libro = $resDatosLibro->fetch_assoc();
}

//Consulta de mensajes
$sql = "
SELECT mensajes.*, usuarios.nombre AS emisor_nombre
FROM mensajes
JOIN usuarios ON mensajes.emisor_id = usuarios.id
WHERE 
(
    (mensajes.emisor_id = $yo AND mensajes.receptor_id = $otro)
    OR
    (mensajes.emisor_id = $otro AND mensajes.receptor_id = $yo)
)
" . ($libro_id != 0 ? "AND mensajes.libro_id = $libro_id" : "") . "
ORDER BY mensajes.fecha ASC
";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Chat</title>
<link rel="stylesheet" href="css/styles.css">
</head>

<body>

<div class="chat-header">
    <button onclick="window.history.back()" class="btn-volver">← Volver</button>
    <span class="chat-titulo">Chat con <?php echo $usuario['nombre']; ?></span>
</div>

<div class="chat-container">

    <!-- IZQUIERDA -->
    <div class="chat-libro">
        <h3>Usuario:</h3>
        <p><?php echo $usuario['nombre']; ?></p>

        <?php if($libro): ?>
            <hr>
            <h3>Libro:</h3>

            <img src="<?php echo !empty($libro['imagen']) ? $libro['imagen'] : 'img/libro1.jpg'; ?>" 
                 style="width:100%; border-radius:10px;">

            <p><strong><?php echo $libro['titulo']; ?></strong></p>
        <?php endif; ?>
    </div>

    <!-- Carga mensajes -->
    <div class="chat-mensajes">

        <div class="chat-box" id="chatBox">

        <?php while($msg = $resultado->fetch_assoc()): 
            $clase = ($msg['emisor_id'] == $yo)
                ? "mensaje tuyo"
                : ($msg['leido'] == 0 ? "mensaje otro nuevo" : "mensaje otro");
        ?>

            <div class="<?php echo $clase; ?>">
                <p><?php echo $msg['mensaje']; ?></p>
            </div>

        <?php endwhile; ?>

        </div>

        <!--  marca leido -->
        <?php
        $conexion->query("
        UPDATE mensajes 
        SET leido = 1 
        WHERE receptor_id = $yo 
        AND emisor_id = $otro
        " . ($libro_id != 0 ? "AND libro_id = $libro_id" : ""));
        ?>

        <!-- FORM -->
        <form id="formMensaje" class="chat-form">

            <input type="hidden" name="receptor_id" value="<?php echo $otro; ?>">
            <input type="hidden" name="libro_id" value="<?php echo $libro_id; ?>">

            <input type="text" id="mensajeInput" name="mensaje" placeholder="Escribe un mensaje..." required>

            <button type="submit">Enviar</button>

        </form>

    </div>

</div>

<script>
const form = document.getElementById("formMensaje");
const input = document.getElementById("mensajeInput");
const chatBox = document.getElementById("chatBox");

form.addEventListener("submit", function(e){
    e.preventDefault();

    let datos = new FormData(form);
    let mensaje = input.value;

    fetch("enviar_mensaje.php", {
        method: "POST",
        body: datos,
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        }
    })
    .then(res => res.text())
    .then(data => {

        console.log("RESPUESTA:", data); // DEBUG

        if(data.includes("ok")){

            let nuevo = document.createElement("div");
            nuevo.className = "mensaje tuyo";
            nuevo.innerHTML = "<p>" + mensaje + "</p>";

            chatBox.appendChild(nuevo);

            input.value = "";
            chatBox.scrollTop = chatBox.scrollHeight;

        } else {
            alert("Error al enviar: " + data);
        }

    });
});

// scroll automático
chatBox.scrollTop = chatBox.scrollHeight;
</script>

</body>
</html>