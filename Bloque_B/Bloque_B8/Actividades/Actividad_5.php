<?php
// Definir la fecha y hora de inicio del evento
$inicio_evento = new DateTime('2025-03-01 10:00:00');

// Duración del evento (ejemplo: 2 horas y 30 minutos)
$duracion_evento = new DateInterval('PT2H30M'); 

// Definir el intervalo de repetición (cada 7 días - semanal)
$intervalo_repeticion = new DateInterval('P7D');

// Definir la fecha final del periodo de repetición (2 meses después)
$fin_periodo = clone $inicio_evento;
$fin_periodo->modify('+2 months');

// Generar la lista de eventos usando DatePeriod
$periodo = new DatePeriod($inicio_evento, $intervalo_repeticion, $fin_periodo);

?>

<?php include 'includes/header.php'; ?>

<h2>Eventos recurrentes</h2>
<p>Reunión semanal programada durante 2 meses.</p>

<ul>
<?php foreach ($periodo as $evento) { 
    // Calcular la hora de finalización sumando la duración al evento
    $fin_evento = clone $evento;
    $fin_evento->add($duracion_evento);
?>
    <li>
        <b><?= $evento->format('l, d M Y') ?></b><br>
        Hora: <?= $evento->format('H:i') ?> - <?= $fin_evento->format('H:i') ?> (Duración: 2h 30m)
    </li>
<?php } ?>
</ul>

<?php include 'includes/footer.php'; ?>
