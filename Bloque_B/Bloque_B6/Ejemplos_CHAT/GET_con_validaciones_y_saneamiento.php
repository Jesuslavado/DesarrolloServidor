<?php
// Comprobamos si los datos han sido enviados correctamente
if (isset($_GET['nombre']) && isset($_GET['edad'])) {
    $nombre = $_GET['nombre'];
    $edad = $_GET['edad'];

    // Validamos que los campos no estén vacíos
    if (!empty($nombre) && !empty($edad)) {
        // Saneamos los datos para evitar vulnerabilidades de XSS
        $nombre_saneado = htmlspecialchars($nombre);
        $edad_saneada = htmlspecialchars($edad);

        echo "<h1>Resultado</h1>";
        echo "<p>¡Hola, $nombre_saneado! Tienes $edad_saneada años.</p>";
    } else {
        echo "<p>Por favor, llena todos los campos del formulario.</p>";
    }
} else {
    echo "<p>No se recibieron datos válidos.</p>";
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con GET</title>
</head>
<body>
    <h1>Formulario con GET</h1>
    <form method="GET" action="procesar_get.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br><br>
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" required>
        <br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
