<?php
$tax_rate = 0.15; // Modificar la tasa de impuestos al 15%
$global_discount = 0.1; // Descuento global del 10%

function calculate_running_total($price, $quantity)
{
    global $tax_rate, $global_discount; 
    static $running_total = 0; 

    $total = $price * $quantity;
    $discounted_total = $total * (1 - $global_discount); // Aplicar el descuento
    $tax = $discounted_total * $tax_rate; 
    $running_total = $running_total + $discounted_total + $tax; 

    return $running_total;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Global and Static Variables</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>The Candy Store</h1>
    <table>
        <tr><th>Item</th><th>Price</th><th>Qty</th><th>Running total</th></tr>
        <tr><td>Mints:</td><td>$2</td><td>5</td><td>$<?= calculate_running_total(2, 5) ?></td></tr>
        <tr><td>Toffee:</td><td>$3</td><td>5</td><td>$<?= calculate_running_total(3, 5) ?></td></tr>
        <tr><td>Fudge:</td><td>$5</td><td>4</td><td>$<?= calculate_running_total(5, 4) ?></td></tr>
        <tr><td>Lollipops:</td><td>$1</td><td>10</td><td>$<?= calculate_running_total(1, 10) ?></td></tr>
        <tr><td>Chocolates:</td><td>$4</td><td>6</td><td>$<?= calculate_running_total(4, 6) ?></td></tr>
        <tr><td>Caramels:</td><td>$2.5</td><td>8</td><td>$<?= calculate_running_total(2.5, 8) ?></td></tr>
    </table>
</body>
</html>
