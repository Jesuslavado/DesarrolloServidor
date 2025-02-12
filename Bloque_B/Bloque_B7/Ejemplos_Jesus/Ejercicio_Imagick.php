<?php 
// VARIABLES PARA ALMACENAR INFORMACIÓN
$mensaje = "";
$error = "";
$mover = false;

// RUTA PARA SUBIDA DE ARCHIVOS
$ruta = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;

// RUTA DE MINIATURAS
$ruta_miniaturas = $ruta . 'thumbs' . DIRECTORY_SEPARATOR;

// TAMAÑO MÁXIMO DE LA IMAGEN (5MB)
$tamano = 5242880;

// TIPOS MIME PERMITIDOS
$tipos_permitidos = ["image/jpeg", "image/png", "image/jpg"];

// EXTENSIONES PERMITIDAS
$extensiones_permitidas = ["jpeg", "jpg", "png"];

// FUNCION PARA CREAR UNA MINIATURA DE LA IMAGEN
function crear_miniatura($ruta, $ruta_miniatura) {
    $imagen = new Imagick($ruta);
    $imagen->thumbnailImage(200, 200, true);  // Redimensiona la imagen
    $imagen->writeImage($ruta_miniatura);     // Guarda la miniatura
    return true;
}

// FUNCION PARA CREAR UN NOMBRE DE ARCHIVO ÚNICO
function crear_nombre_archivo($nombre_archivo, $ruta) {
    $nombre_base = pathinfo($nombre_archivo, PATHINFO_FILENAME);
    $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

    // Limpiar caracteres no alfanuméricos y reemplazarlos por guiones
    $nombre_base = preg_replace('/[^A-Za-z0-9]/', '-', $nombre_base);
    $i = 0;

    // Verificar si ya existe un archivo con el mismo nombre
    while (file_exists($ruta . $nombre_archivo)) {
        $i++;
        $nombre_archivo = $nombre_base . $i . '.' . $extension;
    }

    return $nombre_archivo;
}

// PROCESAR EL FORMULARIO
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $error = ($_FILES["image"]["error"] === 1) ? "El archivo es demasiado grande." : "";

    if ($_FILES['image']['error'] == 0) {
        // Verificar el tamaño del archivo
        $error .= ($_FILES['image']['size'] <= $tamano) ? "" : "El archivo es demasiado grande.";

        // Verificar el tipo MIME del archivo
        $tipo = mime_content_type($_FILES['image']['tmp_name']);
        $error .= in_array($tipo, $tipos_permitidos) ? "" : "Tipo de archivo no permitido.";

        // Verificar la extensión del archivo
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $error .= in_array($ext, $extensiones_permitidas) ? '' : 'Extensión de archivo incorrecta';

        if (!$error) {
            // Crear un nombre de archivo único
            $nombre_archivo = crear_nombre_archivo($_FILES['image']['name'], $ruta);
            $destino = $ruta . $nombre_archivo;
            $ruta_miniatura = $ruta_miniaturas . 'thumb_' . $nombre_archivo;

            // Mover el archivo subido a la carpeta de destino
            $mover = move_uploaded_file($_FILES['image']['tmp_name'], $destino);

            // Crear la miniatura de la imagen
            $creada_miniatura = crear_miniatura($destino, $ruta_miniatura);
        }
    }

    // Si la imagen se movió y la miniatura se creó correctamente, mostrar el mensaje de éxito
    if ($mover === true && $creada_miniatura === true) {
        $mensaje = "Imagen cargada con éxito:<br><img src='uploads/thumbs/thumb_$nombre_archivo' width='200'>";
    } else {
        $mensaje = "<b>No se pudo cargar el archivo:</b> $error";
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
    <form action="Ejercicio_Imagick.php" method="POST" enctype="multipart/form-data">
        <label for="file">Selecciona una imagen:</label>
        <input type="file" name="image" accept="image/jpeg, image/png" required>
        <button type="submit">Subir</button>
    </form>

    <!-- Mostrar el mensaje si la imagen fue cargada con éxito o hubo un error -->
    <?php if (!empty($mensaje)): ?>
        <div class="mensaje">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>
</body>
</html>
