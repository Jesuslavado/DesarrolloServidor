<?php
declare(strict_types = 1);

$price = '4.5'; // Este valor provocará un error porque la función espera un float.
$quantity = 3;

function calculate_total(int|float $price, int $quantity) : int|float { // Puede der float o int
    return $price * $quantity;
}

$total = calculate_total((float)$price, $quantity); // Se convierte $price a float para que no de errer
?>
<!DOCTYPE html>
<html>
<head>
<title>Return Type Declarations</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>The Candy Store</h1>
<h2>Chocolates</h2>
<p>Total $<?= $total ?></p>
</body>
</html>
