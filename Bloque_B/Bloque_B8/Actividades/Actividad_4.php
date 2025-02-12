<?php
// Definir la fecha y hora de inicio del evento
$inicio = new DateTime('2025-12-30 14:45:00');

// Definir la fecha y hora de fin del evento
$fin = new DateTime('2026-01-01 18:30:00');

// Calcular la diferencia entre ambas fechas
$duracion = $inicio->diff($fin);

// Formatear la duración en "X días, Y horas, Z minutos"
$duracion_formateada = $duracion->format('%d días, %h horas, %i minutos');

// Calcular el total de horas y minutos
$total_horas = ($duracion->days * 24) + $duracion->h; // Convertir días a horas y sumarlas
$total_minutos = ($total_horas * 60) + $duracion->i; // Convertir todo a minutos

?>

<?php include 'includes/header.php'; ?>

<p><b>Duración del evento:</b><br>
   <?= $duracion_formateada ?>
</p>

<p><b>Duración total:</b><br>
   <?= $total_horas ?> horas y <?= $duracion->i ?> minutos
</p>

<?php include 'includes/footer.php'; ?>
