<?php
// Modificar la función 
function calculate_cost($cost, $quantity, $discount = 0, $taxes = 0)
{
    $total_cost = ($cost * $quantity) - $discount; 
    $total_cost += ($total_cost * $taxes / 100); 
    return $total_cost;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Default Values for Parameters</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>The Candy Store</h1>
<h2>Product Costs</h2>

<!-- Crear una tabla para mostrar los costos calculados para varios productos -->
<table border="1">

        <tr>
            <th>Productos</th>
            <th>Coste</th>
            <th>Cantidad</th>
            <th>Descuento</th>
            <th>Taxes (%)</th>
            <th>Coste Total</th>
        </tr>

        <tr>
            <td>Dark Chocolate</td>
            <td>$5</td>
            <td>10</td>
            <td>$5</td>
            <td>7%</td>
            <td>$<?= number_format(calculate_cost(5, 10, 5, 7), 2) ?></td>
        </tr>
        <tr>
            <td>Milk Chocolate</td>
            <td>$3</td>
            <td>4</td>
            <td>$0</td>
            <td>10%</td>
            <td>$<?= number_format(calculate_cost(3, 4, 0, 10), 2) ?></td>
        </tr>
        <tr>
            <td>White Chocolate</td>
            <td>$4</td>
            <td>15</td>
            <td>$20</td>
            <td>5%</td>
            <td>$<?= number_format(calculate_cost(4, 15, 20, 5), 2) ?></td>
        </tr>
        <tr>
            <td>Chicles</td>
            <td>$2</td>
            <td>20</td>
            <td>$10</td>
            <td>8%</td>
            <td>$<?= number_format(calculate_cost(2, 20, 10, 8), 2) ?></td>
        </tr>
        <tr>
            <td>Dulces</td>
            <td>$1.5</td>
            <td>30</td>
            <td>$5</td>
            <td>6%</td>
            <td>$<?= number_format(calculate_cost(1.5, 30, 5, 6), 2) ?></td>
        </tr>
        <tr>
            <td>Chupa Chups</td>
            <td>$1</td>
            <td>50</td>
            <td>$0</td>
            <td>0%</td>
            <td>$<?= number_format(calculate_cost(1, 50, 0, 0), 2) ?></td>
        </tr>
</table>

</body>
</html>
