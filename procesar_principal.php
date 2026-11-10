<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';
require_once 'config/datos_demo.php';
exigir_rol(['paciente', 'recepcion']);
require_once 'clases/Validador.php';
require_once 'clases/Cita.php';

// Este script solo acepta el envío del formulario (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('principal_formulario.php');
}

// Lectura de los datos (se escapan al mostrarlos, no aquí)
$expediente   = trim($_POST['numero_expediente'] ?? '');
$especialidad = trim($_POST['especialidad'] ?? '');
$servicio     = trim($_POST['servicio'] ?? '');
$medico       = trim($_POST['medico'] ?? '');
$fecha        = trim($_POST['fecha'] ?? '');
$hora         = trim($_POST['hora'] ?? '');
$motivo       = trim($_POST['motivo'] ?? '');

// ---------- Validación de cada campo ----------
$validador = new Validador();

// Expediente (campo asignado): obligatorio, 6 dígitos y que el paciente exista
$validador->requerido('numero_expediente', $expediente, 'Número de expediente');
$validador->regla('numero_expediente', $expediente === '' || preg_match('/^\d{6}$/', $expediente) === 1,
                  'El número de expediente debe tener exactamente 6 dígitos.');
$validador->regla('numero_expediente', $expediente === '' || isset($pacientes[$expediente]),
                  'No hay ningún paciente con ese número de expediente.');

$validador->requerido('especialidad', $especialidad, 'Especialidad');
$validador->enLista('especialidad', $especialidad, 'Especialidad', array_keys($especialidades));

$validador->requerido('servicio', $servicio, 'Servicio');
$validador->enLista('servicio', $servicio, 'Servicio', array_keys($servicios));

// "Cualquier médico" sirve para buscar horas, pero para confirmar hay que elegir uno
$validador->requerido('medico', $medico, 'Médico');
$validador->regla('medico', $medico !== 'cualquiera', 'Elija un médico para confirmar la cita.');
$validador->enLista('medico', $medico, 'Médico', array_keys($medicos));

$validador->requerido('fecha', $fecha, 'Fecha');
$validador->fecha('fecha', $fecha, 'Fecha', '2026-11-01', '2027-04-02');

$validador->requerido('hora', $hora, 'Hora');
$validador->hora('hora', $hora, 'Hora');

$validador->longitud('motivo', $motivo, 'Motivo de la consulta', 1, 300);

// ---------- Reglas de la agenda (solo si cada campo está bien) ----------
if (!$validador->hayErrores()) {
    // El médico debe ser de la especialidad elegida
    $validador->regla('medico', $medicos[$medico]['especialidad'] === $especialidad,
                      'El médico elegido no atiende esa especialidad.');

    // Al menos 24 horas de anticipación (24 h × 60 min × 60 s)
    $validador->regla('fecha', strtotime("$fecha $hora") - time() >= 24 * 60 * 60,
                      'Las citas deben solicitarse con al menos 24 horas de anticipación.');

    // El día: no feriado, médico no ausente y que el médico atienda ese día
    $claves_dia  = ['dom', 'lun', 'mar', 'mie', 'jue', 'vie', 'sab'];
    $clave_dia   = $claves_dia[date('w', strtotime($fecha))];
    $horario_dia = $horarios[$medico]['dias'][$clave_dia] ?? null;

    $ausente = false;
    foreach ($ausencias as $ausencia) {
        if ($ausencia['medico'] === $medico && $fecha >= $ausencia['desde'] && $fecha <= $ausencia['hasta']) {
            $ausente = true;
        }
    }
    $validador->regla('fecha', !in_array($fecha, $feriados, true), 'Ese día es feriado: la clínica no atiende.');
    $validador->regla('fecha', !$ausente, 'El médico estará ausente ese día.');
    $validador->regla('fecha', $horario_dia !== null, 'El médico no atiende ese día.');

    // La hora debe estar dentro del horario del médico ese día
    if ($horario_dia !== null) {
        $validador->regla('hora', $hora >= $horario_dia['desde'] && $hora < $horario_dia['hasta'],
                          'Esa hora está fuera del horario del médico.');
    }

    // R1 y R2: citas activas del mismo médico ese día
    $activas_dia  = 0;
    $hora_ocupada = false;
    foreach ($citas as $datos) {
        if ($datos['medico'] === $medico && $datos['fecha'] === $fecha && $estados[$datos['estado']]['activa']) {
            $activas_dia++;
            if ($datos['hora'] === $hora) {
                $hora_ocupada = true;
            }
        }
    }
    $validador->regla('hora', !$hora_ocupada, 'El médico ya tiene una cita a esa hora. Elija otra.');                  // R1
    $validador->regla('fecha', $activas_dia < MAX_CITAS_DIA, 'El médico no tiene más cupo ese día. Elija otra fecha.'); // R2

    // R3: el paciente no puede tener dos citas activas de la misma especialidad
    $misma_especialidad = false;
    foreach ($citas as $datos) {
        if ($datos['expediente'] === $expediente
            && $datos['especialidad'] === $especialidad
            && $estados[$datos['estado']]['activa']) {
            $misma_especialidad = true;
        }
    }
    $validador->regla('especialidad', !$misma_especialidad,
                      'El paciente ya tiene una cita activa de esta especialidad. Reprograme o cancele esa cita antes de pedir otra.');
}

