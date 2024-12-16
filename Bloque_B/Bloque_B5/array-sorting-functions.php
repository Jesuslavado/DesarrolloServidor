<?php
include 'includes/header.php';

// Lista de canciones con número de reproducciones aleatorias
$canciones_con_reproducciones = [
    "Blinding Lights - The Weeknd" => mt_rand(1000, 5000),
    "Estoy enfermo - Pignoise" => mt_rand(1000, 5000),
    "Levitating - Dua Lipa" => mt_rand(1000, 5000),
    "One more night - Maroon 5" => mt_rand(1000, 5000),
    "Feel Good Inc. - Gorillaz" => mt_rand(1000, 5000),
];

// Mostrar la lista original con las reproducciones generadas
echo "<h2>Canciones con reproducciones aleatorias</h2>";
echo "<pre>";
print_r($canciones_con_reproducciones);
echo "</pre>";

// 1. Ordenar la lista por nombre de canción en orden ascendente
echo "<h2>Ordenar por nombre de canción (Ascendente)</h2>";
$sortedByNameAsc = $canciones_con_reproducciones;
sort($sortedByNameAsc);
echo "<pre>";
print_r($sortedByNameAsc);
echo "</pre>";

// 2. Ordenar la lista por nombre de canción en orden descendente
echo "<h2>Ordenar por nombre de canción (Descendente)</h2>";
$sortedByNameDesc = $canciones_con_reproducciones;
rsort($sortedByNameDesc);
echo "<pre>";
print_r($sortedByNameDesc);
echo "</pre>";

// 3. Ordenar la lista por número de reproducciones en orden ascendente
echo "<h2>Ordenar por número de reproducciones (Ascendente)</h2>";
$sortedByRepsAsc = $canciones_con_reproducciones;
asort($sortedByRepsAsc);
echo "<pre>";
print_r($sortedByRepsAsc);
echo "</pre>";

// 4. Ordenar la lista por número de reproducciones en orden descendente
echo "<h2>Ordenar por número de reproducciones (Descendente)</h2>";
$sortedByRepsDesc = $canciones_con_reproducciones;
arsort($sortedByRepsDesc);
echo "<pre>";
print_r($sortedByRepsDesc);
echo "</pre>";

// 5. Ordenar la lista por clave (nombre de canción) en orden ascendente
echo "<h2>Ordenar por clave (nombre de canción) (Ascendente)</h2>";
ksort($canciones_con_reproducciones);
echo "<pre>";
print_r($canciones_con_reproducciones);
echo "</pre>";

// 6. Ordenar la lista por clave (nombre de canción) en orden descendente
echo "<h2>Ordenar por clave (nombre de canción) (Descendente)</h2>";
krsort($canciones_con_reproducciones);
echo "<pre>";
print_r($canciones_con_reproducciones);
echo "</pre>";

include 'includes/footer.php';
?>
