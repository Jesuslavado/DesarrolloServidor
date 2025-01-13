<?php
// Configuración de las opciones del filtro
$settings = [
    'flags' => FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE, // Solo IPv4, sin rangos privados ni reservados
    'options' => [
        'default' => '0.0.0.0' // Valor por defecto si la IP no es válida
    ]
];

// Filtrar el input del usuario
$ip = filter_input(INPUT_POST, 'ip', FILTER_VALIDATE_IP, $settings);
?>
<?php include 'includes/header.php'; ?>

<p>Ingresa una dirección IP válida (IPv4, excluyendo direcciones privadas o reservadas). Si la dirección no es válida, se usará "0.0.0.0" como valor predeterminado.</p>

<form action="Ejrecicio_12.php" method="POST">
  Dirección IP: <input type="text" name="ip" value="<?= htmlspecialchars($ip) ?>">
  <input type="submit" value="Guardar">
</form>

<pre>
<?php 
// Mostrar el resultado de la validación
var_dump($ip);
?>
</pre>

<?php include 'includes/footer.php'; ?>
