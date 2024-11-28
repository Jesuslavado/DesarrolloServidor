<?php 

// VARIABLES
$dimension1=3;
$dimension2=20;

// FUNCIONES
function calcularArea($dimension1, $dimension2=null, $figura="cuadrado"){
    if($figura=="cuadrado"){
        return $dimension1 * $dimension2;
    }
    else{
        echo "No se ha definido la figura";
    }
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
    <?php
    echo "El area es: " . calcularArea($dimension1, $dimension2, "cuadrado") . " m2";
    ?>
</body>
</html>