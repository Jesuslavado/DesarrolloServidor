<?php
// FECHA ACTUAL
$fecha_actual = time();
$fecha_actual_formateada = date('l, d M Y', $fecha_actual);

// FECHA DE INICIO DEL EVENTO
$fecha_inicio = strtotime('March 10 2025');
$fecha_inicio_formateada = date('l, d M Y', $fecha_inicio);

// FECHA DE FIN DEL EVENTO
$fecha_fin = mktime(0, 0, 0, 3, 20, 2025);
$fecha_fin_formateada = date('l, d M Y', $fecha_fin);

// CALCULO
$dias_para_inicio = ceil(($fecha_inicio - $fecha_actual) / 86400);
$dias_para_fin = ceil(($fecha_fin - $fecha_actual) / 86400);

// EVENTOS
if ($fecha_actual < $fecha_inicio) {
    $mensaje = "El evento comenzará en $dias_para_inicio días.";
} elseif ($fecha_actual >= $fecha_inicio && $fecha_actual <= $fecha_fin) {
    $mensaje = "El evento está en curso y finalizará en $dias_para_fin días.";
} else {
    $mensaje = "El evento ha finalizado.";
}
?>

<?php include 'includes/header.php'; ?>

<p><b>Fecha actual:</b> <?= $fecha_actual_formateada ?></p>
<p><b>Inicio del evento:</b> <?= $fecha_inicio_formateada ?></p>
<p><b>Fin del evento:</b> <?= $fecha_fin_formateada ?></p>
<p><b>Estado del evento:</b> <?= $mensaje ?></p>

<?php include 'includes/footer.php'; ?>
