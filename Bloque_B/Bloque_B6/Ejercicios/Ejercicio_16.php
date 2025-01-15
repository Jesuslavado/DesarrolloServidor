<?php
// Inicializar variables
$user = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'message' => ''
];

// Verificar los datos enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user['name'] = $_POST['name'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['phone'] = $_POST['phone'] ?? '';
    $user['message'] = $_POST['message'] ?? '';

    // Filtros de limpieza
    $sanitize_user = [
        'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'email' => FILTER_SANITIZE_EMAIL,
        'phone' => FILTER_SANITIZE_NUMBER_INT,
        'message' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ];

    
    $user = filter_var_array($user, $sanitize_user);
}
?>

<?php include 'includes/header.php'; ?>

<h1>Formulario de Contacto</h1>
<form action="" method="post">
    <label for="name">Nombre:</label><br>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>

    <label for="email">Correo Electrónico:</label><br>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

    <label for="phone">Número de Teléfono:</label><br>
    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required><br><br>

    <label for="message">Mensaje:</label><br>
    <textarea id="message" name="message" rows="5" required><?= htmlspecialchars($user['message']) ?></textarea><br><br>

    <button type="submit">Enviar</button>
</form>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <h2>Datos Saneados</h2>
    <p><strong>Nombre:</strong> <?= $user['name'] ?></p>
    <p><strong>Correo Electrónico:</strong> <?= $user['email'] ?></p>
    <p><strong>Número de Teléfono:</strong> <?= $user['phone'] ?></p>
    <p><strong>Mensaje:</strong> <?= nl2br($user['message']) ?></p>
    <pre><?php var_dump($user); ?></pre>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
