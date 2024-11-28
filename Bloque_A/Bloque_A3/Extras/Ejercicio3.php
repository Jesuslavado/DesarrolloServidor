<?php
declare(strict_types=1);

// Incluimos la clase o funciones definidas previamente
require_once 'ArrayFunciones.php';

// Generamos los arrays para los ejemplos
$array1 = ArrayFunciones::generaArrayInt(0, 40, 3); // Array aleatorio
$array2 = ArrayFunciones::volteaArrayInt($array1);  // Array invertido
$numero = 5; // Número para verificar si está en el array
$sumaAcumulada = ArrayFunciones::sumaAcumuladaArray($array1); // Suma acumulada
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen</title>
</head>
<body>
<!-- MOSTRAMOS LOS RESULTADOS EN FORMATO HTML Y PHP-->
<h1>Resultado de las Funciones de Array</h1>

<h2>Array 1 (Aleatorios)</h2>
<p><?= "Array 1: "; ArrayFunciones::muestraArray($array1); ?></p>
<p><?= "Mínimo: " . ArrayFunciones::minimoArrayInt($array1); ?></p>
<p><?= "Máximo: " . ArrayFunciones::maximoArrayInt($array1); ?></p>
<p><?= "Media: " . ArrayFunciones::mediaArrayInt($array1); ?></p>
<p><?= "¿Está el número " . $numero . " en el array? " . (ArrayFunciones::estaEnArrayInt($array1, $numero) ? "Sí" : "No"); ?></p>
<p><?php 
    $indice = ArrayFunciones::posicionEnArray($array1, $numero); 
    echo $indice !== null 
        ? "La posición del número " . $numero . " en el array es: " . $indice 
        : "El número " . $numero . " no está en el array.";
?></p>

<h2>Array 2 (Invertido)</h2>
<p><?= "Array invertido: "; ArrayFunciones::muestraArray($array2); ?></p>

<h2>Array 3 (Acumulada)</h2>
<p><?= "Suma acumulada: " . $sumaAcumulada; ?></p>

<hr>

<h2>Resultados de las Funciones</h2>

</body>
</html>
