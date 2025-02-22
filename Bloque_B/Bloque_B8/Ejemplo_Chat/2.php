<?php
// Fecha ingresada por el usuario
$fecha_usuario = "16/10/2024 15:30:00";

// Crear objeto DateTime
$fecha_obj = DateTime::createFromFormat('d/m/Y H:i:s', $fecha_usuario);

if ($fecha_obj) {
    echo "<h2>Fecha ingresada:</h2>";
    echo "Formato original: " . $fecha_obj->format('d/m/Y H:i:s') . "<br>";
    echo "Formato ISO: " . $fecha_obj->format('Y-m-d H:i:s') . "<br>";
    echo "Timestamp UNIX: " . $fecha_obj->getTimestamp() . "<br>";
    echo "Formato legible: " . $fecha_obj->format('d \d\e F \d\e Y, H:i') . "<br>";
} else {
    echo "La fecha ingresada no es válida.";
}
?>