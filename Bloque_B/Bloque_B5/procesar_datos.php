<?php
include 'includes/header.php'; 
$nombre = "Jesús Lavado García";
$correo = "  jesUS@gmail.com";
$mensaje = "MENSAJE: PROBLEMA EN LA BASE DE DATOS";

echo "<h2>Datos Originales:</h2>";
echo "<b>Nombre:</b> '$nombre'<br>";
echo "<b>Correo:</b> '$correo'<br>";
echo "<b>Mensaje:</b> '$mensaje'<br>";

$nombre = trim($nombre);
$correo = trim($correo);
$mensaje = trim($mensaje);

$correo = strtolower($correo);

$mensaje = str_replace("urgente", "", $mensaje);


$mensaje = str_ireplace("urgente", "Prioridad Alta", $mensaje);


$mensaje .= str_repeat("!", 3);

echo "<h2>Datos Procesados:</h2>";
echo "<b>Nombre:</b> '$nombre'<br>";
echo "<b>Correo:</b> '$correo'<br>";
echo "<b>Mensaje:</b> '$mensaje'<br>";
include 'includes/footer.php'; 
?>