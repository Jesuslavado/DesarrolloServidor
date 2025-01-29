<?php
// Directorios para almacenar imágenes y miniaturas
$uploadDir = "uploads/";
$thumbDir = "uploads/thumbs/";

// Verifica si los directorios existen, si no, los crea con permisos 0777
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
if (!file_exists($thumbDir)) {
    mkdir($thumbDir, 0777, true);
}

/**
 * Función para redimensionar una imagen manteniendo la proporción
 * @param string $source Ruta de la imagen original
 * @param string $destination Ruta donde se guardará la imagen redimensionada
 * @param int $width Ancho deseado
 * @param int $height Alto deseado
 * @return bool Retorna true si la redimensión fue exitosa, false en caso contrario
 */
function resizeImage($source, $destination, $width, $height) {
    list($origWidth, $origHeight, $type) = getimagesize($source);
    
    switch ($type) {
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($source);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($source);
            break;
        default:
            return false;
    }

    $ratio = $origWidth / $origHeight;
    if ($width / $height > $ratio) {
        $newWidth = intval($height * $ratio); // Convertimos a entero
        $newHeight = intval($height); // Convertimos a entero
    } else {
        $newHeight = intval($width / $ratio); // Convertimos a entero
        $newWidth = intval($width); // Convertimos a entero
    }

    // Asegurarse de que los valores sean enteros antes de pasarlos a imagecreatetruecolor
    $thumb = imagecreatetruecolor($newWidth, $newHeight);
    
    // Redimensionar la imagen original a la nueva imagen
    imagecopyresampled($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

    // Guardar la imagen redimensionada
    switch ($type) {
        case IMAGETYPE_JPEG:
            imagejpeg($thumb, $destination);
            break;
        case IMAGETYPE_PNG:
            imagepng($thumb, $destination);
            break;
    }

    imagedestroy($image);
    imagedestroy($thumb);
    return true;
}


// Verifica si se ha enviado un archivo mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    $nombreOriginal = $_FILES['image']['name']; // Obtiene el nombre del archivo
    $rutaOriginal = $uploadDir . $nombreOriginal; // Ruta de destino para la imagen original
    $rutaMiniatura = $thumbDir . "thumb_" . $nombreOriginal; // Ruta de destino para la miniatura

    // Mueve el archivo subido al directorio de imágenes
    if (move_uploaded_file($_FILES['image']['tmp_name'], $rutaOriginal)) {
        // Llama a la función para redimensionar la imagen y crear una miniatura
        resizeImage($rutaOriginal, $rutaMiniatura, 200, 200);
        
        // Muestra un mensaje de éxito y la miniatura generada
        echo "<h3>Imagen subida y redimensionada con éxito.</h3>";
        echo "<img src='$rutaMiniatura'>";
    } else {
        echo "<h3>Error al subir la imagen.</h3>";
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
    <form action="Ejemplo_4.php" method="POST" enctype="multipart/form-data">
        <label for="file">Selecciona una imagen:</label>
        <input type="file" name="image" accept="image/jpeg, image/png" required>
        <button type="submit">Subir</button>
    </form>
</body>
</html>
