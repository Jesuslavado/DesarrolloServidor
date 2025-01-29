<?php 
// Directorio donde se guardarán las imágenes subidas
$uploadDir = "uploads/";

// Verificar si el directorio existe, si no, crearlo con permisos 0777
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Verificar si el formulario ha sido enviado y si se ha subido un archivo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    $archivoTemporal = $_FILES['image']['tmp_name']; // Nombre temporal del archivo subido
    $nombreArchivo = basename($_FILES['image']['name']); // Nombre original del archivo
    $rutaDestino = $uploadDir . $nombreArchivo; // Ruta completa donde se guardará el archivo

    // Mover el archivo del directorio temporal al directorio de destino
    if (move_uploaded_file($archivoTemporal, $rutaDestino)) {
        echo "<h3>Archivo subido con éxito</h3>";
        echo "<img src='$rutaDestino' width='200'>"; // Mostrar la imagen subida
    } else {
        echo "<h3>Error al mover el archivo.</h3>"; // Mensaje de error si la subida falla
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen</title>
</head>
<body>
    <h2>Subir una imagen</h2>
    <!-- Formulario para subir una imagen -->
    <form action="Ejemplo_1.php" method="POST" enctype="multipart/form-data">
        <label for="file">Selecciona una imagen:</label>
        <input type="file" name="image" accept="image/jpeg, image/png" required>
        <button type="submit">Subir</button>
    </form>
</body>
</html>
