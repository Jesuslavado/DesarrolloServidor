<?php
declare(strict_types=1);

$candy = [
    'Toffee' => ['price' => 3.00, 'stock' => 12],
    'Mints' => ['price' => 2.00, 'stock' => 26],
    'Fudge' => ['price' => 4.00, 'stock' => 8],
];
$tax = 20;

function get_reorder_message(int $stock): string {
    return ($stock < 10) ? 'Yes' : 'No';
}

function get_total_value(float $price, int $quantity): float {
    return $price * $quantity;
}

function get_tax_due(float $price, int $quantity, int $tax = 0): float {
    return ($price * $quantity) * ($tax / 100);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">

    <title>The Candy Stock Control</title>
</head>
<body>
    <h1>The Candy Stock Control</h1>
    <table border="1">

            <tr>
                <th>Candy</th>
                <th>Stock</th>
                <th>Re-order?</th>
                <th>Total Value</th>
                <th>Tax Due</th>
            </tr>

            <?php

            foreach ($candy as $productName => $data) {  ?>
                <tr>
                    <td><?= $productName ?></td>
                    <td><?=  $data['stock'] ?></td>
                    <td><?=  get_reorder_message($data['stock']) ?></td>
                    <td><?=  get_total_value($data['price'], $data['stock']) ?></td>
                    <td><?=  get_tax_due($data['price'], $data['stock'], $tax) ?></td>
                </tr>
            <?php } ?>

    </table>
</body>
</html>
