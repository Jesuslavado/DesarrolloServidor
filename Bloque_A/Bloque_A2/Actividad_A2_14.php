<?php
    $name = 'Ivy'; 
    $greeting = 'Hello'; 
    if ($name) { 
        $greeting = 'Welcome back,' . $name; 
    }
    $product = 'Lollipop'; 
    $cost = 10; 
    for ($i = 1; $i <= 20; $i++) {
        $subtotal = $cost * $i; 
        $discount = ($subtotal / 100) * ($i * 4); 
        $totals[$i] = $subtotal - $discount; 
    }
?>

<?php require 'includes/header.php'; ?>
    <p><?= $greeting ?></p>
    <h2><?= $product ?> Discounts</h2>
    <table>
    <tr>
    <th>Packs</th>
    <th>Price</th>
    </tr>
    <?php foreach ($totals as $quantity => $price) { ?>
    <tr>
    <td>
        <?= $quantity ?>
        pack<?= ($quantity === 1) ? '' : 's'; ?>
        </td>
    <td>
    $<?= $price ?>
    </td>
    </tr>
    <?php } ?>
    </table>
<?php include 'includes/footer.php' ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css2/styles.css">
</head>
</html>