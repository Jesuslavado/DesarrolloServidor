<?php
$us_price = 4;
$rates = [
    'uk' => 0.81,
    'eu' => 0.93,
    'jp' => 113.21,
    // Agregar las monedas adicionales
    'AUD' => 1.30,
    'CAD' => 1.25,
];

// Función para calcular los precios en diferentes monedas
function calculate_prices($usd, $exchange_rates) {
    $prices = [
        'pound' => $usd * $exchange_rates['uk'],
        'euro' => $usd * $exchange_rates['eu'],
        'yen' => $usd * $exchange_rates['jp'],
        // Agregar las monedas adicionales
        'AUD' => $usd * $exchange_rates['AUD'],
        'CAD' => $usd * $exchange_rates['CAD'],
    ];
    return $prices;
}

// Función para formatear precios
function formatear_precios($precio, $simbolo) {
    return $simbolo . number_format($precio, 2);
}

$global_prices = calculate_prices($us_price, $rates);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Functions with Multiple Values</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>The Candy Store</h1>
    <h2>Chocolates</h2>

    <p>Price in USD: US $<?= formatear_precios($us_price, '$') ?></p>

    <!-- Crear una tabla HTML -->
    <table border="1">
    
            <tr>
                <th>Currency</th>
                <th>Price</th>
            </tr>


            <tr>
                <td>UK (&pound;)</td>
                <td><?= formatear_precios($global_prices['pound'], '£') ?></td>
            </tr>
            <tr>
                <td>EU (&euro;)</td>
                <td><?= formatear_precios($global_prices['euro'], '€') ?></td>
            </tr>
            <tr>
                <td>JP (&yen;)</td>
                <td><?= formatear_precios($global_prices['yen'], '¥') ?></td>
            </tr>
            <tr>
                <td>AUD ($)</td>
                <td><?= formatear_precios($global_prices['AUD'], 'A$') ?></td>
            </tr>
            <tr>
                <td>CAD ($)</td>
                <td><?= formatear_precios($global_prices['CAD'], 'C$') ?></td>
            </tr>

    </table>
</body>
</html>
