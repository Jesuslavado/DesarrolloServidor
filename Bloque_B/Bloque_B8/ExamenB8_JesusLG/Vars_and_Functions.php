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

// DIFERENTES ZONAS HORARIAS
$zonas_horarias = [
    'Europe/Madrid' => 'Madrid',
    'Europe/London' => 'Londres',
    'Asia/Tokyo' => 'Tokio',
    'America/Los_Angeles' => 'Los Angeles',
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
        
        // GENERATE REUNIONES CON LAS FECHAS
        if ($fecha_inicio && $fecha_fin) {
            $reuniones = generarFechasReuniones($fecha_inicio, $fecha_fin, $frecuencia);
            $message = mostrarReuniones($reuniones);
        } else {
            $message_error = 'Formato de fecha incorrecto.';
        } 
    }

}

// FUNCION PARA GENERERAR LAS FECHAS DE LA REUNIÓN
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

// FUNCION PARA MOSTRAR LAS REUNIONES
function mostrarReuniones($reuniones) {
    // ZONAS HORARIAS REQUERIDAS
    $zonas_horarias = [
        "Madrid" => "Europe/Madrid",
        "Los Angeles" => "America/Los_Angeles",
        "Londres" => "Europe/London",
        "Tokio" => "Asia/Tokyo"
    ];
    // FORMATO PARA MOSTRAR LOS DATOS
    $mostrar_datos = "<div class='contenedor'>
    <br>
    <h1>Fecha y Hora</h1>
    <div>Madrid</div>
    <div>Los Angeles</div>
    <div>Londres</div>
    <div>Tokio</div>
    <div>Tiempo Restante</div>
    </div>
    <br>";
    
    // BUCLE PARA MOSTRAR LAS REUNIONES
    foreach ($reuniones as $fecha) {
        $mostrar_datos .= "<div class='contenedor'>";
        $mostrar_datos .= "<div>" . $fecha->format('d/m/Y H:i:s') . "</div>";
        // BUCLE PARA MOSTRAR LAS ZONAS HORARIAS
        foreach ($zonas_horarias as $ciudad => $hora) {
            $fecha->setTimezone(new DateTimeZone($hora));
            $mostrar_datos .= "<div>" . $fecha->format('d/m/Y H:i:s') . ' (' . $fecha->getOffset() / 3600 . " UTC)</div>"; 
        }
        // BUCLE PARA MOSTRAR EL TIEMPO RESTANTE
        $factual = new DateTime();
        $intervalo = $factual->diff($fecha);
        $mostrar_datos .= '<div>' . $intervalo->format('%a días, %h horas, %i minutos') . '</div>'. "<br>";
        $mostrar_datos .= "</div>";
    }

    return $mostrar_datos;
}
?>

