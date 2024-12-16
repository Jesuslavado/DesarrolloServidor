<?php
include 'includes/header.php';

// Precios de las hamburguesas
$hamburguesas = [
    'Hamburguesa Clásica' => 5.50,
    'Hamburguesa con Queso' => 6.75,
    'Hamburguesa BBQ' => 7.25,
    'Hamburguesa Vegetariana' => 6.00
];

// Generar una cantidad aleatoria de ventas entre 50 y 100 para el día
$totalVentas = mt_rand(50, 100);
$totalDia = 0; // Variable para el total del día

echo "<h3>Ventas del Día:</h3>";

for ($i = 1; $i <= $totalVentas; $i++) {
    $hamburguesaSeleccionada = array_rand($hamburguesas);
    $cantidad = mt_rand(1, 5);
    
    $totalVenta = $hamburguesas[$hamburguesaSeleccionada] * $cantidad;
    
    // Redondear el total de la venta a dos decimales
    $totalVentaRedondeado = round($totalVenta, 2);
    
    $totalDia += $totalVentaRedondeado;
    
    // Mostrar la venta
    echo "Venta $i: $cantidad x $hamburguesaSeleccionada = " . number_format($totalVentaRedondeado, 2, '.', ''). "€" . "<br>";
}

// Mostrar el total del día con formato
echo "<h3>Total del Día:</h3>";
echo "Total del Día: " . number_format($totalDia, 2, '.', '') . "<br>";

// Calcular y mostrar estadísticas
echo "<h3>Estadísticas:</h3>";
echo "<b>Raíz cuadrada del total de ventas:</b> " . round(sqrt($totalDia), 2) . "<br>";
echo "<b>Potencia del total de ventas (elevado a la 2):</b> " . pow($totalDia, 2) . "<br>";
echo "<b>Redondeo hacia arriba (ceil):</b> " . ceil($totalDia) . "<br>";
echo "<b>Redondeo hacia abajo (floor):</b> " . floor($totalDia) . "<br>";
echo "<b>El total del día es un número:</b> " . (is_numeric($totalDia) ? 'Sí' : 'No') . "<br>";

include 'includes/footer.php';
?>
