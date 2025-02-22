<?php
$message = '';
$message_error = '';
$fecha = [
    'fecha_inicio' => '',
    'fecha_fin' => ''
];
$error = [
    'fecha_inicio' => '',
    'fecha_fin' => '',
    'frecuencia' => '',
];

$opciones_validas = ["diaria", "semanal", "dos-semanas", "mensual"];
$frecuencia = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filters['fecha_inicio']['filter'] = FILTER_VALIDATE_REGEXP;
    $filters['fecha_inicio']['options']['regexp'] = '/[0-9\/\:\s]/';
    $filters['fecha_fin']['filter'] = FILTER_VALIDATE_REGEXP;
    $filters['fecha_fin']['options']['regexp'] = '/[0-9\/\:\s]/';

    $fecha = filter_input_array(INPUT_POST, $filters);

    if (isset($_POST["frecuencia"]) && in_array($_POST["frecuencia"], $opciones_validas)) {
        $frecuencia = $_POST["frecuencia"];
    }

    $error = [
        'fecha_inicio' => ($fecha['fecha_inicio']) ? '' : 'Error en la fecha de inicio',
        'fecha_fin' => ($fecha['fecha_fin']) ? '' : 'Error en la fecha de finalización',
        'frecuencia' => ($frecuencia !== '' && in_array($frecuencia, $opciones_validas)) ? '' : 'Error en la frecuencia seleccionada'
    ];

    $invalid = implode($error);

    if ($invalid) {
        $message_error = 'Debes solucionar los errores.';
    } else {
        // Los datos son válidos, realizar aqui los ejercicios propuestos
        $fecha_inicio = DateTime::createFromFormat('d/m/Y H:i:s', $fecha['fecha_inicio']);
        $fecha_fin = DateTime::createFromFormat('d/m/Y H:i:s', $fecha['fecha_fin']);
        
        if ($fecha_inicio && $fecha_fin) {
            $reuniones = generarFechasReuniones($fecha_inicio, $fecha_fin, $frecuencia);
            $message = mostrarReuniones($reuniones);
        } else {
            $message_error = 'Formato de fecha incorrecto.';
        }
    }
}

function generarFechasReuniones($inicio, $fin, $frecuencia) {
    $reuniones = [];
    $intervalo = '';

    switch ($frecuencia) {
        case 'diaria':
            $intervalo = 'P1D';
            break;
        case 'semanal':
            $intervalo = 'P1W';
            break;
        case 'dos-semanas':
            $intervalo = 'P2W';
            break;
        case 'mensual':
            $intervalo = 'P1M';
            break;
    }

    $periodo = new DatePeriod($inicio, new DateInterval($intervalo), $fin);

    foreach ($periodo as $fecha) {
        $reuniones[] = $fecha;
    }

    return $reuniones;
}

function mostrarReuniones($reuniones) {
    $zonas_horarias = [
        'Madrid' => 'Europe/Madrid',
        'Los Ángeles' => 'America/Los_Angeles',
        'Londres' => 'Europe/London',
        'Tokio' => 'Asia/Tokyo'
    ];

    $output = '<table border="1"><tr><th>Fecha y Hora</th><th>Madrid</th><th>Los Ángeles</th><th>Londres</th><th>Tokio</th><th>Tiempo Restante</th></tr>';

    foreach ($reuniones as $reunion) {
        $output .= '<tr>';
        $output .= '<td>' . $reunion->format('d/m/Y H:i:s') . '</td>';

        foreach ($zonas_horarias as $ciudad => $zona) {
            $reunion->setTimezone(new DateTimeZone($zona));
            $output .= '<td>' . $reunion->format('d/m/Y H:i:s') . ' (' . $reunion->getOffset() / 3600 . ' UTC)</td>';
        }

        $ahora = new DateTime();
        $intervalo = $ahora->diff($reunion);
        $output .= '<td>' . $intervalo->format('%a días, %h horas, %i minutos') . '</td>';

        $output .= '</tr>';
    }

    $output .= '</table>';

    return $output;
}
?>