// ---------- Con errores: se vuelve al formulario ----------
if ($validador->hayErrores()) {
    $_SESSION['errores_cita'] = $validador->getErrores();
    // El expediente y el motivo van por la sesión (son datos personales: no se ponen en la URL)
    $_SESSION['datos_cita'] = ['numero_expediente' => $expediente, 'motivo' => $motivo];
    // La selección vuelve por la URL, igual que con "Ver horas libres"
    redirigir('principal_formulario.php?' . http_build_query([
        'especialidad' => $especialidad,
        'servicio'     => $servicio,
        'medico'       => $medico,
        'fecha'        => $fecha,
        'hora'         => $hora,
    ]));
}

// ---------- Cita válida: se crea el objeto Cita ----------
$ultimo = max(array_keys($citas));                            // 'CIT-0217'
$codigo = sprintf('CIT-%04d', (int) substr($ultimo, 4) + 1);  // 'CIT-0218'

$cita = new Cita($codigo, $expediente, $medico, $fecha, $hora);
$cita->setServicio($servicio);
$cita->setMotivo($motivo);

// Textos para la confirmación, leídos desde el objeto
$paciente         = $pacientes[$cita->getExpediente()];
$servicio_elegido = $servicios[$cita->getServicio()];
$marca            = strtotime($cita->getFecha() . ' ' . $cita->getHora());
$texto_hora       = date('g:i', $marca) . (date('a', $marca) === 'am' ? ' a. m.' : ' p. m.');

$titulo = 'Cita reservada';
$descripcion = 'Confirmación de la cita médica reservada.';
$pagina_activa = 'reservar';
require_once 'includes/encabezado.php';
?>

  <main id="eq05-principal" class="eq05-contenedor">
    <h1>Cita reservada · <?php echo limpiar($cita->getCodigo()); ?></h1>
    <p class="eq05-subtitulo">Estos son los datos recibidos y validados. Todavía no hay base de datos: la cita se guardará en el Hito 3.</p>

    <section class="eq05-tarjeta" aria-labelledby="eq05-titulo-cita">
      <h2 id="eq05-titulo-cita">Datos de la cita</h2>
      <dl class="eq05-datos">
        <dt>Paciente</dt><dd><?php echo limpiar($paciente['nombre']); ?> · Exp. <?php echo limpiar($cita->getExpediente()); ?></dd>
        <dt>Especialidad</dt><dd><?php echo limpiar($especialidades[$especialidad]); ?></dd>
        <dt>Servicio</dt><dd><?php echo limpiar($servicio_elegido['nombre']); ?> (<?php echo $servicio_elegido['minutos']; ?> min)</dd>
        <dt>Médico</dt><dd><?php echo limpiar($medicos[$cita->getMedico()]['nombre']); ?></dd>
        <dt>Fecha</dt><dd><?php echo formatear_fecha($cita->getFecha()); ?></dd>
        <dt>Hora</dt><dd><?php echo $texto_hora; ?></dd>
        <dt>Lugar</dt><dd>Consultorio <?php echo limpiar($horario_dia['consultorio']); ?></dd>
        <dt>Estado</dt><dd><?php echo limpiar($estados[$cita->getEstado()]['texto']); ?></dd>
        <?php if ($cita->getMotivo() !== ''): ?>
        <dt>Motivo</dt><dd><?php echo limpiar($cita->getMotivo()); ?></dd>
        <?php endif; ?>
      </dl>
    </section>

    <div class="eq05-acciones">
      <a class="eq05-boton eq05-boton--primario" href="principal_listado.php">Ver listado de citas</a>
      <a class="eq05-boton" href="principal_formulario.php">Reservar otra cita</a>
    </div>
  </main>

<?php require_once 'includes/pie.php'; ?>