<?php
$username = 'Jesús';
$greeting = "Hi, " . $username . "."; // Actualicé el saludo a "Hi"
$offer = [ 
    'item' => "Chocolate",
    'qty' => 3, // Cantidad actualizada a 3
    'price' => 6, // Precio actualizado a 6
    'discount' => 4, // Precio de oferta por paquete
];

$usual_price = $offer['qty'] * $offer['price']; // Precio total usual
$offer_price = $offer['qty'] * $offer['discount']; // Precio total en oferta
$saving = $usual_price - $offer_price; // Ahorro total
?>

<!DOCTYPE html>
<html>
<head>
    <title>The Candy Store</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>The Candy Store</h1>
    <h2>Multi-buy Offer</h2>
    <p><?= $greeting ?></p>
    <p class="sticker">Save $<?= $saving ?></p>
    <p>Buy <?= $offer['qty'] ?> packs of <?= $offer['item'] ?> 
    for $<?= $offer_price ?><br> (usual price $<?= $usual_price ?>)</p>
</body>
</html>
