<?php
// INICIALIZACION DE VARIABLES
$fechas = [
    "fecha1" => "",
    "fecha2" => "",
    "zona_horaria" => "Europe/Madrid"
];
$errores = [
    'fecha1' => '', 
    'fecha2' => '', 
    'zona_horaria' => ''
];

// Lista de zonas horarias disponibles
$zonas_horarias = [
    'Europe/Madrid' => 'Madrid',
    'Europe/London' => 'Londres',
    'America/New_York' => 'Nueva York',
    'Asia/Tokyo' => 'Tokio',
    'Australia/Sydney' => 'Sídney'
    // los angeles
    'America/Los_Angeles' => 'Los Angeles',
];

$message_error = ''; // Inicialización de variables
$message = ''; // Inicialización de variables

// VERIFICAR EL METODO POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // DEFINIR LOS FILTROS DE VALIDACION PARA LAS FECHAS
    $filters['fecha1']['filter'] = FILTER_VALIDATE_REGEXP;
    $filters['fecha1']['options']['regexp'] = '/^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}$/';
    
    $filters['fecha2']['filter'] = FILTER_VALIDATE_REGEXP;
    $filters['fecha2']['options']['regexp'] = '/^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}$/';
    
    // APLICAR LOS FILTROS A LAS FECHAS POST
    $input_fechas = filter_input_array(INPUT_POST, $filters);
    $fechas['fecha1'] = $input_fechas['fecha1'] ?? '';
    $fechas['fecha2'] = $input_fechas['fecha2'] ?? '';
    $fechas["zona_horaria"] = $_POST['zona_horaria'] ?? 'Europe/Madrid';

    // VALIDAR FECHAS Y ALMACENAR MENSAJES DE ERROR
    $errores = [
        'fecha1' => ($input_fechas['fecha1']) ? '' : 'Error en la fecha 1',
        'fecha2' => ($input_fechas['fecha2']) ? '' : 'Error en la fecha 2',
        'zona_horaria' => ''
    ];

    // Validación de la zona horaria
    if (!array_key_exists($fechas['zona_horaria'], $zonas_horarias)) {
        $errores['zona_horaria'] = 'Zona horaria no válida';
    }

    $invalid = implode($errores);
    
    if (!$invalid) {
        try {
            // Crear objetos DateTime con la zona horaria especificada
            $timezone = new DateTimeZone($fechas["zona_horaria"]);
            $fecha1 = DateTime::createFromFormat('d/m/Y H:i:s', $fechas['fecha1'], $timezone);
            $fecha2 = DateTime::createFromFormat('d/m/Y H:i:s', $fechas['fecha2'], $timezone);

            // Calcular la diferencia entre las dos fechas
            $interval = $fecha1->diff($fecha2);

            // Crear un periodo para eventos recurrentes (cada semana)
            $intervalo_semanas = new DateInterval('P1W');
            $periodo = new DatePeriod($fecha1, $intervalo_semanas, $fecha2);

            // Mostrar resultados
            $mensaje = "<h3>Resultados del Análisis</h3>";
            $mensaje .= "<p><b>Fecha 1:</b> " . $fecha1->format('d/m/Y H:i:s') . "</p>";
            $mensaje .= "<p><b>Fecha 2:</b> " . $fecha2->format('d/m/Y H:i:s') . "</p>";
            $mensaje .= "<p><b>Zona Horaria:</b> " . $fechas['zona_horaria'] . "</p>";
            $mensaje .= "<p><b>Diferencia:</b> " . $interval->format('%y años, %m meses, %d días, %h horas, %i minutos') . "</p>";
            
            // Eventos recurrentes semanales
            $mensaje .= "<h4>Eventos Recurrentes (Semanales)</h4><ul>";
            foreach ($periodo as $fecha) {
                $mensaje .= "<li>" . $fecha->format('d/m/Y H:i:s') . "</li>";
            }
            $mensaje .= "</ul>";

            // Mostrar las fechas en otras zonas horarias
            $otras_zonas = ['America/New_York', 'Europe/London', 'Asia/Tokyo'];
            $message .= "<h4>Horarios en otras zonas</h4>";
            foreach ($otras_zonas as $zona) {
                $fecha_clonada = clone $fecha1; // Clonar para no modificar la original
                $fecha_clonada->setTimezone(new DateTimeZone($zona));
                $message .= "<p><b>" . $zona . ":</b> " . $fecha_clonada->format('d/m/Y H:i:s') . "</p>";
            }

        } catch (Exception $e) {
            $message_error = "Error al procesar las fechas: " . $e->getMessage();
        }
    } else {
        $message_error = 'Por favor corrija los errores señalados.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Avanzada de Fechas</title>
    <style>
        .error { color: red; }
        .success { color: green; }
        form { margin: 20px 0; }
        label { display: block; margin: 10px 0; }
    </style>
</head>
<body>
    <h3>Sistema Avanzado de Gestión de Fechas</h3>
    
    <?php if ($message_error): ?>
        <p class="error"><?= $message_error ?></p>
    <?php endif; ?>

    <form method="POST">
        <div>
            <label>Primera Fecha (dd/mm/yyyy hh:mm:ss):</label>
            <input type="text" name="fecha1" value="<?= htmlspecialchars($fechas['fecha1']) ?>" pattern="\d{2}/\d{2}/\d{4} \d{2}:\d{2}:\d{2}" placeholder="31/12/2024 23:59:59" required>
            <span class="error"><?= $errores['fecha1'] ?></span>
        </div>

        <div>
            <label>Segunda Fecha (dd/mm/yyyy hh:mm:ss):</label>
            <input type="text" name="fecha2" value="<?= htmlspecialchars($fechas['fecha2']) ?>" pattern="\d{2}/\d{2}/\d{4} \d{2}:\d{2}:\d{2}" placeholder="31/12/2024 23:59:59" required>
            <span class="error"><?= $errores['fecha2'] ?></span>
        </div>

        <div>
            <label>Zona Horaria:</label>
            <select name="zona_horaria">
                <?php foreach ($zonas_horarias as $valor => $texto): ?>
                    <option value="<?= $valor ?>" <?= ($fechas['zona_horaria'] === $valor) ? 'selected' : '' ?>><?= $texto ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <input type="submit" value="Procesar Fechas">
        </div>
    </form>

    <?php if ($message): ?>
        <div class="success">
            <?= $message ?>
        </div>
    <?php endif; ?>
</body>
</html>
