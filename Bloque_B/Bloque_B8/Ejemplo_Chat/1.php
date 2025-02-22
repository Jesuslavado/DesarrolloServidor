<?php
// Fecha actual del sistema
$fecha_actual = time();
echo "<h2>Fecha actual del sistema:</h2>";
echo date('d/m/Y H:i:s', $fecha_actual) . "<br>";

// Fechas del evento
$fecha_inicio = strtotime("2025-03-01 10:00:00"); // Fecha de inicio del evento
$fecha_fin = mktime(18, 0, 0, 3, 5, 2025); // Fecha de finalización del evento

echo "<h2>Fechas del evento:</h2>";
echo "Inicio: " . date('d/m/Y H:i:s', $fecha_inicio) . "<br>";
echo "Fin: " . date('d/m/Y H:i:s', $fecha_fin) . "<br>";

// Cuenta regresiva
$dias_para_inicio = ceil(($fecha_inicio - $fecha_actual) / 86400);
$dias_para_fin = ceil(($fecha_fin - $fecha_actual) / 86400);

echo "<h2>Cuenta regresiva:</h2>";
if ($fecha_actual < $fecha_inicio) {
    echo "Faltan $dias_para_inicio días para que comience el evento.<br>";
} elseif ($fecha_actual >= $fecha_inicio && $fecha_actual <= $fecha_fin) {
    echo "El evento está en curso. Faltan $dias_para_fin días para que termine.<br>";
} else {
    echo "El evento ya ha finalizado.<br>";
}
?>