<?php
// Inicializar variables
$message = ''; // Variable para almacenar el mensaje de éxito
$message_error = ''; // Variable para almacenar el mensaje de error
$fechas = [
    'fecha1' => '', // Almacena la primera fecha ingresada por el usuario
    'fecha2' => '', // Almacena la segunda fecha ingresada por el usuario
    'zona_horaria' => 'Europe/Madrid' // Almacena la zona horaria seleccionada, por defecto 'Europe/Madrid'
];
$error = [
    'fecha1' => '', // Almacena el mensaje de error para la primera fecha
    'fecha2' => '', // Almacena el mensaje de error para la segunda fecha
    'zona_horaria' => '' // Almacena el mensaje de error para la zona horaria
];

// Verificar si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Definir los filtros de validación para las fechas
    $filters['fecha1']['filter'] = FILTER_VALIDATE_REGEXP; // Filtro de expresión regular para fecha1
    $filters['fecha1']['options']['regexp'] = '/^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}$/'; // Expresión regular para validar el formato de fecha1
    
    $filters['fecha2']['filter'] = FILTER_VALIDATE_REGEXP; // Filtro de expresión regular para fecha2
    $filters['fecha2']['options']['regexp'] = '/^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}$/'; // Expresión regular para validar el formato de fecha2
    
    // Aplicar los filtros a los datos POST
    $input_fechas = filter_input_array(INPUT_POST, $filters);
    $fechas['fecha1'] = $input_fechas['fecha1'] ?? ''; // Asignar fecha1 si está presente, de lo contrario, cadena vacía
    $fechas['fecha2'] = $input_fechas['fecha2'] ?? ''; // Asignar fecha2 si está presente, de lo contrario, cadena vacía
    $fechas['zona_horaria'] = $_POST['zona_horaria'] ?? 'Europe/Madrid'; // Asignar la zona horaria seleccionada, por defecto 'Europe/Madrid'

    // Validar fechas y almacenar mensajes de error
    $error = [
        'fecha1' => ($input_fechas['fecha1']) ? '' : 'Error en la fecha 1', // Si fecha1 no es válida, mostrar error
        'fecha2' => ($input_fechas['fecha2']) ? '' : 'Error en la fecha 2', // Si fecha2 no es válida, mostrar error
        'zona_horaria' => '' // No hay validación para la zona horaria, por lo que siempre está vacío
    ];

    // Si no hay errores, procesar las fechas
    $invalid = implode($error); // Unir los mensajes de error en una sola cadena
    if (!$invalid) { // Si no hay errores
     
            // Crear objetos DateTime con la zona horaria especificada
            $timezone = new DateTimeZone($fechas['zona_horaria']); // Crear objeto DateTimeZone con la zona horaria seleccionada
            $fecha1 = DateTime::createFromFormat('d/m/Y H:i:s', $fechas['fecha1'], $timezone); // Crear objeto DateTime para fecha1
            $fecha2 = DateTime::createFromFormat('d/m/Y H:i:s', $fechas['fecha2'], $timezone); // Crear objeto DateTime para fecha2

            // Calcular la diferencia entre las dos fechas
            $interval = $fecha1->diff($fecha2); // Calcular la diferencia entre fecha1 y fecha2

            // Crear un periodo para eventos recurrentes (cada semana)
            $interval_week = new DateInterval('P1W'); // Intervalo de una semana
            $period = new DatePeriod($fecha1, $interval_week, $fecha2); // Crear un periodo desde fecha1 hasta fecha2 con intervalos semanales

            // Construir el mensaje de resultados
            $message = "<h3>Resultados del Análisis</h3>"; // Título del mensaje
            $message .= "<p><b>Fecha 1:</b> " . $fecha1->format('d/m/Y H:i:s') . "</p>"; // Mostrar fecha1 formateada
            $message .= "<p><b>Fecha 2:</b> " . $fecha2->format('d/m/Y H:i:s') . "</p>"; // Mostrar fecha2 formateada
            $message .= "<p><b>Zona Horaria:</b> " . $fechas['zona_horaria'] . "</p>"; // Mostrar la zona horaria seleccionada
            $message .= "<p><b>Diferencia:</b> " . $interval->format('%y años, %m meses, %d días, %h horas, %i minutos') . "</p>"; // Mostrar la diferencia entre las fechas
            
            // Mostrar eventos recurrentes (semanales)
            $message .= "<h4>Eventos Recurrentes (Semanales)</h4><ul>"; // Título para los eventos recurrentes
            foreach ($period as $date) { // Iterar sobre cada fecha en el periodo
                $message .= "<li>" . $date->format('d/m/Y H:i:s') . "</li>"; // Mostrar cada fecha formateada
            }
            $message .= "</ul>";

            // Mostrar las fechas en otras zonas horarias
            $otras_zonas = ['America/New_York', 'Asia/Tokyo', 'Australia/Sydney']; // Lista de otras zonas horarias
            $message .= "<h4>Horarios en otras zonas</h4>"; // Título para las otras zonas horarias
            foreach ($otras_zonas as $zona) { // Iterar sobre cada zona horaria
                $fecha1->setTimezone(new DateTimeZone($zona)); // Cambiar la zona horaria de fecha1
                $message .= "<p><b>" . $zona . ":</b> " . $fecha1->format('d/m/Y H:i:s') . "</p>"; // Mostrar fecha1 en la nueva zona horaria
            }   
    } else {
        $message_error = 'Por favor corrija los errores señalados.'; // Mostrar mensaje de error si hay errores en las fechas
    }
}

