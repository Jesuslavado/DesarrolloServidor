<?php 
$items =4;// NUEVO CANTIDAD
$cost = 10;// NUEVO COSTE
$subtotal = $items * $cost;
$tax = ($subtotal /100) * 20;
$total = $subtotal + $tax;
?>

<!DOCTYPE html>
<html>
<head>
<title>Calculator</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>The Candy Store</h1>
<h2>Shopping Cart</h2>
<p>Items: <?php echo $items; ?></p>
<p>Cost per pack: $<?php echo $cost; ?></p>
<p>Subtotal: $<?php echo $subtotal; ?></p>
<p>Tax: $<?php echo $tax; ?></p>
<p>Total: $<?php echo $total; ?></p>
</body>
</html>