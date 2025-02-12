<?php
$moved         = false;  // Inicializar variable para verificar si el archivo se movió correctamente
$message       = '';     // Mensaje para mostrar en caso de éxito o error
$error         = '';     // Errores de carga si los hay
$upload_path   = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;  // Ruta para la carga de imágenes
$max_size      = 5242880;  // Tamaño máximo de archivo (5MB)
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];  // Tipos MIME permitidos
$allowed_exts  = ['jpeg', 'jpg', 'png', 'gif'];  // Extensiones de archivo permitidas

// Función para crear una miniatura de la imagen cargada
function create_thumbnail($source, $thumbpath) {
    $image = new Imagick($source);  // Crear objeto Imagick para la imagen
    $image->thumbnailImage(200, 200, true);  // Redimensiona la imagen a 200x200 píxeles
    $image->writeImage($thumbpath);  // Guardar la miniatura
    return true;
}

// Función para crear un nombre de archivo único
function create_filename($filename, $upload_path) {
    $basename   = pathinfo($filename, PATHINFO_FILENAME);  // Obtener el nombre base del archivo
    $extension  = pathinfo($filename, PATHINFO_EXTENSION); // Obtener la extensión del archivo
    $basename   = preg_replace('/[^A-z0-9]/', '-', $basename);  // Limpiar el nombre del archivo
    $filename   = $basename . '.' . $extension;  // Crear el nombre final del archivo
    $i          = 0;  // Contador para evitar sobrescribir archivos

    // Si el archivo ya existe, se agrega un número al final del nombre para hacerlo único
    while (file_exists($upload_path . $filename)) {
        $i++;
        $filename = $basename . $i . '.' . $extension;
    }
    return $filename;
}

// Procesar el formulario cuando es enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    // Verifica errores en la carga de archivos
    $error = ($_FILES['image']['error'] === 1) ? 'Archivo demasiado grande' : '';  

    if ($_FILES['image']['error'] == 0) { 
        // Verifica que el tamaño del archivo sea adecuado
        $error .= ($_FILES['image']['size'] <= $max_size) ? '' : 'Archivo demasiado grande';  
        
        // Verifica que el tipo MIME sea permitido
        $type = mime_content_type($_FILES['image']['tmp_name']);
        $error .= in_array($type, $allowed_types) ? '' : 'Tipo de archivo incorrecto';
        
        // Verifica que la extensión sea permitida
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $error .= in_array($ext, $allowed_exts) ? '' : 'Extensión de archivo incorrecta';

        if (!$error) {
            $filename    = create_filename($_FILES['image']['name'], $upload_path);  
            $destination = $upload_path . $filename; 
            $thumbpath   = $upload_path . 'thumb_' . $filename;  

            // Mueve el archivo a la carpeta de destino
            $moved = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            // Crea la miniatura de la imagen
            $resized = create_thumbnail($destination, $thumbpath);
        }
    }

    // Si la imagen se movió y se redimensionó correctamente, mostrar la miniatura
    if ($moved === true and $resized === true) {
        $message = 'Imagen cargada con éxito:<br><img src="uploads/thumb_' . $filename . '">';  
    } else {
        $message = '<b>No se pudo cargar el archivo:</b> ' . $error;  
    }
}
?>

<?php include 'includes/header.php'; ?>  

<?= $message ?>  

<!-- Formulario de carga de archivos -->
<form method="POST" action="Ejercicio_5.php" enctype="multipart/form-data">
    <label for="image"><b>Cargar archivo:</b></label>
    <input type="file" name="image" id="image"><br>
    <input type="submit" value="Subir">
</form>

<?php include 'includes/footer.php'; ?>  
