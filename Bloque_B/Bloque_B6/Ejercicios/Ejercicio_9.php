<?php
// Variables iniciales
$eventos_seleccionados = [];
$mensaje = '';
$eventos = ['Ceremonia de Apertura', 'Atletismo', 'Natación', 'Ciclismo', 'Ceremonia de Clausura']; // Lista de eventos disponibles

// Comprobar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los eventos seleccionados
    $eventos_seleccionados = $_POST['eventos'] ?? [];
    
    // Validar que al menos un evento haya sido seleccionado
    if (count($eventos_seleccionados) > 0) {
        $mensaje = '¡Gracias por inscribirte! Te has registrado en los siguientes eventos: ' . implode(', ', $eventos_seleccionados);
    } else {
        $mensaje = 'Debes seleccionar al menos un evento para participar.';
    }
}
?>

<?php include 'includes/header.php'; ?>

<!-- Mostrar mensaje de confirmación o error -->
<p><?= $mensaje ?></p>

<!-- Formulario de inscripción -->
<form action="Ejercicio_9.php" method="POST">
  <p>Selecciona los eventos en los que deseas participar:</p>
  
  <?php foreach ($eventos as $evento) { ?>
    <label>
      <input type="checkbox" name="eventos[]" value="<?= htmlspecialchars($evento) ?>"
        <?= in_array($evento, $eventos_seleccionados) ? 'checked' : '' ?>>
      <?= htmlspecialchars($evento) ?>
    </label><br>
  <?php } ?>
  
  <input type="submit" value="Inscribirse">
</form>

<?php include 'includes/footer.php'; ?>
