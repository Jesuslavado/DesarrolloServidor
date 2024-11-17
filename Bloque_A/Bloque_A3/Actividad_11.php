<?php
function calculate_cost($cost, $quantity, $discount = 0, $tax = 20, $shipping = 0) // Agregar el parámetro $shipping
{
    $cost = $cost * $quantity;
    $tax = $cost * ($tax / 100);
    return ($cost + $tax + $shipping) - $discount;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Costos de Productos - Tienda de Dulces</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Tienda de Dulces</h1>
    <h2>Tabla de Costos</h2>
    // Crear una tabla para mostrar los costos calculados para varios productos
    <table border="1">

            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Descuento</th>
                <th>Impuesto</th>
                <th>Envío</th>
                <th>Costo Total</th>
            </tr>

            <tr>
                <td>Chocolate Oscuro</td>
                <td>10</td>
                <td>$5</td>
                <td>$2</td>
                <td>5%</td>
                <td>$3</td>
                <td>$<?= calculate_cost(cost: 5, quantity: 10, discount: 2, tax: 5, shipping: 3) ?></td>
            </tr>
            <tr>
                <td>Chocolate con Leche</td>
                <td>10</td>
                <td>$5</td>
                <td>$0</td>
                <td>5%</td>
                <td>$3</td>
                <td>$<?= calculate_cost(cost: 5, quantity: 10, tax: 5, shipping: 3) ?></td>
            </tr>
            <tr>
                <td>Chocolate Blanco</td>
                <td>5</td>
                <td>$10</td>
                <td>$1</td>
                <td>5%</td>
                <td>$2</td>
                <td>$<?= calculate_cost(cost: 10, quantity: 5, discount: 1, tax: 5, shipping: 2) ?></td>
            </tr>
            <tr>
                <td>Chocolate Amargo</td>
                <td>3</td>
                <td>$15</td>
                <td>$3</td>
                <td>10%</td>
                <td>$5</td>
                <td>$<?= calculate_cost(cost: 15, quantity: 3, discount: 3, tax: 10, shipping: 5) ?></td>
            </tr>
            <tr>
                <td>Chocolate con Almendras</td>
                <td>7</td>
                <td>$8</td>
                <td>$2</td>
                <td>8%</td>
                <td>$4</td>
                <td>$<?= calculate_cost(cost: 8, quantity: 7, discount: 2, tax: 8, shipping: 4) ?></td>
            </tr>
    </table>
</body>
</html>
