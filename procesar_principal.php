<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';
require_once 'config/datos_demo.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('principal_formulario.php');
}

$expediente = isset($_POST['expediente']) ? limpiar($_POST['expediente']) : '';
$especialidad = isset($_POST['especialidad']) ? limpiar($_POST['especialidad']) : '';
$medico = isset($_POST['medico']) ? limpiar($_POST['medico']) : '';
$fecha = isset($_POST['fecha']) ? limpiar($_POST['fecha']) : '';
$hora = isset($_POST['hora']) ? limpiar($_POST['hora']) : '';

$errores = [];

if (empty($expediente) || !isset($pacientes[$expediente])) {
    $errores[] = "Debe seleccionar un paciente válido.";
}
if (empty($medico) || !array_key_exists($medico, $medicos)) {
    $errores[] = "Debe seleccionar un médico válido.";
}
if (empty($fecha) || !DateTime::createFromFormat('Y-m-d', $fecha)) {
    $errores[] = "La fecha no es válida.";
}
if (empty($hora) || !preg_match('/^([01]\d|2[0-3]):([0-5]\d)$/', $hora)) {
    $errores[] = "La hora no es válida (formato HH:MM).";
}

if (empty($errores)) {
    $citas_mismo_horario = 0;
    $citas_activas_mismo_dia = 0;

    foreach ($citas as $cita) {
        if ($cita['medico'] === $medico && $cita['fecha'] === $fecha) {
            if ($cita['hora'] === $hora) {
                $citas_mismo_horario++;
            }
            
            $estado_cita = $cita['estado'];
            if (isset($estados[$estado_cita]) && $estados[$estado_cita]['activa'] === true) {
                $citas_activas_mismo_dia++;
            }
        }
    }

    if ($citas_mismo_horario > 0) {
        $errores[] = "El médico ya tiene una cita programada a esa misma fecha y hora.";
    }

    if ($citas_activas_mismo_dia >= MAX_CITAS_DIA) {
        $errores[] = "El médico ha alcanzado el límite máximo de " . MAX_CITAS_DIA . " citas activas para este día.";
    }
}

if (!empty($errores)) {
    echo "<h2>Error al procesar la cita</h2>";
    mostrar_errores($errores);
    echo "<p><a href='principal_formulario.php'>Volver al formulario</a></p>";
} else {
    echo "<h2>¡Cita reservada con éxito!</h2>";
    echo "<p><strong>Paciente:</strong> " . limpiar($pacientes[$expediente]['nombre']) . "</p>";
    echo "<p><strong>Médico:</strong> " . limpiar($medicos[$medico]['nombre']) . "</p>";
    echo "<p><strong>Fecha:</strong> " . limpiar($fecha) . " a las " . limpiar($hora) . "</p>";
    echo "<p><a href='principal_listado.php'>Ver listado de citas</a></p>";
}