<?php
// Variables a validar
$email = '';
$age = '';
$terms = 0;
$data = [];

// Validación de datos al enviar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener valores de las variables desde el formulario
    $email = $_POST['email'] ?? '';
    $age = $_POST['age'] ?? '';
    $terms = isset($_POST['terms']) ? 1 : 0;

    // Aplicar filtros a las variables
    $data['email'] = filter_var($email, FILTER_VALIDATE_EMAIL);
    $data['age'] = filter_var($age, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 16]
    ]);
    $data['terms'] = filter_var($terms, FILTER_VALIDATE_BOOLEAN);

    // Validar cada campo manualmente
    if ($data['email'] === false) {
        $data['errors']['email'] = 'El correo electrónico no es válido.';
    }
    if ($data['age'] === false) {
        $data['errors']['age'] = 'La edad debe ser un número entero mayor o igual a 16.';
    }
    if (!$data['terms']) {
        $data['errors']['terms'] = 'Debe aceptar los términos y condiciones.';
    }
}
?>
<?php include 'includes/header.php'; ?>

<form action="Ejercicio_15.php" method="POST">
  Email: <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"><br>
  Age: <input type="text" name="age" value="<?= htmlspecialchars($age) ?>"><br>
  I agree to the terms and conditions: <input type="checkbox" name="terms" value="1" <?= $terms ? 'checked' : '' ?>><br>
  <input type="submit" value="Save">
</form>

<pre>
<?php 
// Mostrar resultados de la validación
if (!empty($data['errors'])) {
    echo "Errores encontrados:\n";
    foreach ($data['errors'] as $field => $error) {
        echo ucfirst($field) . ": " . $error . "\n";
    }
} else {
    echo "Datos procesados correctamente:\n";
    var_dump($data);
}
?>
</pre>

<?php include 'includes/footer.php'; ?>
