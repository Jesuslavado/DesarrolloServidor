<?php
    $nombre = ' Jesús'; 
    $mensaje = 'Hola'; 
    if ($nombre) { 
        $mensaje = 'Gracias por entrar en la página, ' . $nombre; 
    }
    $producto = 'Entradas'; 
    $cost = 30; 
    for ($i = 1; $i <= 8; $i++) {
        $subtotal = $cost * $i; 
        $descuento = ($subtotal / 100) * ($i * 4); 
        $totals[$i] = $subtotal - $descuento; 
    }
?>

<?php require 'incluidas/cabeza.php'; ?>
    <p><?= $mensaje ?></p>
    <h2><?= $producto ?> A LOS MEJORES PRECIOS</h2>
    <table>
    <tr>
    <th>Packs</th>
    <th>Precio</th>
    </tr>
    <?php foreach ($totals as $cantidad => $precio) { ?>
    <tr>
    <td>
        <?= $cantidad ?>
        pack<?= ($cantidad === 1) ? '' : 's'; ?>
        </td>
    <td>
    $<?= $precio ?>
    </td>
    </tr>
    <?php } ?>
    </table>
<?php include 'incluidas/cuerpo.php' ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css2/estilos_15.css">
</head>
</html>