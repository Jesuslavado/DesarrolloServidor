<?php
// Array de productos y sus detalles
$productos = [
    'Portátil' => [
        'descripcion' => 'Portátil de alto rendimiento con 16GB de RAM y 1TB SSD.',
        'precio' => 1299.99,
        'disponibilidad' => 'En stock',
    ],
    'Tableta' => [
        'descripcion' => 'Tableta con pantalla de 11 pulgadas y 128GB de almacenamiento.',
        'precio' => 499.99,
        'disponibilidad' => 'En stock',
    ],
    'Auriculares' => [
        'descripcion' => 'Auriculares inalámbricos con cancelación de ruido activa.',
        'precio' => 199.99,
        'disponibilidad' => 'En stock',
    ],
    'Monitor' => [
        'descripcion' => 'Monitor de 27 pulgadas con resolución 4K UHD.',
        'precio' => 349.99,
        'disponibilidad' => 'En stock',
    ],
];

// Obtener el parámetro `producto` de la cadena de consulta
$producto = $_GET['producto'] ?? '';
$valido   = array_key_exists($producto, $productos);

// Validación de producto Ejercicio 3
if (!$producto) {
    $error = 'No se seleccionó ningún producto. Por favor, selecciona uno de la lista.';
} elseif (!$valido) {
    $error = 'El producto especificado no existe. Verifica el nombre e inténtalo de nuevo.';
} else {
    $detalles = $productos[$producto];
}

?>
<?php include 'includes/header.php' ?>

<!-- Mostrar mensaje de error o detalles del producto -->
<?php if (isset($error)): ?>
    <h1>Error</h1>
    <p><?= htmlspecialchars($error) ?></p>
    <p><a href="productos.php">Volver a la lista de productos</a></p>
<?php else: ?>
    <h1><?= htmlspecialchars($producto) ?></h1>
    <p><strong>Descripción:</strong> <?= htmlspecialchars($detalles['descripcion']) ?></p>
    <p><strong>Precio:</strong> $<?= number_format($detalles['precio'], 2) ?></p>
    <p><strong>Disponibilidad:</strong> <?= htmlspecialchars($detalles['disponibilidad']) ?></p>
    <p><a href="productos.php">Volver a la lista de productos</a></p>
<?php endif; ?>

<?php include 'includes/footer.php' ?>
