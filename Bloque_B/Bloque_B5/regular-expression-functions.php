<?php
include 'includes/header.php';

// Definir el array de datos
$data = [
    "john.doe@example.com",
    "jane-doe@website.org",
    "invalid-email@com",
    "123-456-7890",
    "987.654.3210",
    "http://www.example.com",
    "https://site.org/path?query=string",
    "not-a-url"
];

// Validar correos electrónicos
function validarCorreos($data) {
    echo "<h3>Validando correos electrónicos:</h3>";
    $emailRegex = '/^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/';
    foreach ($data as $item) {
        if (preg_match($emailRegex, $item)) {
            echo "$item es un correo electrónico válido.<br>";
        } else {
            echo "$item NO es un correo electrónico válido.<br>";
        }
    }
    echo "<br>";
}

// Extraer números de teléfono
function extraerTelefonos($data) {
    echo "<h3>Extrayendo números de teléfono:</h3>";
    $phoneRegex = '/\b\d{3}[-.]\d{3}[-.]\d{4}\b/';
    foreach ($data as $item) {
        if (preg_match($phoneRegex, $item)) {
            echo "Número de teléfono encontrado: $item<br>";
        }
    }
    echo "<br>";
}

// Dividir una URL en sus componentes
function dividirURLs($data) {
    echo "<h3>Dividiendo URLs:</h3>";
    $urlRegex = '/^(https?):\/\/(www\.[^\/]+)(.*)$/';
    foreach ($data as $item) {
        if (preg_match($urlRegex, $item, $matches)) {
            echo "URL: $item<br>";
            echo "Protocolo: $matches[1]<br>";
            echo "Dominio: $matches[2]<br>";
            echo "Ruta: $matches[3]<br><br>";
        }
    }
    echo "<br>";
}

// Limpiar correos electrónicos inválidos
function limpiarCorreosInvalidos(&$data) {
    echo "<h3>Limpiando correos electrónicos inválidos:</h3>";
    $emailRegex = '/^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/';
    foreach ($data as &$item) {
        if (!preg_match($emailRegex, $item)) {
            echo "$item NO es un correo electrónico válido. Eliminando...<br>";
            $item = ""; // Reemplaza los correos inválidos con una cadena vacía
        }
    }
    echo "<br>";
}

// Ejecutar las funciones
validarCorreos($data);
extraerTelefonos($data);
dividirURLs($data);
limpiarCorreosInvalidos($data);

// Mostrar datos finales después de limpieza
echo "<h3>Datos finales:</h3>";
foreach ($data as $item) {
    if ($item !== "") {
        echo "$item<br>";
    }
}

include 'includes/footer.php';
?>
