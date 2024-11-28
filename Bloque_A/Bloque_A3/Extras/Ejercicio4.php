<?php 
// VARIABLES
$contador=0;

// FUNCIONES
 function generaArrayInt(int $min, int $max, int $n = 10, ?int $value = null): array {
    $array = [];
    if ($value !== null) {
        for ($i = 0; $i < $n; $i++) {
            $array[] = $value + $i;
        }
    } else {
        for ($i = 0; $i < $n; $i++) {
            $array[] = rand($min, $max);
        }
    }
    return $array;
}

// Funcion que muestra el array
function muestraArray(array $array) {
    echo "(" . implode(", ", $array) . ")\n";
}

//  Funcion que devuelve el valor mínimo del array.
function minimoArrayInt(array $array): int {
    return min($array);
}

// Funcion que devuelve el valor máximo del array.
function maximoArrayInt(array $array): int {
    return max($array);
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
    ?>
</body>
</html>