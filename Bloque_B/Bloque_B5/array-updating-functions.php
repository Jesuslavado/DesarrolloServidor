<?php
include 'includes/header.php';
// Lista de canciones inicial
$playlist = [
    "Blinding Lights - The Weeknd",
    "Estoy enfermo - Pignoise",
    "Levitating - Dua Lipa",
    "One more night - Maroon 5",
    "Feel Good Inc. - Gorillaz",
];

// 1. Agregar canciones
echo "<h2>Agregar canciones</h2>";
$newSong1 = "Shape of You - Ed Sheeran";
$newSong2 = "Take On Me - A-ha";
$newSong3 = "Bohemian Rhapsody - Queen";

// Agregar al final
array_push($playlist, $newSong1);
echo "<p>Agregada al final: $newSong1</p>";

// Agregar al inicio
array_unshift($playlist, $newSong2);
echo "<p>Agregada al inicio: $newSong2</p>";

// Verificar si existe antes de agregar
if (!in_array($newSong3, $playlist)) {
    array_push($playlist, $newSong3);
    echo "<p>Agregada al final: $newSong3</p>";
}

// Mostrar la lista actual
echo "<p><b>Lista actual:</b><br><ul>";
foreach ($playlist as $song) {
    echo "<li>$song</li>";
}
echo "</ul>";

// 2. Eliminar canciones
echo "<h2>Eliminar canciones</h2>";
$removedFirst = array_shift($playlist);
$removedLast = array_pop($playlist);
echo "<p>Eliminada del inicio: $removedFirst</p>";
echo "<p>Eliminada del final: $removedLast</p>";
echo "<p><b>Lista tras eliminaciones:</b><br><ul>";
foreach ($playlist as $song) {
    echo "<li>$song</li>";
}
echo "</ul>";

// 3. Buscar canción
echo "<h2>Buscar una canción</h2>";
$searchSong = "Levitating - Dua Lipa";
$position = array_search($searchSong, $playlist);
if ($position !== false) {
    echo "<p>Canción encontrada: \"$searchSong\" en la posición $position</p>";
} else {
    echo "<p>Canción \"$searchSong\" no encontrada en la lista.</p>";
}

// 4. Verificar existencia de una canción
echo "<h2>Verificar existencia</h2>";
$checkSong = "Feel Good Inc. - Gorillaz";
if (in_array($checkSong, $playlist)) {
    echo "<p>La canción \"$checkSong\" está en la lista.</p>";
} else {
    echo "<p>La canción \"$checkSong\" no está en la lista.</p>";
}

// 5. Contar canciones
echo "<h2>Contar canciones</h2>";
$totalSongs = count($playlist);
echo "<p>Total de canciones en la lista: $totalSongs</p>";

// 6. Seleccionar canciones aleatorias
echo "<h2>Seleccionar canciones aleatorias</h2>";
$randomKeys = array_rand($playlist, 2); // Seleccionar 2 canciones aleatorias
echo "<p>Canción aleatoria 1: {$playlist[$randomKeys[0]]}</p>";
echo "<p>Canción aleatoria 2: {$playlist[$randomKeys[1]]}</p>";

// 7. Mostrar lista como cadena
echo "<h2>Mostrar lista como cadena</h2>";
$playlistString = implode(", ", $playlist);
echo "<p>Lista como cadena: $playlistString</p>";

// 8. Dividir cadena en canciones
echo "<h2>Dividir cadena en canciones</h2>";
$recreatedPlaylist = explode(", ", $playlistString);
echo "<p>Lista recreada desde cadena:</p><ul>";
foreach ($recreatedPlaylist as $song) {
    echo "<li>$song</li>";
}
echo "</ul>";

// 9. Eliminar duplicados
echo "<h2>Eliminar duplicados</h2>";
$playlistWithDuplicates = array_merge($playlist, ["Levitating - Dua Lipa", "Blinding Lights - The Weeknd"]);
echo "<p>Lista con duplicados:</p><pre>" . print_r($playlistWithDuplicates, true) . "</pre>";
$uniquePlaylist = array_unique($playlistWithDuplicates);
echo "<p>Lista sin duplicados:</p><pre>" . print_r($uniquePlaylist, true) . "</pre>";

// 10. Fusionar listas
echo "<h2>Fusionar listas</h2>";
$additionalPlaylist = ["Rolling in the Deep - Adele", "Uptown Funk - Bruno Mars"];
$mergedPlaylist = array_merge($playlist, $additionalPlaylist);
echo "<p>Lista fusionada:</p><ul>";
foreach ($mergedPlaylist as $song) {
    echo "<li>$song</li>";
}
echo "</ul>";

include 'includes/footer.php';
?>