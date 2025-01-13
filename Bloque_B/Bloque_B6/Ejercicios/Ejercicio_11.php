<?php 
// Capturar los datos del formulario utilizando filter_input_array
$form = filter_input_array(INPUT_POST, [
    'email' => FILTER_VALIDATE_EMAIL,
    'age' => [
        'filter' => FILTER_VALIDATE_INT,
        'options' => [
            'min_range' => 1,
            'max_range' => 120
        ]
    ],
    'newsletter' => FILTER_VALIDATE_BOOLEAN
]);

?>
<?php include 'includes/header.php'; ?>

<form action="Ejercicio_11.php" method="POST">
  <!-- Input para el correo electrónico -->
  Email: <input type="text" name="email" value=""><br>
  
  <!-- Input para la edad -->
  Edad: <input type="number" name="age" value=""><br>
  
  <!-- Checkbox para confirmar interés en boletines -->
  ¿Deseas recibir boletines? 
  <input type="checkbox" name="newsletter" value="true"><br>
  
  <input type="submit" value="Guardar"> Ejemplo: Funciones de filtro
</form>

<pre>
<?php
// Mostrar los resultados después del filtrado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($form) {
        echo "Formulario válido:\n";
        var_dump($form);
    } else {
        echo "Hubo un error con los datos ingresados.";
    }
}
?>
</pre>

<?php include 'includes/footer.php'; ?>
