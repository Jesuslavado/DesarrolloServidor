<?php
// Fecha inicial del evento
$evento = new DateTime("2024/10/16 15:30:00");
echo "<h2>Fecha inicial del evento:</h2>";
echo $evento->format('d/m/Y H:i:s') . "<br>";

// Cambiar la fecha del evento
$evento->setDate(2024, 12, 25);
$evento->setTime(20, 0, 0);
echo "<h2>Fecha modificada:</h2>";
echo $evento->format('d/m/Y H:i:s') . "<br>";

// Ajustar la fecha desde un timestamp UNIX
$evento->setTimestamp(1735689600); // 1 de enero de 2025
echo "<h2>Fecha ajustada desde timestamp:</h2>";
echo $evento->format('d/m/Y H:i:s') . "<br>";

// Modificar la fecha sumando días y horas
$evento->modify('+2 days +3 hours');
echo "<h2>Fecha después de modificar:</h2>";
echo $evento->format('d/m/Y H:i:s') . "<br>";
?>