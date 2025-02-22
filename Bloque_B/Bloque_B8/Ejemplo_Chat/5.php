<?php
// Fecha inicial del evento
$inicio = new DateTime("2025-01-01 10:00:00");

// Intervalo de repetición (cada semana)
$intervalo = new DateInterval("P1W");

// Periodo de 2 meses
$fin = new DateTime("2025-03-01 10:00:00");

// Generar eventos recurrentes
$periodo = new DatePeriod($inicio, $intervalo, $fin);

echo "<h2>Eventos recurrentes:</h2>";
foreach ($periodo as $evento) {
    echo $evento->format('d/m/Y H:i:s') . "<br>";
}
?>