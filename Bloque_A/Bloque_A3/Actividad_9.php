<?php
// Crear un array de productos
$products = [
    'Chocolates' => 25,
    'Dulces' => 10,
    'Gominolas' => 3,
    'Caramelos' => 0,
];

function get_stock_message($stock) {
    if ($stock === 10) {
        return 'Exactly 10 items in stock'; // Nueva condición para 10 artículos
    }
    if ($stock >= 10) {
        return 'Good availability';
    }
    if ($stock > 0 && $stock < 10) {
        return 'Low stock';
    }
    return 'Out of stock';
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Multiple Return Statements</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>The Candy Store</h1>
<h2>Product Stock</h2>

<!-- Crear una tabla para mostrar el stock de varios productos -->
<table border="1">
        <tr>
            <th>Product</th>
            <th>Stock Status</th>
        </tr>

        <?php
        foreach ($products as $product => $stock) {
            echo "<tr>";
            echo "<td>" . $product . "</td>";
            echo "<td>" . get_stock_message($stock) . "</td>";
            echo "</tr>";
        }
        ?>
</table>

</body>
</html>
