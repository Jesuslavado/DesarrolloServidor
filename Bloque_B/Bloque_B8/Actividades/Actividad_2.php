<?php
include 'includes/header.php'; 

// Recibir la fecha de entrada
$fecha_entrada = "16/10/2024 15:30:00"; // Ejemplo, cambiar por input dinámico si es necesario

// Convertir la fecha en un objeto DateTime
$fecha_objeto = date_create_from_format('d/m/Y H:i:s', $fecha_entrada);

if ($fecha_objeto) {
    echo "<p><b>Fecha formateada:</b> " . $fecha_objeto->format('Y-m-d H:i:s') . "</p>";
    echo "<p><b>Timestamp UNIX:</b> " . $fecha_objeto->getTimestamp() . "</p>";

    // Formato legible en español con IntlDateFormatter (alternativa a strftime)
    $formatter = new IntlDateFormatter(
        'es_ES', 
        IntlDateFormatter::FULL, 
        IntlDateFormatter::SHORT, 
        'Europe/Madrid', 
        IntlDateFormatter::GREGORIAN,
        "d 'de' MMMM 'de' yyyy, HHmm"
    );
    echo "<p><b>Fecha legible:</b> " . $formatter->format($fecha_objeto) . "</p>";
} else {
    echo "<p>Error: Formato de fecha incorrecto.</p>";
}

include 'includes/footer.php'; 
?>
