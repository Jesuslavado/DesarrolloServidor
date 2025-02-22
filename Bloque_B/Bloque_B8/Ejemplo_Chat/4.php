<?php
// Fechas de inicio y fin del evento
$inicio = new DateTime("2025-03-01 10:00:00");
$fin = new DateTime("2025-03-03 18:30:00");

// Calcular el intervalo
$intervalo = $inicio->diff($fin);

// Mostrar la duración en un formato personalizado
echo "<h2>Duración del evento:</h2>";
echo $intervalo->format('%d días, %h horas, %i minutos') . "<br>";

// Calcular el tiempo total en horas y minutos
$horas_totales = ($intervalo->days * 24) + $intervalo->h;
$minutos_totales = ($horas_totales * 60) + $intervalo->i;
echo "Duración total: $horas_totales horas y $minutos_totales minutos.<br>";
?>