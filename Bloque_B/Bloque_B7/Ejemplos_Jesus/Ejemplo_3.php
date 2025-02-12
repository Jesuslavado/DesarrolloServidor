<?php

// Definir el directorio de destino para subir los archivos
$uploadDir = "uploads/";

// Verificar si el directorio de subida no existe, si no lo crea
if (!file_exists($uploadDir)) {
    // Crea el directorio de subidas con permisos 0777 (lectura, escritura y ejecución para todos)
    mkdir($uploadDir, 0777, true);
}

// Función para limpiar el nombre del archivo y evitar caracteres especiales
function limpiarNombre($nombre) {
    // Utiliza una expresión regular para reemplazar cualquier carácter que no sea alfanumérico por guiones
    return preg_replace("/[^A-Za-z0-9]/", "-", pathinfo($nombre, PATHINFO_FILENAME));
}

// Verificar si se ha enviado un formulario con una imagen
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    // Obtener el nombre temporal del archivo subido
    $archivoTemporal = $_FILES['image']['tmp_name'];

    // Limpiar el nombre del archivo para evitar caracteres problemáticos
    $nombreBase = limpiarNombre($_FILES['image']['name']);

    // Obtener la extensión del archivo y convertirla a minúsculas
    $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    // Crear un nombre único para el archivo con base en el nombre original y el tiempo actual
    $nombreArchivo = $nombreBase . "_" . time() . "." . $extension;

    // Definir la ruta completa de destino donde se guardará el archivo
    $rutaDestino = $uploadDir . $nombreArchivo;

    // Intentar mover el archivo desde la ubicación temporal a la carpeta de destino
    if (move_uploaded_file($archivoTemporal, $rutaDestino)) {
        // Si la subida fue exitosa, mostrar un mensaje y mostrar la imagen
        echo "<h3>Imagen subida correctamente.</h3>";
        echo "<img src='$rutaDestino' width='200'>";  // Muestra la imagen subida con un tamaño de 200px de ancho
    } else {
        // Si ocurrió un error, mostrar un mensaje de error
        echo "<h3>Error al mover la imagen.</h3>";
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
    <form action="Ejemplo_3.php" method="POST" enctype="multipart/form-data">
        <!-- Campo para seleccionar el archivo, solo imágenes JPG y PNG -->
        <label for="file">Selecciona una imagen:</label>
        <input type="file" name="image" accept="image/jpeg, image/png" required>
        <!-- Botón para enviar el formulario -->
        <button type="submit">Subir</button>
    </form>
</body>
</html>
