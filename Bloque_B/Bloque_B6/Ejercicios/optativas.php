<?php
// Variables iniciales
$asignatura = '';
$mensaje = '';
$asignaturas = ['Matemáticas', 'Física', 'Historia', 'Arte'];  // Asignaturas disponibles

// Comprobar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $asignatura = $_POST['asignatura'] ?? '';  // Obtener la asignatura seleccionada
    // Validar si la asignatura seleccionada está dentro de las opciones
    $valid = in_array($asignatura, $asignaturas);
    // Mensaje de confirmación o error
    $mensaje = $valid ? 'Gracias por seleccionar una asignatura.' : 'Por favor, selecciona una asignatura.';
}
?>

<?php include 'includes/header.php'; ?>

<!-- Mostrar el mensaje -->
<p><?= $mensaje ?></p>

<!-- Formulario para seleccionar asignatura -->
<form action="optativas.php" method="POST">
  <p>Selecciona tu asignatura optativa:</p>
  
  <?php foreach ($asignaturas as $asignatura_opcion) { ?>
    <label>
      <?= $asignatura_opcion ?>
      <input type="radio" name="asignatura" value="<?= $asignatura_opcion ?>"
             <?= ($asignatura == $asignatura_opcion) ? 'checked' : '' ?>>
    </label><br>
  <?php } ?>
  
  <input type="submit" value="Enviar">
</form>

<?php include 'includes/footer.php'; ?>
