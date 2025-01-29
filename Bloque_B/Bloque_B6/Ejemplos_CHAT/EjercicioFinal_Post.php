<?php
// VARIABLES
$usuario = [
    "nombre" => "",
    "correo" => "",
    "mensaje" => ""
];
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // SANEAMIENTO DE LOS DATOS
    $datos = filter_input_array(INPUT_POST, [
        "nombre" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "correo" => FILTER_SANITIZE_EMAIL,
        "mensaje" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ]);

    // ASIGNAMOS LOS DATOS SANEADOS
    $usuario["nombre"] = $datos["nombre"];
    $usuario["correo"] = $datos["correo"];
    $usuario["mensaje"] = $datos["mensaje"];

    // VALIDACIÓN DE LOS DATOS
    if (empty($usuario["nombre"])) {
        $errores["nombre"] = "El nombre no puede estar vacío.";
    }

    if (empty($usuario["correo"]) || !filter_var($usuario["correo"], FILTER_VALIDATE_EMAIL)) {
        $errores["correo"] = "El correo no puede estar vacío o tiene un formato no válido.";
    }

    if (empty($usuario["mensaje"])) {
        $errores["mensaje"] = "El mensaje no puede estar vacío.";
    }

    // SI NO HAY ERRORES, MOSTRAR MENSAJE
    if (empty($errores)) {
        echo '<p style="color: green;">Los datos han sido procesados correctamente:</p>';
        echo "<ul>
            <li><strong>Nombre:</strong> {$usuario['nombre']}</li>
            <li><strong>Correo:</strong> {$usuario['correo']}</li>
            <li><strong>Mensaje:</strong> " . (strlen($usuario['mensaje']) > 50 ? substr($usuario['mensaje'], 0, 50) . '...' : $usuario['mensaje']) . "</li>
        </ul>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #6a11cb, #2575fc);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        /* Contenedor del formulario */
        .form-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.25);
            padding: 30px;
            width: 400px;
            backdrop-filter: blur(10px);
        }

        /* Estilos del formulario */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-size: 14px;
            margin-bottom: 15px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input:focus,
        textarea:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        textarea {
            resize: none;
        }

        .error-message {
            color: #ff6b6b;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        /* Botón */
        button {
            background: #2575fc;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            padding: 10px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }

        button:hover {
            background: #6a11cb;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Registro de Usuario</h1>
        <form action="" method="post">
            <!-- CAMPO NOMBRE -->
            <label for="nombre">Nombre completo:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
            <span class="error-message"><?= $errores['nombre'] ?? '' ?></span>

            <!-- CAMPO CORREO -->
            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
            <span class="error-message"><?= $errores['correo'] ?? '' ?></span>

            <!-- CAMPO MENSAJE -->
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" rows="5" cols="30" required><?= htmlspecialchars($usuario['mensaje']) ?></textarea>
            <span class="error-message"><?= $errores['mensaje'] ?? '' ?></span>

            <!-- BOTÓN ENVIAR -->
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>
