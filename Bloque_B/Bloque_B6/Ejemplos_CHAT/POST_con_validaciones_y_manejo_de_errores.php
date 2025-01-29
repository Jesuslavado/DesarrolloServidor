<?php
// Verificamos si los datos se enviaron correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['edad'])) {
        // Saneamos y validamos los datos según corresponda
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING); // Elimina caracteres HTML y especiales
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Sanea todos los caracteres especiales
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanea la dirección de correo
        $edad = filter_var($_POST['edad'], FILTER_SANITIZE_NUMBER_INT); // Solo permite números enteros
        
        // Validaciones adicionales
        if (empty($username)) {
            echo "<p>Error: El nombre de usuario no puede estar vacío.</p>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p>Error: El correo electrónico no es válido.</p>";
        } elseif ($edad < 18 || $edad > 100) {
            echo "<p>Error: La edad debe estar entre 18 y 100 años.</p>";
        } elseif (empty($password)) {
            echo "<p>Error: La contraseña no puede estar vacía.</p>";
        } else {
            // Datos válidos y saneados
            $password_oculto = str_repeat('*', strlen($password)); // Nunca mostramos la contraseña
            echo "<h1>Registro completado</h1>";
            echo "<p>Bienvenido, $username.</p>";
            echo "<p>Correo electrónico: $email.</p>";
            echo "<p>Edad: $edad años.</p>";
            echo "<p>Tu contraseña ha sido almacenada de manera segura.</p>";
        }
    } else {
        echo "<p>Error: Faltan campos por completar en el formulario.</p>";
    }
} else {
    echo "<p>Acceso no permitido. Usa el formulario para enviar los datos.</p>";
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Filtros</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form method="POST" action="">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required>
        <br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required>
        <br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>

