<?php
// Inicializar valores predeterminados
$form = [
    'email' => '',
    'age' => '',
    'terms' => 0
];
$data = []; // Contendrá los datos validados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Configuración de filtros para validar los datos
    $filters = [
        'email' => FILTER_VALIDATE_EMAIL, // Validar email
        'age' => [
            'filter' => FILTER_VALIDATE_INT, // Validar como entero
            'options' => [
                'min_range' => 16, // Edad mínima
                'max_range' => 120 // Edad máxima
            ]
        ],
        'terms' => FILTER_VALIDATE_BOOLEAN // Validar como booleano
    ];

    // Capturar datos del formulario
    $form = filter_input_array(INPUT_POST); // Captura todos los datos enviados

    // Validar datos capturados
    $data = filter_var_array($form, $filters);
}
?>
<?php include 'includes/header.php'; ?>

<form action="Ejercicio_14.php" method="POST">
  <!-- Campo para email -->
  Email: <input type="text" name="email" value="<?= htmlspecialchars($form['email']) ?>"><br>
  
  <!-- Campo para edad -->
  Age: <input type="text" name="age" value="<?= htmlspecialchars($form['age']) ?>"><br>
  
  <!-- Checkbox para términos -->
  I agree to the terms and conditions: 
  <input type="checkbox" name="terms" value="1" <?= $form['terms'] ? 'checked' : '' ?>><br>
  
  <input type="submit" value="Save">
</form>

<pre>
<?php
// Mostrar los resultados validados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Comprobar errores en los datos validados
    if ($data['email'] === false) {
        echo "Email inválido.\n";
    }
    if ($data['age'] === false) {
        echo "Edad fuera del rango permitido (16-120).\n";
    }
    if ($data['terms'] === false) {
        echo "Debe aceptar los términos y condiciones.\n";
    }

    // Mostrar los datos validados
    echo "Datos validados:\n";
    var_dump($data);
}
?>
</pre>

<?php include 'includes/footer.php'; ?>
