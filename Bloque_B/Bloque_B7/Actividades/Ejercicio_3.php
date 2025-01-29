<?php
$moved         = false;                                        // Inicializamos variables
$message       = '';                                           // Inicializamos mensaje
$error         = '';                                           // Inicializamos errores
$upload_path   = 'uploads/';                                   // Ruta de subida
$max_size      = 5242880;                                      // Tamaño máximo de archivo (5 MB)
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];     // Tipos MIME permitidos
$allowed_exts  = ['jpeg', 'jpg', 'png', 'gif'];                // Extensiones permitidas

// Función para limpiar nombres de archivo y evitar sobreescrituras
function create_filename($filename, $upload_path) {
    $basename   = pathinfo($filename, PATHINFO_FILENAME);      // Obtenemos el nombre base
    $extension  = pathinfo($filename, PATHINFO_EXTENSION);     // Obtenemos la extensión
    $basename   = preg_replace('/[^A-z0-9]/', '-', $basename); // Limpiamos caracteres especiales
    $filename   = $basename . '.' . $extension;                // Reconstruimos el nombre limpio
    $i          = 0;                                           // Contador para evitar duplicados
    while (file_exists($upload_path . $filename)) {            // Si el archivo ya existe
        $i++;                                                  // Incrementamos el contador
        $filename = $basename . $i . '.' . $extension;         // Generamos un nuevo nombre
    }
    return $filename;                                          // Retornamos el nombre único
}

// Función para recortar y redimensionar imágenes
function crop_and_resize_image_gd($orig_path, $new_path, $new_width, $new_height) {
    $image_data  = getimagesize($orig_path);                       // Obtenemos datos de la imagen
    $orig_width  = $image_data[0];                                 // Ancho original
    $orig_height = $image_data[1];                                 // Alto original
    $media_type  = $image_data['mime'];                            // Tipo MIME
    $orig_ratio  = $orig_width / $orig_height;                     // Relación de aspecto original
    $new_ratio   = $new_width / $new_height;                       // Relación de aspecto deseada

    // Calculamos las dimensiones para el recorte
    if ($new_ratio < $orig_ratio) {
        $select_width  = $orig_height * $new_ratio;                // Nuevo ancho
        $select_height = $orig_height;                             // El alto se mantiene igual
        $x_offset      = ($orig_width - $select_width) / 2;        // Desplazamiento en X
        $y_offset      = 0;                                        // Sin desplazamiento en Y
    } else {
        $select_width  = $orig_width;                              // El ancho se mantiene igual
        $select_height = $orig_width / $new_ratio;                 // Nuevo alto
        $x_offset      = 0;                                        // Sin desplazamiento en X
        $y_offset      = ($orig_height - $select_height) / 2;      // Desplazamiento en Y
    }

    // Creamos la imagen base dependiendo del tipo
    switch($media_type) {
        case 'image/gif':
            $orig = imagecreatefromgif($orig_path);
            break;
        case 'image/jpeg':
            $orig = imagecreatefromjpeg($orig_path);
            break;
        case 'image/png':
            $orig = imagecreatefrompng($orig_path);
            break;
    }

    $new = imagecreatetruecolor($new_width, $new_height);          // Nueva imagen vacía
    imagecopyresampled($new, $orig, 0, 0, $x_offset, $y_offset, $new_width, 
                       $new_height, $select_width, $select_height); // Redimensionamos

    // Guardamos la imagen en el formato correcto
    switch($media_type) {
        case 'image/gif':  $result = imagegif($new, $new_path);  break;
        case 'image/jpeg': $result = imagejpeg($new, $new_path); break;
        case 'image/png':  $result = imagepng($new, $new_path);  break;
    }
    return $result;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                    // Si se envió el formulario
    $error = ($_FILES['image']['error'] === 1) ? 'Archivo demasiado grande ' : ''; // Error de tamaño

    if ($_FILES['image']['error'] == 0) {                      // Si no hubo errores de subida
        $error  .= ($_FILES['image']['size'] <= $max_size) ? '' : 'Archivo excede el tamaño permitido '; // Tamaño
        $type   = mime_content_type($_FILES['image']['tmp_name']);  // Tipo MIME
        $error .= in_array($type, $allowed_types) ? '' : 'Tipo de archivo no permitido '; // Tipo permitido
        $ext    = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)); // Extensión
        $error .= in_array($ext, $allowed_exts) ? '' : 'Extensión de archivo no permitida '; // Extensión permitida

        if (!$error) {  // Si no hay errores, generamos el nombre único y movemos el archivo
            $filename    = create_filename($_FILES['image']['name'], $upload_path);
            $destination = $upload_path . $filename;
            $thumbpath   = $upload_path . 'thumb_' . $filename;
            $moved       = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            $resized     = crop_and_resize_image_gd($destination, $thumbpath, 200, 200);
        }
    }
    if ($moved === true && $resized === true) {                        // Si se movió exitosamente
        $message = '<img src="' . $thumbpath . '">';                   // Mostramos la miniatura
    } else {
        $message = '<b>No se pudo subir el archivo:</b> ' . $error;    // Mostramos errores
    }
}
?>
<?php include 'includes/header.php' ?>
<?= $message ?>
  <form method="POST" action="Ejercicio_3.php" enctype="multipart/form-data">
    <label for="image"><b>Subir archivo:</b></label>
    <input type="file" name="image" accept="image/*" id="image"><br>
    <input type="submit" value="Subir">
  </form>
<?php include 'includes/footer.php' ?>
