<?php
// Validar tipo y tamaño de imagen
$uploadDir = "uploads/";
$maxSize = 5 * 1024 * 1024; // 5MB
$allowedTypes = ['image/jpeg', 'image/png'];

// Verificar si la carpeta "uploads" existe, si no, crearla con permisos adecuados
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Verificar si se ha enviado un formulario con una imagen
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    
    // Obtener el archivo temporal subido
    $archivoTemporal = $_FILES['image']['tmp_name'];
    $tipoArchivo = mime_content_type($archivoTemporal);
    $tamanoArchivo = $_FILES['image']['size'];

    // Validar tipo de archivo permitido
    if (!in_array($tipoArchivo, $allowedTypes)) {
        die("<h3>Error: Tipo de archivo no permitido (solo JPG y PNG).</h3>");
    }

    // Validar tamaño de archivo permitido
    if ($tamanoArchivo > $maxSize) {
        die("<h3>Error: El archivo supera el tamaño máximo de 5MB.</h3>");
    }

    // Obtener nombre del archivo y definir la ruta de destino
    $nombreArchivo = basename($_FILES['image']['name']);
    $rutaDestino = $uploadDir . $nombreArchivo;

    // Mover el archivo subido desde la carpeta temporal a la carpeta de destino
    if (move_uploaded_file($archivoTemporal, $rutaDestino)) {
        echo "<h3>Archivo subido con éxito</h3>";
        echo "<img src='$rutaDestino' width='200'>"; // Mostrar la imagen subida
    } else {
        echo "<h3>Error al mover el archivo.</h3>";
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
    <!-- Formulario para subir imágenes -->
    <form action="Ejemplo_2.php" method="POST" enctype="multipart/form-data">
        <label for="file">Selecciona una imagen:</label>
        <input type="file" name="image" accept="image/jpeg, image/png" required>
        <button type="submit">Subir</button>
    </form>
</body>
</html>
