<?php 
$items ="Chocolate";
$stock = 5;
$wanted = 8;
$can_buy = $wanted >= $stock; // CAMBIO EL SIMBOLO DE <= A >=
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
<p>Stock: <?php echo $stock; ?></p>
<p>Wanted: <?php echo $wanted; ?></p>
<p>Can Buy: <?php echo $can_buy; ?></p>
</body>
</html>
