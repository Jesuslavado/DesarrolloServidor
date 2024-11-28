<?php

function calcula_precio_final(float $precio_base, int $cantidad, float $descuento = 0, float $impuesto = 21): float {
    $calculo_subtotal = $precio_base * $cantidad;
    $calculo_descuento = ($calculo_subtotal * $descuento) / 100;
    $anadir_impuesto = (($calculo_subtotal - $calculo_descuento) * $impuesto) / 100;
    $precio_final = $calculo_subtotal - $calculo_descuento + $anadir_impuesto;
    return number_format($precio_final, 2); // Formatear a dos decimales
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio Base</th>
                <th>Cantidad</th>
                <th>Descuento (%)</th>
                <th>Impuesto (%)</th>
                <th>Precio Final</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Producto 1</td>
                <td>$10</td>
                <td>5</td>
                <td>4</td>
                <td>21</td>
                <td>$<?= calcula_precio_final(10, 5, 4, 21) ?></td>
            </tr>
            <tr>
                <td>Producto 2</td>
                <td>$12</td>
                <td>6</td>
                <td>3</td>
                <td>21</td>
                <td>$<?= calcula_precio_final(12, 6, 3, 21) ?></td>
            </tr>
            <tr>
                <td>Producto 3</td>
                <td>$12</td>
                <td>10</td>
                <td>0</td>
                <td>21</td>
                <td>$<?= calcula_precio_final(12, 10) ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
