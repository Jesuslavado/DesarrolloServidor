<?php
// Lista de productos con nombres y enlaces
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
?>

<?php include 'includes/header.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
    <ul>
        <?php foreach ($productos as $producto => $detalles): ?>
            <li>
                <a href="product_EJ1.php?producto=<?= urlencode($producto) ?>"><?= htmlspecialchars($producto) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

<?php include 'includes/footer.php' ?>
