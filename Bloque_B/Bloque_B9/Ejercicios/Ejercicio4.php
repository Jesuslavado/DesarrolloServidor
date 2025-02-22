<?php
include 'includes/sessions.php';

if ($logged_in) { // Si ya ha iniciado sesión
    header('Location: account.php'); // Redirigir a la cuenta
    exit; // Detener la ejecución
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Si el formulario es enviado
    $user_email = $_POST['email']; // Obtener email ingresado
    $user_password = $_POST['password']; // Obtener contraseña ingresada

    if ($user_email == $email && $user_password == $password) { // Si los datos son correctos
        login(); // Iniciar sesión
        header('Location: account.php'); // Redirigir a la cuenta
        exit; // Detener la ejecución
    }
}
?>
<?php include 'includes/header-member.php'; ?>

<h1>Iniciar Sesión</h1>
<form method="POST" action="login.php">
    Correo electrónico: <input type="email" name="email" required><br>
    Contraseña: <input type="password" name="password" required><br>
    <input type="submit" value="Iniciar Sesión">
</form>

<?php include 'includes/footer.php'; ?>