<?php
$idioma = $_COOKIE['idioma'] ?? null; // Obtener la preferencia de idioma
$opciones = ['es' => 'Español', 'en' => 'Inglés']; // Opciones disponibles

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idioma = $_POST['idioma']; // Obtener idioma seleccionado
    setcookie('idioma', $idioma, time() + 30 * 24 * 60 * 60, '/', '', false, true); // Guardar cookie por 30 días
}

$mensaje = $idioma === 'es' ? 'Bienvenido a nuestro sitio web' : 'Welcome to our website';
?>

<?php include 'includes/header.php'; ?>

<h1>Preferencias de idioma</h1>

<?php if ($idioma): ?>
    <p><?= htmlspecialchars($mensaje) ?></p>
<?php else: ?>
    <form method="POST" action="Ejercicio2.php">
        <label for="idioma">Selecciona tu idioma:</label>
        <select name="idioma" id="idioma">
            <option value="es">Español</option>
            <option value="en">Inglés</option>
        </select>
        <button type="submit">Guardar</button>
    </form>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>