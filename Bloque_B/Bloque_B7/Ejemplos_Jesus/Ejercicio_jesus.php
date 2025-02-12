<?php
// INICIALIZACIÓN DE VARIABLES
$mensaje = "";
$error = "";

// TAMAÑO MÁXIMO DE LA IMAGEN (5MB)
$tamano = 5242880;

// TIPOS DE ARCHIVOS PERMITIDOS
$imagenes_permitidas = ["image/jpeg", "image/png"];
$ext_permitidas = ["jpg", "jpeg", "png"];

// RUTA DE SUBIDA
$ruta_subida = "uploads/";
$ruta_thumbs = "uploads/thumbs/";

// FUNCIÓN PARA GENERAR NOMBRES ÚNICOS
function crear_nombre_archivo($nombre_archivo, $ruta_subida) {
    $nombre_base = pathinfo($nombre_archivo, PATHINFO_FILENAME);
    $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
    $nombre_base = preg_replace('/[^A-Za-z0-9]/', '-', $nombre_base);

    $i = 0;
    $nuevo_nombre = $nombre_base . '.' . $extension;
    while (file_exists($ruta_subida . $nuevo_nombre)) {
        $i++;
        $nuevo_nombre = $nombre_base . $i . '.' . $extension;
    }
    return $nuevo_nombre;
}

// FUNCIÓN PARA REDIMENSIONAR IMAGEN (GD)
function redimensionar_imagen_gd($ruta, $ruta_miniatura, $nuevo_ancho, $nuevo_alto) {
    list($ancho, $alto, $tipo) = getimagesize($ruta);
    switch ($tipo) {
        case IMAGETYPE_JPEG:
            $imagen_origen = imagecreatefromjpeg($ruta);
            break;
        case IMAGETYPE_PNG:
            $imagen_origen = imagecreatefrompng($ruta);
            break;
        default:
            return false;
    }

    $miniatura = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    imagecopyresampled($miniatura, $imagen_origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

    switch ($tipo) {
        case IMAGETYPE_JPEG:
            imagejpeg($miniatura, $ruta_miniatura, 90);
            break;
        case IMAGETYPE_PNG:
            imagepng($miniatura, $ruta_miniatura);
            break;
    }

    imagedestroy($imagen_origen);
    imagedestroy($miniatura);
    return true;
}

// PROCESAMIENTO DEL FORMULARIO
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_FILES["imagen"]["error"] === 0) {
        $error .= ($_FILES['imagen']['size'] <= $tamano) ? '' : 'El archivo es demasiado grande. ';

        $tipo = mime_content_type($_FILES['imagen']['tmp_name']);
        $error .= in_array($tipo, $imagenes_permitidas) ? '' : 'Tipo de archivo no permitido. ';

        $nombre_archivo = strtolower($_FILES['imagen']['name']);
        $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
        $error .= in_array($ext, $ext_permitidas) ? '' : 'Extensión de archivo no permitida. ';

        if (!$error) {
            $nombre_archivo = crear_nombre_archivo($_FILES['imagen']['name'], $ruta_subida);
            $destino = $ruta_subida . $nombre_archivo;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
                $ruta_miniatura = $ruta_thumbs . 'thumb_' . $nombre_archivo;

                if (!is_dir($ruta_thumbs)) {
                    mkdir($ruta_thumbs, 0777, true);
                }

                redimensionar_imagen_gd($destino, $ruta_miniatura, 200, 200);

                $mensaje = "Archivo subido y redimensionado con éxito.";
            } else {
                $mensaje = "No se pudo guardar el archivo.";
            }
        } else {
            $mensaje = "Error: " . $error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Imagen</title>
</head>
<body>
    <h1>Subir Imagen</h1>

    <?php if (!empty($mensaje)): ?>
        <p><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <input type="file" name="imagen" accept="image/*" required>
        <button type="submit">Subir Imagen</button>
    </form>

    <?php if (isset($destino) && file_exists($destino)): ?>
        <h2>Imagen Subida</h2>
        <img src="<?= $destino ?>" width="300" alt="Imagen original"><br>
        <img src="<?= $ruta_miniatura ?>" width="200" alt="Miniatura">
    <?php endif; ?>
</body>
</html>
