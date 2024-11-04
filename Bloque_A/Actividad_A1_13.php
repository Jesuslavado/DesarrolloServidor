<?php
// REBAJAS TIENDA DE ROPA
$ofertas=[
    ["nombre"=> "Sudaderas", "precio"=> 25, "stock"=> 100],
    ["nombre" => "Pantalones Chandal", "precio" => 20, "stock" => 80],
    ["nombre" => "Camisetas", "precio" => 15, "stock" => 160],
    ["nombre" => "Zapatos", "precio" => 60, "stock" => 40],
    ["nombre" => "Chaquetas", "precio" => 40, "stock" => 30],
];
?>

<!DOCTYPE html>
<html>
<head>
<title>Tienda De Ropa</title>
<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<center>   
<h1>Ropa Moda Style</h1>
<h2>OFERTAS</h2>
<p><?php echo $ofertas[0]['nombre']; ?> -
<?php echo $ofertas[0]['precio']; ?>€ </p>
<p><?php echo $ofertas[1]['nombre']; ?> -
<?php echo $ofertas[1]['precio']; ?>€ </p>
<p><?php echo $ofertas[2]['nombre']; ?> -
<?php echo $ofertas[2]['precio']; ?>€ </p>
<p><?php echo $ofertas[3]['nombre']; ?> -
<?php echo $ofertas[3]['precio']; ?>€ </p>
<p><?php echo $ofertas[4]['nombre']; ?> -
<?php echo $ofertas[4]['precio']; ?>€ </p>

<h2>Prendas Stock</h2>
<p><?php echo $ofertas[0]['nombre']; ?> -
<?php echo $ofertas[0]['stock']; ?> unidades </p>
<p><?php echo $ofertas[1]['nombre']; ?> -
<?php echo $ofertas[1]['stock']; ?> unidades </p>
<p><?php echo $ofertas[2]['nombre']; ?> -
<?php echo $ofertas[2]['stock']; ?> unidades </p>
<p><?php echo $ofertas[3]['nombre']; ?> -
<?php echo $ofertas[3]['stock']; ?> unidades </p>
<p><?php echo $ofertas[4]['nombre']; ?> -
<?php echo $ofertas[4]['stock']; ?> unidades </p>
</center>
</body>
</html>