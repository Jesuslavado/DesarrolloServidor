<?php include 'includes/header.php'; ?>

<h1>Formulario de Registro de Jugador</h1>

<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $posicion = $_POST['posicion'] ?? '';

    // Mostrar un mensaje de confirmación
    echo "<h2>Gracias por registrarte, $nombre $apellido!</h2>";
    echo "<p>Edad: $edad</p>";
    echo "<p>Posición: $posicion</p>";
} else {
    // Si el formulario no ha sido enviado, mostrar el formulario
    echo '<form action="Ejercicio_7.php" method="POST">
            <p>Nombre: <input type="text" name="nombre" required></p>
            <p>Apellido: <input type="text" name="apellido" required></p>
            <p>Edad: <input type="number" name="edad" required></p>
            <p>Posición: 
                <select name="posicion" required>
                    <option value="Delantero">Delantero</option>
                    <option value="Centrocampista">Centrocampista</option>
                    <option value="Defensa">Defensa</option>
                    <option value="Portero">Portero</option>
                </select>
            </p>
            <p><input type="submit" value="Registrar"></p>
          </form>';
}

?>

<?php include 'includes/footer.php'; ?>
