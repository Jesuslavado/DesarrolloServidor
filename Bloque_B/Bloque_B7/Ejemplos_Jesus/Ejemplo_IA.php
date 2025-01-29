<?php
// Inicializamos variables para almacenar mensajes y el estado de la subida
$mensaje = ''; // Mensaje que se mostrará al usuario
$movido = false; // Indica si la imagen se movió correctamente
$error = ''; // Almacena errores de validación

// Ruta donde se guardarán las imágenes subidas
$ruta_subida = 'uploads/';

// Tamaño máximo permitido para la imagen (5MB)
$tamano_maximo = 5242880; // 5MB en bytes

// Tipos de medios permitidos (MIME types)
$tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];

// Extensiones de archivo permitidas
$extensiones_permitidas = ['jpeg', 'jpg', 'png', 'gif'];

// Función para crear un nombre de archivo único y limpio
function crear_nombre_archivo($nombre_archivo, $ruta_subida) {
    // Obtenemos el nombre base y la extensión del archivo
    $nombre_base = pathinfo($nombre_archivo, PATHINFO_FILENAME);
    $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

    // Limpiamos el nombre base, reemplazando caracteres no permitidos con guiones
    $nombre_base = preg_replace('/[^A-Za-z0-9]/', '-', $nombre_base);

    // Inicializamos un contador para evitar nombres duplicados
    $i = 0;

    // Verificamos si ya existe un archivo con el mismo nombre
    while (file_exists($ruta_subida . $nombre_archivo)) {
        $i++; // Incrementamos el contador
        $nombre_archivo = $nombre_base . $i . '.' . $extension; // Creamos un nuevo nombre de archivo
    }

    return $nombre_archivo; // Devolvemos el nombre único
}

// Verificamos si el formulario se envió mediante POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificamos si hubo un error al subir la imagen (código de error 1 significa que el archivo es demasiado grande)
    $error = ($_FILES['imagen']['error'] == 1) ? 'El archivo es demasiado grande. ' : '';

    // Si no hubo errores al subir la imagen
    if ($_FILES['imagen']['error'] === 0) {
        // Verificamos el tamaño del archivo
        $error .= ($_FILES['imagen']['size'] <= $tamano_maximo) ? '' : 'El archivo es demasiado grande. ';

        // Obtenemos el tipo de medio del archivo subido
        $tipo = mime_content_type($_FILES['imagen']['tmp_name']);

        // Verificamos si el tipo de medio está permitido
        $error .= in_array($tipo, $tipos_permitidos) ? '' : 'Tipo de archivo no permitido. ';

        // Convertimos el nombre del archivo a minúsculas y obtenemos la extensión
        $nombre_archivo = strtolower($_FILES['imagen']['name']);
        $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

        // Verificamos si la extensión del archivo está permitida
        $error .= in_array($ext, $extensiones_permitidas) ? '' : 'Extensión de archivo no permitida. ';

        // Si no hay errores, procedemos a mover y redimensionar la imagen
        if (!$error) {
            // Creamos un nombre de archivo único y limpio
            $nombre_archivo = crear_nombre_archivo($_FILES['imagen']['name'], $ruta_subida);

            // Ruta completa donde se guardará la imagen
            $destino = $ruta_subida . $nombre_archivo;

            // Movemos el archivo desde la ubicación temporal a la carpeta de destino
            $movido = move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);

            // Si el archivo se movió correctamente, redimensionamos la imagen
            if ($movido === true) {
                // Ruta donde se guardará la miniatura
                $ruta_miniatura = $ruta_subida . 'thumb_' . $nombre_archivo;

                // Llamamos a la función para redimensionar la imagen
                $redimensionado = redimensionar_imagen_gd($destino, $ruta_miniatura, 200, 200);

                // Mostramos un mensaje de éxito con la imagen subida y la miniatura
                $mensaje = 'Archivo subido y redimensionado con éxito:<br>';
                $mensaje .= '<img src="' . $destino . '" alt="Imagen original"><br>';
                $mensaje .= '<img src="' . $ruta_miniatura . '" alt="Miniatura">';
            } else {
                // Si no se pudo mover el archivo, mostramos un mensaje de error
                $mensaje = 'No se pudo guardar el archivo.';
            }
        } else {
            // Si hubo errores de validación, los mostramos
            $mensaje = 'Error: ' . $error;
        }
    } else {
        // Si hubo un error al subir el archivo, mostramos un mensaje de error
        $mensaje = 'Hubo un error al subir el archivo.';
    }
}

// Función para redimensionar una imagen usando GD
function redimensionar_imagen_gd($ruta_original, $ruta_nueva, $ancho_maximo, $alto_maximo) {
    // Obtenemos las dimensiones y el tipo de medio de la imagen original
    list($ancho_original, $alto_original, $tipo) = getimagesize($ruta_original);

    // Calculamos la proporción de la imagen original
    $proporcion_original = $ancho_original / $alto_original;

    // Calculamos las nuevas dimensiones manteniendo la proporción
    if ($ancho_original > $alto_original) {
        // Imagen apaisada
        $nuevo_ancho = $ancho_maximo;
        $nuevo_alto = $ancho_maximo / $proporcion_original;
    } else {
        // Imagen vertical o cuadrada
        $nuevo_alto = $alto_maximo;
        $nuevo_ancho = $alto_maximo * $proporcion_original;
    }

    // Redondeamos los valores a enteros
    $nuevo_ancho = intval($nuevo_ancho); // Convertir a entero
    $nuevo_alto = intval($nuevo_alto);   // Convertir a entero

    // Creamos una nueva imagen en blanco con las dimensiones calculadas
    $nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);

    // Abrimos la imagen original según su tipo de medio
    switch ($tipo) {
        case IMAGETYPE_JPEG:
            $original = imagecreatefromjpeg($ruta_original);
            break;
        case IMAGETYPE_PNG:
            $original = imagecreatefrompng($ruta_original);
            break;
        case IMAGETYPE_GIF:
            $original = imagecreatefromgif($ruta_original);
            break;
        default:
            return false; // Si no es un tipo de imagen soportado, devolvemos false
    }

    // Redimensionamos la imagen original y la copiamos en la nueva imagen
    imagecopyresampled($nueva, $original, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);

    // Guardamos la nueva imagen según su tipo de medio
    switch ($tipo) {
        case IMAGETYPE_JPEG:
            imagejpeg($nueva, $ruta_nueva);
            break;
        case IMAGETYPE_PNG:
            imagepng($nueva, $ruta_nueva);
            break;
        case IMAGETYPE_GIF:
            imagegif($nueva, $ruta_nueva);
            break;
    }

    // Liberamos la memoria
    imagedestroy($nueva);
    imagedestroy($original);

    return true; // Devolvemos true si todo fue bien
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir y Redimensionar Imágenes</title>
</head>
<body>
    <h1>Subir y Redimensionar Imágenes</h1>
    <?php if ($mensaje): ?>
        <p><?= $mensaje ?></p>
    <?php endif; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="imagen">Selecciona una imagen:</label>
        <input type="file" name="imagen" id="imagen" accept="image/*">
        <input type="submit" value="Subir">
    </form>
</body>
</html>
