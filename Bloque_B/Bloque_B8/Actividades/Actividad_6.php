<?php
// Definir la zona horaria del evento inicial (ejemplo: Madrid)
$zona_inicial = new DateTimeZone('Europe/Madrid');
$evento = new DateTime('2025-06-15 14:00:00', $zona_inicial);

// Definir las zonas horarias a convertir
$zonas_horarias = [
    'Nueva York' => new DateTimeZone('America/New_York'),
    'Tokio' => new DateTimeZone('Asia/Tokyo'),
    'Sídney' => new DateTimeZone('Australia/Sydney')
];

?>

<?php include 'includes/header.php'; ?>

<h2>Evento Global</h2>
<p><b>Fecha y hora original (Madrid):</b> <?= $evento->format('l, d M Y H:i') ?> (UTC<?= $evento->getOffset() / 3600 ?>)</p>

<h3>Conversión a otras zonas horarias:</h3>
<ul>
<?php
foreach ($zonas_horarias as $ciudad => $zona) {
    // Clonar la fecha del evento y cambiar la zona horaria
    $evento_convertido = clone $evento;
    $evento_convertido->setTimezone($zona);
    
    echo "<li><b>$ciudad:</b> " . $evento_convertido->format('l, d M Y H:i') . 
         " (UTC" . ($evento_convertido->getOffset() / 3600) . ")</li>";
}
?>
</ul>

<?php include 'includes/footer.php'; ?>
