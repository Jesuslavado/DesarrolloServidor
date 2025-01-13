<?php
// Inicializar valores predeterminados
$form = [
    'email' => '',
    'age' => '',
    'website' => '',
    'terms' => 0 // Checkbox no seleccionado por defecto
];

// Validar el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filters = [
        'email' => FILTER_VALIDATE_EMAIL, // Validar email
        'age' => [
            'filter' => FILTER_VALIDATE_INT, // Validar como entero
            'options' => [
                'min_range' => 18, // Edad mínima
                'max_range' => 65  // Edad máxima
            ]
        ],
        'website' => FILTER_VALIDATE_URL, // Validar URL
        'terms' => [
            'filter' => FILTER_VALIDATE_BOOLEAN, // Validar checkbox como booleano
            'flags' => FILTER_NULL_ON_FAILURE // Retornar NULL si no está presente
        ]
    ];

    // Validar los datos del formulario
    $form = filter_input_array(INPUT_POST, $filters);

    // Establecer un valor predeterminado para el checkbox si no está presente
    if ($form['terms'] === null) {
        $form['terms'] = false;
    }
}
?>
<?php include 'includes/header.php'; ?>

<form action="Ejercicio_13.php" method="POST">
  <!-- Campo de email -->
  Email: <input type="text" name="email" value="<?= htmlspecialchars($form['email']) ?>"><br>
  
  <!-- Campo de edad -->
  Edad (18-65): <input type="text" name="age" value="<?= htmlspecialchars($form['age']) ?>"><br>
  
  <!-- Campo de URL -->
  URL del sitio web: <input type="text" name="website" value="<?= htmlspecialchars($form['website']) ?>"><br>
  
  <!-- Checkbox de términos y condiciones -->
  Acepto los términos y condiciones: 
  <input type="checkbox" name="terms" value="1" <?= $form['terms'] ? 'checked' : '' ?>><br>
  
  <input type="submit" value="Guardar">
</form>

<pre>
<?php
// Mostrar los datos filtrados o errores
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($form['email'] === false) {
        echo "Email inválido.\n";
    }
    if ($form['age'] === false) {
        echo "Edad fuera del rango permitido (18-65).\n";
    }
    if ($form['website'] === false) {
        echo "URL inválida.\n";
    }
    if (!$form['terms']) {
        echo "Debe aceptar los términos y condiciones.\n";
    }
    echo "Datos recibidos y filtrados:\n";
    var_dump($form);
}
?>
</pre>

<?php include 'includes/footer.php'; ?>
