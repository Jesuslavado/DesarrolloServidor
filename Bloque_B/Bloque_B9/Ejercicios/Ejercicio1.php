<?php
// Verificar si se ha enviado el formulario
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    setcookie('nombre_usuario', $nombre); // Guardar la cookie sin tiempo de expiración
} else {
    $nombre = $_COOKIE['nombre_usuario'] ?? null;
}
?>

<?php include 'includes/header.php'; ?>

<h1>Bienvenido</h1>

<?php if ($nombre): ?>
    <p>Bienvenido de nuevo, <strong><?= htmlspecialchars($nombre) ?></strong>!</p>
<?php else: ?>
    <form action="Ejercicio1.php" method="post">
        <label for="nombre">Introduce tu nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <button type="submit">Guardar</button>
    </form>
<?php endif; ?>

<p><a href="Ejercicio1.php">Actualizar la página</a> para ver los cambios.</p>

<?php include 'includes/footer.php'; ?>
