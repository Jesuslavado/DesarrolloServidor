<?php 
// Mensaje inicial
$mensaje = ''; 

// Verificamos si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['documento']) && $_FILES['documento']['error'] === 0) {
        // Validamos que sea un archivo PDF
        $tipoArchivo = $_FILES['documento']['type'];
        $nombreArchivo = $_FILES['documento']['name'];
        
        if ($tipoArchivo === 'application/pdf') {
            // Movemos el archivo a una carpeta en el servidor
            $rutaDestino = 'subidas/' . $nombreArchivo;
            if (move_uploaded_file($_FILES['documento']['tmp_name'], $rutaDestino)) {
                $mensaje = "El archivo <b>$nombreArchivo</b> se subió correctamente.";
            } else {
                $mensaje = 'Hubo un problema al guardar el archivo en el servidor.';
            }
        } else {
            $mensaje = 'Solo se permiten archivos en formato PDF.';
        }
    } else {
        $mensaje = 'No se pudo subir el archivo. Por favor, inténtalo de nuevo.';
    }
}
?>

<?php include 'includes/header.php'; ?>

<h1>Subir un documento PDF</h1>
<!-- Mostramos el mensaje -->
<p><?= $mensaje ?></p>

<!-- Formulario para subir archivos -->
<form method="POST" action="" enctype="multipart/form-data">
    <label for="documento"><b>Selecciona un archivo PDF:</b></label><br>
    <input type="file" name="documento" accept="application/pdf" id="documento"><br><br>
    <input type="submit" value="Subir archivo">
</form>

<?php include 'includes/footer.php'; ?>
