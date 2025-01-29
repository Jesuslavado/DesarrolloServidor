<?php
// Validamos si se recibió el comentario
if (isset($_GET['comentario'])) {
    $comentario = $_GET['comentario'];

    // Verificamos que no esté vacío
    if (!empty($comentario)) {
        // Saneamos el comentario para evitar ataques XSS
        $comentario_saneado = htmlspecialchars($comentario);

        echo "<h1>Comentario recibido</h1>";
        echo "<p>Tu comentario es: <strong>$comentario_saneado</strong></p>";
    } else {
        echo "<p>El comentario no puede estar vacío. Por favor, vuelve a intentarlo.</p>";
    }
} else {
    echo "<p>No se envió ningún comentario. Usa el formulario para enviar uno.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Comentarios</title>
</head>
<body>
    <h1>Envía tu comentario</h1>
    <form method="GET" action="mostrar_comentario.php">
        <label for="comentario">Comentario:</label><br>
        <textarea name="comentario" id="comentario" rows="5" cols="30" required></textarea>
        <br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
