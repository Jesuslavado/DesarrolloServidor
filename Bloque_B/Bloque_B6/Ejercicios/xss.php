<?php 
// Función para escapar contenido HTML
function html_escape(string $string): string
{
    return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8', true);
}

// Obtener el parámetro 'msg' de la URL
$message = $_GET['msg'] ?? 'Haz clic en el enlace de arriba';

// Escapar los caracteres especiales para prevenir XSS
?>

<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de XSS</title>
</head>
<body>
    <h1>Ejemplo de XSS</h1>
    <p><?= html_escape($message) ?></p>
</body>
</html>

<?php include 'includes/footer.php'; ?>