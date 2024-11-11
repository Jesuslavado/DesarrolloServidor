<?php
$stock = 0;
$message = ($stock > 0) ? 'In stock' : 'More stock coming soon';
?>
<!DOCTYPE html>
<html>
<head>
<title>Ternary Operator</title>
<link rel="stylesheet" href="css2/styles.css">
</head>
<body>
<h1>The Candy Store</h1>
<h2>Chocolate</h2>
<p><?= $message ?></p>
</body>
</html>