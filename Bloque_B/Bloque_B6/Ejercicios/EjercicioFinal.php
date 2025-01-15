<?php
// INICIALIZACIÓN DE VARIABLES
$errores = [];
$datos = [
    'nombre' => '',
    'correo' => '',
    'telefono' => '',
    'tipo_evento' => '',
    'terminos' => ''
];

// PROCESAR LOS DATOS SOLO SI EL FORMULARIO FUE ENVIADO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // FILTRAR Y SANEAR LOS DATOS ENVIADOS
    $datos = filter_input_array(INPUT_POST, [
        'nombre' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, // SANEAMOS EL NOMBRE
        'correo' => FILTER_SANITIZE_EMAIL,             // SANEAMOS EL CORREO
        'telefono' => FILTER_SANITIZE_NUMBER_INT,      // SANEAMOS EL TELÉFONO
        'tipo_evento' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, // SANEAMOS EL TIPO DE EVENTO
        'terminos' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,    // SANEAMOS LA ACEPTACIÓN DE TÉRMINOS
    ]);

    // VALIDAR LOS CAMPOS
    if (empty($datos['nombre']) || strlen($datos['nombre']) < 2 || strlen($datos['nombre']) > 50) {
        $errores['nombre'] = 'El nombre es obligatorio, solo puede contener letras y debe tener entre 2 y 50 caracteres.';
    }

    if (!filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
        $errores['correo'] = 'El correo electrónico no es válido.';
    }

    if (empty($datos['telefono']) || strlen($datos['telefono']) < 9 || !ctype_digit($datos['telefono'])) {
        $errores['telefono'] = 'El número de teléfono es obligatorio, solo puede contener números y debe tener al menos 9 dígitos.';
    }

    if (!in_array($datos['tipo_evento'], ['Presencial', 'Online'])) {
        $errores['tipo_evento'] = 'Debe seleccionar un tipo de evento válido: Presencial u Online.';
    }

    if (empty($datos['terminos'])) {
        $errores['terminos'] = 'Debe aceptar los términos y condiciones.';
    }

    // SI NO HAY ERRORES, MOSTRAR MENSAJE
    if (empty($errores)) {
        echo '<p style="color: green;">Los datos han sido procesados correctamente</p>';
    }
}
?>

<?php include 'includes/header.php'; ?>
    <h1>Formulario de Registro de Evento</h1>
    <form action="" method="post">
        <!-- CAMPO NOMBRE -->
        <label for="nombre">Nombre completo:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($datos['nombre']) ?>" required>
        <span style="color: red;"><?= $errores['nombre'] ?? '' ?></span><br><br>

        <!-- CAMPO CORREO -->
        <label for="correo">Correo electrónico:</label><br>
        <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($datos['correo']) ?>" required>
        <span style="color: red;"><?= $errores['correo'] ?? '' ?></span><br><br>

        <!-- CAMPO TELÉFONO -->
        <label for="telefono">Número de teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($datos['telefono']) ?>" required>
        <span style="color: red;"><?= $errores['telefono'] ?? '' ?></span><br><br>

        <!-- CAMPO TIPO DE EVENTO -->
        <label for="tipo_evento">Tipo de evento:</label><br>
        <select id="tipo_evento" name="tipo_evento" required>
            <option value="" <?= $datos['tipo_evento'] === '' ? 'selected' : '' ?>>Seleccione una opción</option>
            <option value="Presencial" <?= $datos['tipo_evento'] === 'Presencial' ? 'selected' : '' ?>>Presencial</option>
            <option value="Online" <?= $datos['tipo_evento'] === 'Online' ? 'selected' : '' ?>>Online</option>
        </select>
        <span style="color: red;"><?= $errores['tipo_evento'] ?? '' ?></span><br><br>

        <!-- CAMPO TÉRMINOS Y CONDICIONES -->
        <label>
            <input type="checkbox" name="terminos" value="1" <?= !empty($datos['terminos']) ? 'checked' : '' ?>> Acepto los términos y condiciones
        </label>
        <span style="color: red;"><?= $errores['terminos'] ?? '' ?></span><br><br>

        <!-- BOTÓN ENVIAR -->
        <button type="submit">Registrar</button>

        <!-- MOSTRAR DATOS PROCESADOS -->
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <pre><?php var_dump($datos); ?></pre>
        <?php endif; ?>
    </form>
    <?php include 'includes/footer.php'; ?>
