<?php
session_start();
session_destroy();//Para salir de la sesion

header("Location: inicio.php");
exit();
?>