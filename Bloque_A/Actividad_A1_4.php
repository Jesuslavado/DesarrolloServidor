<?php
$best_sellers = ['Chocolate'
,
'Mints'
,
'Fudge'
,
'Caramelo',// Elemento Añadido

'Bubble gum'
,
'Toffee'
,
'Jelly beans'
,];
?>

<!DOCTYPE html>
<html>
<head>
<title>Indexed Arrays</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>The Candy Store</h1>
<h2>Best Sellers</h2>
<ul>
<li><?php echo $best_sellers[0]; ?></li>
<li><?php echo $best_sellers[1]; ?></li>
<li><?php echo $best_sellers[2]; ?></li>
<!--Muestro los elementos 4 y 5 del array  (Si quisiera mostrar el elemnto añadido sería el 3 segun so posición empezando desde 0)-->

<li><?php echo $best_sellers[4]; ?></li>

<li><?php echo $best_sellers[5]; ?></li>
</ul>
</body>
</html>
