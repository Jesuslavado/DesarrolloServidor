<?php
declare(strict_types=1);

// ARRAY ASOCIATIVO DE LIBROS
$books = [
    'El Gran Gatsby' => ['price' => 15.00, 'stock' => 10],
    '1984' => ['price' => 12.50, 'stock' => 8],
    'Matar a un Ruiseñor' => ['price' => 10.00, 'stock' => 5],
    'Orgullo y Prejuicio' => ['price' => 18.00, 'stock' => 20],
];

// Tasa de impuesto del 12%
$tax_rate = 12;

// Función para obtener el total de libros
function get_total_stock(array $inventory): int {
    $totalStock = 0;
    foreach ($inventory as $book) {
        $totalStock += $book['stock'];
    }
    return $totalStock;
}

function get_inventory_value(float $price, int $stock): float {
    return $price * $stock;
}

// Función para calcular el impuesto a pagar
function calculate_tax(float $totalValue, int $taxRate): float {
    return ($totalValue * $taxRate) / 100;
}

// Variables para los cálculos totales
$totalInventoryValue = 0;
$totalStock = 0;
$totalTax = 0;

// Cálculos de totales
foreach ($books as $data) {
    $totalInventoryValue += get_inventory_value($data['price'], $data['stock']);
    $totalStock += $data['stock'];
}
$totalTax = calculate_tax($totalInventoryValue, $tax_rate);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventarios</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h1>Actividad Final "Libros"</h1>
    <table border="1">
        <tr>
            <th>Título del Libro</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Valor Total en Inventario</th>
            <th>Impuesto a Pagar</th>
        </tr>
        <?php foreach ($books as $nombre => $data): ?>
            <tr>
                <td><?= $nombre ?></td>
                <td><?= number_format($data['price'], 2) ?> €</td>
                <td><?= $data['stock'] ?></td>
                <td><?= number_format(get_inventory_value($data['price'], $data['stock']), 2) ?> €</td>
                <td><?= number_format(calculate_tax(get_inventory_value($data['price'], $data['stock']), $tax_rate), 2) ?> €</td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
