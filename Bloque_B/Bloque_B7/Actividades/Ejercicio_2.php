<?php
$mensaje = '';                             // Inicializar mensaje
$moved   = false;                          // Inicializar bandera de movido

$directorio_subida = 'uploads/';            // Directorio para subir archivos
$tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];  // Tipos MIME permitidos
$tamano_maximo = 5242880;                   // Tamaño máximo de archivo (5MB)

// Verificar si se envió el formulario mediante POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_FILES['imagen']['error'] === 0) {  // Sin errores en la carga del archivo
        // Verificar el tamaño del archivo
        if ($_FILES['imagen']['size'] > $tamano_maximo) {
            $mensaje = '<p>El archivo es demasiado grande. El tamaño máximo permitido es 5MB.</p>';
        } else {
            // Validar tipo MIME
            $tipo_archivo = mime_content_type($_FILES['imagen']['tmp_name']);
            if (!in_array($tipo_archivo, $tipos_permitidos)) {
                $mensaje = '<p>Tipo de archivo no permitido. Solo se permiten imágenes JPEG, PNG y GIF.</p>';
            } else {
                // Generar un nombre único para evitar sobrescribir
                $nombre_archivo = uniqid() . '-' . basename($_FILES['imagen']['name']);
                $ruta_archivo = $directorio_subida . $nombre_archivo;  // Ruta de destino

                // Mover el archivo al directorio de destino
                $moved = move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_archivo);
                
                // Verificar si el archivo se movió correctamente
                if ($moved) {
                    $mensaje = '<p>El archivo se ha subido correctamente:</p>';
                    $mensaje .= '<img src="' . $directorio_subida . $nombre_archivo . '" alt="Imagen subida" style="max-width:300px;">';
                } else {
                    $mensaje = '<p>No se pudo guardar el archivo. Por favor, verifica los permisos del servidor.</p>';
                }
            }
        }
    } else {
        // Manejar errores de carga de archivo
        $mensaje = '<p>Error en la carga del archivo. Código de error: ' . $_FILES['imagen']['error'] . '</p>';
    }
}
?>

<?php include 'includes/header.php'; ?>

<h1>Subir una Imagen de Perfil</h1>

<!-- Mensaje para el usuario -->
<?= $mensaje ?>

<!-- Formulario para subir imágenes -->
<form method="POST" action="Ejercicio_2.php" enctype="multipart/form-data">
    <label for="imagen"><b>Selecciona una imagen:</b></label><br>
    <input type="file" name="imagen" accept="image/*" id="imagen" required><br><br>
    <input type="submit" value="Subir imagen">
</form>

<?php include 'includes/footer.php'; ?>
