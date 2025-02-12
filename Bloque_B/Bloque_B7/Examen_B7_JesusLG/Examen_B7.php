<?php
// VARIABLES
$primer_plato = [
    "nombre" => "",
    "descripcion" => "",
    "precio" => "",
    "bebida" => "",
    "imagen" => ""
];
$segundo_plato = [
    "nombre" => "",
    "descripcion" => "",
    "precio" => "",
    "imagen" => ""
];
$postre = [
    "nombre" => "",
    "descripcion" => "",
    "precio" => "",
    "imagen" => ""
];
$errores = [];
$mensaje = "";

// TIPO DE IMAGENES PERMITIDAS
$imagenes_permitidas = ["image/jpeg", "image/png"];
$ext_permitidas = ["png", "jpeg"];
// TAMAÑO MAXIMO DE LA IMAGEN DE 5MB
$tamano = 5242880;
// CARPETAS PARA GUARDAR LAS IMÁGENES
$ruta_subida = "imagenes/";
$ruta_miniaturas = "imagenes/miniaturas/";

// FUNCIÓN PARA REDIMENSIONAR IMAGEN (GD) (300x300)
function redimensionar_imagen($ruta, $ext, $ancho, $alto) {
    $imagen = imagecreatefromstring(file_get_contents($ruta));
    $ancho_destino = $ancho;
    $alto_destino = $alto;

    $thumb = imagecreatetruecolor($ancho_destino, $alto_destino);
    imagecopyresampled($thumb, $imagen, 0, 0, 0, 0, $ancho_destino, $alto_destino, imagesx($imagen), imagesy($imagen));

    switch ($ext) {
        case "png":
            imagepng($thumb, $ruta);
            break;
        case "jpeg":
            imagejpeg($thumb, $ruta);
            break;
    }

    imagedestroy($thumb);
    imagedestroy($imagen);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // SANEAMIENTO DE LOS DATOS
    $primer_plato["nombre"] = $_POST["nombre_primer"];
    $primer_plato["descripcion"] = $_POST["descripcion_primer"];
    $primer_plato["precio"] = $_POST["precio_primer"];
    $primer_plato["bebida"] = $_POST["bebida_primer"];

    $segundo_plato["nombre"] = $_POST["nombre_segundo"];
    $segundo_plato["descripcion"] = $_POST["descripcion_segundo"];
    $segundo_plato["precio"] = $_POST["precio_segundo"];

    $postre["nombre"] = $_POST["nombre_postre"];
    $postre["descripcion"] = $_POST["descripcion_postre"];
    $postre["precio"] = $_POST["precio_postre"];

    // VALIDACIÓN DE LOS DATOS DEL FORMULARIO
    // NOMBRE SOLO LETRAS Y ESPACIOS (1-20)
    if (empty($primer_plato['nombre']) || strlen($primer_plato['nombre']) < 1 || strlen($primer_plato['nombre']) > 20) {
        $errores['nombre_primer'] = 'El nombre del primer plato es obligatorio y debe tener entre 1 y 20 caracteres.';
    }
    if (empty($segundo_plato['nombre']) || strlen($segundo_plato['nombre']) < 1 || strlen($segundo_plato['nombre']) > 20) {
        $errores['nombre_segundo'] = 'El nombre del segundo plato es obligatorio y debe tener entre 1 y 20 caracteres.';
    }
    if (empty($postre['nombre']) || strlen($postre['nombre']) < 1 || strlen($postre['nombre']) > 20) {
        $errores['nombre_postre'] = 'El nombre del postre es obligatorio y debe tener entre 1 y 20 caracteres.';
    }

    // BEBIDA (SI/NO)
    if (!in_array($primer_plato['bebida'], ['Si', 'No'])) {
        $errores['bebida_primer'] = 'Debe seleccionar si incluye bebida: Si o No.';
    }

    // PRECIO (SOLO DIGITOS)
    if (empty($primer_plato['precio']) || !filter_var($primer_plato['precio'], FILTER_VALIDATE_FLOAT)) {
        $errores['precio_primer'] = 'El precio del primer plato debe ser un número válido.';
    }
    if (empty($segundo_plato['precio']) || !filter_var($segundo_plato['precio'], FILTER_VALIDATE_FLOAT)) {
        $errores['precio_segundo'] = 'El precio del segundo plato debe ser un número válido.';
    }
    if (empty($postre['precio']) || !filter_var($postre['precio'], FILTER_VALIDATE_FLOAT)) {
        $errores['precio_postre'] = 'El precio del postre debe ser un número válido.';
    }

    // DESCRIPCIÓN (LETRAS, NÚMEROS, MAX 200 CARACTERES)
    if (empty($primer_plato['descripcion']) || strlen($primer_plato['descripcion']) < 1 || strlen($primer_plato['descripcion']) > 200) {
        $errores['descripcion_primer'] = 'La descripción del primer plato debe tener entre 1 y 200 caracteres.';
    }
    if (empty($segundo_plato['descripcion']) || strlen($segundo_plato['descripcion']) < 1 || strlen($segundo_plato['descripcion']) > 200) {
        $errores['descripcion_segundo'] = 'La descripción del segundo plato debe tener entre 1 y 200 caracteres.';
    }
    if (empty($postre['descripcion']) || strlen($postre['descripcion']) < 1 || strlen($postre['descripcion']) > 200) {
        $errores['descripcion_postre'] = 'La descripción del postre debe tener entre 1 y 200 caracteres.';
    }

    // SUBIDA DE IMÁGENES
    foreach (['primer', 'segundo', 'postre'] as $plato) {
        $campo_imagen = "imagen_$plato";
        if ($_FILES[$campo_imagen]["error"] === 0) {
            $error = '';
            if ($_FILES[$campo_imagen]['size'] > $tamano) {
                $error .= 'El archivo es demasiado grande. ';
            }
            $tipo = mime_content_type($_FILES[$campo_imagen]['tmp_name']);
            if (!in_array($tipo, $imagenes_permitidas)) {
                $error .= 'Tipo de archivo no permitido. ';
            }
            $nombre_archivo = strtolower($_FILES[$campo_imagen]['name']);
            $ext = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            if (!in_array($ext, $ext_permitidas)) {
                $error .= 'Extensión de archivo no permitida. ';
            }

            if (empty($error)) {
                $destino = $ruta_subida . $nombre_archivo;
                if (move_uploaded_file($_FILES[$campo_imagen]['tmp_name'], $destino)) {
                    $ruta_miniatura = $ruta_miniaturas . 'thumb_' . $nombre_archivo;
                    if (!is_dir($ruta_miniaturas)) {
                        mkdir($ruta_miniaturas, 0777, true);
                    }
                    redimensionar_imagen($destino, $ext, 300, 300);
                    ${"$plato" . "_plato"}['imagen'] = $ruta_miniatura; // Guarda la ruta de la miniatura
                    $mensaje = "Archivo subido y redimensionado con éxito.";
                } else {
                    $mensaje = "No se pudo guardar el archivo.";
                }
            } else {
                $errores["$plato" . "_imagen"] = "Error: " . $error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen B7</title>
</head>
<body>
    <h1>MENU RESTAURANTE</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- Primer Plato -->
        <label for="nombre_primer">Nombre Primer Plato:</label><br>
        <input type="text" id="nombre_primer" name="nombre_primer" value="<?= htmlspecialchars($primer_plato['nombre'] ?? '') ?>" required>
        <span style="color: red;"><?= $errores['nombre_primer'] ?? '' ?></span><br><br>

        <label for="precio_primer">Precio Primer Plato:</label><br>
        <input type="text" id="precio_primer" name="precio_primer" value="<?= htmlspecialchars($primer_plato['precio'] ?? '') ?>" required>
        <span style="color: red;"><?= $errores['precio_primer'] ?? '' ?></span><br><br>

        <label for="descripcion_primer">Descripción Primer Plato:</label><br>
        <textarea id="descripcion_primer" name="descripcion_primer" rows="4" cols="50"><?= htmlspecialchars($primer_plato['descripcion'] ?? '') ?></textarea>
        <span style="color: red;"><?= $errores['descripcion_primer'] ?? '' ?></span><br><br>

        <label for="bebida_primer">Incluye Bebida:</label><br>
        <select id="bebida_primer" name="bebida_primer" required>
            <option value="" <?= empty($primer_plato['bebida']) ? 'selected' : '' ?>>Seleccione una opción</option>
            <option value="Si" <?= ($primer_plato['bebida'] ?? '') === 'Si' ? 'selected' : '' ?>>Si</option>
            <option value="No" <?= ($primer_plato['bebida'] ?? '') === 'No' ? 'selected' : '' ?>>No</option>
        </select>
        <span style="color: red;"><?= $errores['bebida_primer'] ?? '' ?></span><br><br>

        <label for="imagen_primer">Imagen Primer Plato:</label><br>
        <input type="file" id="imagen_primer" name="imagen_primer" accept="image/*" required>
        <span style="color: red;"><?= $errores['primer_imagen'] ?? '' ?></span><br><br>

        <!-- Segundo Plato -->
        <label for="nombre_segundo">Nombre Segundo Plato:</label><br>
        <input type="text" id="nombre_segundo" name="nombre_segundo" value="<?= htmlspecialchars($segundo_plato['nombre'] ?? '') ?>" required>
        <span style="color: red;"><?= $errores['nombre_segundo'] ?? '' ?></span><br><br>

        <label for="precio_segundo">Precio Segundo Plato:</label><br>
        <input type="text" id="precio_segundo" name="precio_segundo" value="<?= htmlspecialchars($segundo_plato['precio'] ?? '') ?>" required>
        <span style="color: red;"><?= $errores['precio_segundo'] ?? '' ?></span><br><br>

        <label for="descripcion_segundo">Descripción Segundo Plato:</label><br>
        <textarea id="descripcion_segundo" name="descripcion_segundo" rows="4" cols="50"><?= htmlspecialchars($segundo_plato['descripcion'] ?? '') ?></textarea>
        <span style="color: red;"><?= $errores['descripcion_segundo'] ?? '' ?></span><br><br>

        <label for="imagen_segundo">Imagen Segundo Plato:</label><br>
        <input type="file" id="imagen_segundo" name="imagen_segundo" accept="image/*" required>
        <span style="color: red;"><?= $errores['segundo_imagen'] ?? '' ?></span><br><br>

        <!-- Postre -->
        <label for="nombre_postre">Nombre Postre:</label><br>
        <input type="text" id="nombre_postre" name="nombre_postre" value="<?= htmlspecialchars($postre['nombre'] ?? '') ?>" required>
        <span style="color: red;"><?= $errores['nombre_postre'] ?? '' ?></span><br><br>

        <label for="precio_postre">Precio Postre:</label><br>
        <input type="text" id="precio_postre" name="precio_postre" value="<?= htmlspecialchars($postre['precio'] ?? '') ?>" required>
        <span style="color: red;"><?= $errores['precio_postre'] ?? '' ?></span><br><br>

        <label for="descripcion_postre">Descripción Postre:</label><br>
        <textarea id="descripcion_postre" name="descripcion_postre" rows="4" cols="50"><?= htmlspecialchars($postre['descripcion'] ?? '') ?></textarea>
        <span style="color: red;"><?= $errores['descripcion_postre'] ?? '' ?></span><br><br>

        <label for="imagen_postre">Imagen Postre:</label><br>
        <input type="file" id="imagen_postre" name="imagen_postre" accept="image/*" required>
        <span style="color: red;"><?= $errores['postre_imagen'] ?? '' ?></span><br><br>

        <!-- BOTÓN ENVIAR -->
        <button type="submit">Enviar</button>
    </form>

    <?php if (!empty($mensaje)): ?>
        <p><?= $mensaje ?></p>
    <?php endif; ?>

    <!-- Mostrar datos procesados -->
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errores)): ?>
        <h2>Datos Procesados</h2>

        <!-- Primer Plato -->
        <h3>Primer Plato</h3>
        <p>Nombre:<?= htmlspecialchars($primer_plato['nombre']) ?></p>
        <p>Precio:<?= htmlspecialchars($primer_plato['precio']) ?> €</p>
        <p>Bebida:<?= htmlspecialchars($primer_plato['bebida']) ?></p>
        <p>Descripción:<?= htmlspecialchars($primer_plato['descripcion']) ?></p>
        <?php if (!empty($primer_plato['imagen'])): ?>
            <img src="<?= htmlspecialchars($primer_plato['imagen']) ?>" width="300" alt="Miniatura Primer Plato"><br>
        <?php endif; ?>

        <!-- Segundo Plato -->
        <h3>Segundo Plato</h3>
        <p>Nombre:<?= htmlspecialchars($segundo_plato['nombre']) ?></p>
        <p>Precio:<?= htmlspecialchars($segundo_plato['precio']) ?> €</p>
        <p>Descripción:<?= htmlspecialchars($segundo_plato['descripcion']) ?></p>
        <?php if (!empty($segundo_plato['imagen'])): ?>
            <img src="<?= htmlspecialchars($segundo_plato['imagen']) ?>" width="300" alt="Miniatura Segundo Plato"><br>
        <?php endif; ?>

        <!-- Postre -->
        <h3>Postre</h3>
        <p>Nombre:<?= htmlspecialchars($postre['nombre']) ?></p>
        <p>Precio:<?= htmlspecialchars($postre['precio']) ?> €</p>
        <p>Descripción:<?= htmlspecialchars($postre['descripcion']) ?></p>
        <?php if (!empty($postre['imagen'])): ?>
            <img src="<?= htmlspecialchars($postre['imagen']) ?>" width="300" alt="Miniatura Postre"><br>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>