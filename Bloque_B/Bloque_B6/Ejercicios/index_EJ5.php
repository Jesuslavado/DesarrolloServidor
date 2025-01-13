<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escapando Contenido</title>
</head>
<body>
    <h1>Enlace para probar XSS</h1>
    <!-- Enlace con un mensaje potencialmente malicioso -->
    <a href="xss.php?msg=<script src='js/bad.js'></script>">ESCAPING MARKUP</a>
</body>
</html>

<?php include 'includes/footer.php'; ?>
