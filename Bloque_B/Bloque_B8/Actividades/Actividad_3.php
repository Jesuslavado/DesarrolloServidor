<?php
// Inicializamos el objeto DateTime con la fecha y hora del evento original
$evento = new DateTime('2024-10-16 15:30:00');

// Cambiar la fecha del evento
$evento->setDate(2024, 11, 10); 

// Cambiar la hora del evento
$evento->setTime(18, 45, 00); 

// Ajustar la fecha del evento a partir de un timestamp UNIX
$timestamp = 1734200000;
$evento->setTimestamp($timestamp);

// Modificar la fecha para sumar o restar días y horas
$evento->modify('+3 days');
$evento->modify('-2 hours');

?>

<?php include 'includes/header.php'; ?>

<p><b>Fecha y hora del evento:</b> 
   <?= $evento->format('g:i a - D, M j Y') ?>
</p>

<?php include 'includes/footer.php'; ?>