// Lista de zonas horarias disponibles
$zonas_horarias = [
    'Europe/Madrid' => 'Madrid', // Zona horaria de Madrid
    'Europe/London' => 'Londres', // Zona horaria de Londres
    'America/New_York' => 'Nueva York', // Zona horaria de Nueva York
    'Asia/Tokyo' => 'Tokio', // Zona horaria de Tokio
    'Australia/Sydney' => 'Sídney' // Zona horaria de Sídney
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Avanzada de Fechas</title>
    <style>
        .error { color: red; } /* Estilo para mensajes de error */
        .success { color: green; } /* Estilo para mensajes de éxito */
        form { margin: 20px 0; } /* Estilo para el formulario */
        label { display: block; margin: 10px 0; } /* Estilo para las etiquetas */
    </style>
</head>
<body>
    <h3>Sistema Avanzado de Gestión de Fechas</h3>
    
    <?php if ($message_error): ?> <!-- Si hay un mensaje de error, mostrarlo -->
        <p class="error"><?= $message_error ?></p>
    <?php endif; ?>

    <form method="POST"> <!-- Formulario para ingresar las fechas -->
        <div>
            <label>Primera Fecha (dd/mm/yyyy hh:mm:ss):</label> <!-- Etiqueta para la primera fecha -->
            <input type="text" name="fecha1" 
                   value="<?= htmlspecialchars($fechas['fecha1']) ?>" 
                   pattern="\d{2}/\d{2}/\d{4} \d{2}:\d{2}:\d{2}" 
                   placeholder="31/12/2024 23:59:59" 
                   required> <!-- Campo obligatorio -->
            <span class="error"><?= $error['fecha1'] ?></span> <!-- Mostrar mensaje de error para fecha1 -->
        </div>

        <div>
            <label>Segunda Fecha (dd/mm/yyyy hh:mm:ss):</label> <!-- Etiqueta para la segunda fecha -->
            <input type="text" name="fecha2" 
                   value="<?= htmlspecialchars($fechas['fecha2']) ?>"
                   pattern="\d{2}/\d{2}/\d{4} \d{2}:\d{2}:\d{2}" 
                   placeholder="31/12/2024 23:59:59" 
                   required> <!-- Campo obligatorio -->
            <span class="error"><?= $error['fecha2'] ?></span> <!-- Mostrar mensaje de error para fecha2 -->
        </div>

        <div>
            <label>Zona Horaria:</label> <!-- Etiqueta para la zona horaria -->
            <select name="zona_horaria"> <!-- Lista desplegable para seleccionar la zona horaria -->
                <?php foreach ($zonas_horarias as $valor => $texto): ?> <!-- Iterar sobre las zonas horarias -->
                    <option value="<?= $valor ?>" 
                            <?= ($fechas['zona_horaria'] === $valor) ? 'selected' : '' ?>> <!-- Seleccionar la zona horaria actual -->
                        <?= $texto ?> <!-- Mostrar el nombre de la zona horaria -->
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <input type="submit" value="Procesar Fechas"> <!-- Botón para enviar el formulario -->
        </div>
    </form>

    <?php if ($message): ?> <!-- Si hay un mensaje de éxito, mostrarlo -->
        <div class="success">
            <?= $message ?>
        </div>
    <?php endif; ?>
</body>
</html>