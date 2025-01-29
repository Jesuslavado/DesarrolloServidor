<?php
// VARIABLES
$num1 = 0;
$num2 = 0;
$resultado = "";
$calculo = "";

// USO DEL GET
if (isset($_GET['num1']) && isset($_GET['num2']) && isset($_GET['calculo'])) {
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];
    $calculo = $_GET['calculo'];

    // VALIDACIÓN DE QUE LOS DATOS SEAN NÚMEROS Y NO ESTÉN VACÍOS
    if (is_numeric($num1) && is_numeric($num2) && !empty($num1) && !empty($num2)) {

        // SANEAMOS LOS DATOS PARA EVITAR VULNERABILIDADES DE XSS
        $num1_saneado = htmlspecialchars($num1);
        $num2_saneado = htmlspecialchars($num2);

        // VALIDACIÓN DE DIVISIÓN POR CERO
        if ($calculo == "division" && $num2 == 0) {
            $resultado = "No se puede dividir entre cero.";
        } else {
            // Realizamos el cálculo dependiendo de la operación seleccionada
            switch ($calculo) {
                case "suma":
                    $resultado = $num1 + $num2;
                    break;
                case "resta":
                    $resultado = $num1 - $num2;
                    break;
                case "multiplicacion":
                    $resultado = $num1 * $num2;
                    break;
                case "division":
                    $resultado = $num1 / $num2;
                    break;
            }
        }

        // Mostramos el resultado
        echo "<h1>Resultados</h1>";
        echo "<p>Operación: " . ucfirst($calculo) . "</p>";
        echo "<p>La operación es: $num1_saneado " . ucfirst($calculo) . " $num2_saneado = $resultado</p>";
    } else {
        echo "<p>Por favor, llena todos los campos del formulario y asegúrate de que los números sean válidos.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Básica</title>
</head>
<body>
    <h1>Calculadora</h1>
    <form method="GET" action="">
        <label for="num1">Número 1:</label>
        <input type="number" id="num1" name="num1" required>
        <br><br>

        <label for="num2">Número 2:</label>
        <input type="number" id="num2" name="num2" required>
        <br><br>

        <!-- CAMPO CALCULADORA -->
        <label for="calculo">Cálculo:</label>
        <select name="calculo" id="calculo" required>
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
        </select>
        <br><br>

        <button type="submit">Calcular</button>
    </form>
</body>
</html>
