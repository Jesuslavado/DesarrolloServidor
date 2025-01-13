<?php
declare(strict_types = 1);

$edad     = '';
$mensaje = '';

// Función para comprobar si el número está en el rango especificado
function es_numero($numero, int $min = 8, int $max = 16): bool
{
    return ($numero >= $min && $numero <= $max);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $edad   = $_POST['age'];
    // Validar si la edad está en el rango de 8 a 16
    $valido = es_numero($edad, 8, 16);

    if ($valido) {
        $mensaje = 'Edad válida';
    } else {
        $mensaje = 'Debes tener entre 8 y 16 años.';
    }
}
?>

<?php include 'includes/header.php'; ?>

<!-- Mostrar el mensaje de validación -->
<p><?= $mensaje ?></p>

<!-- Formulario para ingresar la edad -->
<form action="Ejercicio_8.php" method="POST">
  Edad: <input type="text" name="age" size="4" value="<?= htmlspecialchars($edad) ?>"> 
  <input type="submit" value="Guardar">
</form>

<?php include 'includes/footer.php'; ?>
