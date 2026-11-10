<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';
require_once 'config/datos_demo.php';
require_once 'clases/Validador.php';
require_once 'clases/Horario.php';

// Este script solo acepta el envío del formulario (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('secundaria_formulario.php');
}

// Datos generales del horario.
// trim() quita los espacios de los extremos; el escape con limpiar() se hace al MOSTRAR los datos.
$medico        = trim($_POST['medico'] ?? '');
$duracion      = trim($_POST['duracion'] ?? '');
$vigente_desde = trim($_POST['vigente_desde'] ?? '');

// Días: cada día llega en 4 campos (lun_atiende, lun_desde, lun_hasta, lun_consultorio, …)
$dias_semana = ['lun' => 'Lunes', 'mar' => 'Martes', 'mie' => 'Miércoles',
                'jue' => 'Jueves', 'vie' => 'Viernes', 'sab' => 'Sábado'];
$dias_recibidos = [];
foreach ($dias_semana as $clave_dia => $nombre_dia) {
    $dias_recibidos[$clave_dia] = [
        'atiende'     => trim($_POST[$clave_dia . '_atiende'] ?? ''),
        'desde'       => trim($_POST[$clave_dia . '_desde'] ?? ''),
        'hasta'       => trim($_POST[$clave_dia . '_hasta'] ?? ''),
        'consultorio' => trim($_POST[$clave_dia . '_consultorio'] ?? ''),
    ];
}

// Ausencia (opcional) y forma de reagendar las citas afectadas
$aus_desde  = trim($_POST['ausencia_desde'] ?? '');
$aus_hasta  = trim($_POST['ausencia_hasta'] ?? '');
$aus_motivo = trim($_POST['ausencia_motivo'] ?? '');
$aus_nota   = trim($_POST['ausencia_nota'] ?? '');
$estrategia = trim($_POST['estrategia'] ?? '');


// ---------- Validación ----------
$validador = new Validador();

// Médico: obligatorio y que exista en la lista
$validador->requerido('medico', $medico, 'Médico');
$validador->enLista('medico', $medico, 'Médico', array_keys($medicos));

// Duración: obligatoria, entre 10 y 120, en saltos de 10
$validador->requerido('duracion', $duracion, 'Duración de cada espacio');
$validador->rango('duracion', $duracion, 'Duración de cada espacio', 10, 120);
$validador->regla('duracion', !is_numeric($duracion) || (int) $duracion % 10 === 0,
                  'La duración de cada espacio debe ir en saltos de 10 minutos.');

// Vigencia: obligatoria y dentro del rango de la agenda
$validador->requerido('vigente_desde', $vigente_desde, 'Vigente desde');
$validador->fecha('vigente_desde', $vigente_desde, 'Vigente desde', '2026-11-01', '2027-04-02');

// Días: solo se revisan los que llegan marcados como "atiende"
$dias_marcados = 0;
foreach ($dias_semana as $clave_dia => $nombre_dia) {
    $dia = $dias_recibidos[$clave_dia];
    $validador->enLista($clave_dia . '_atiende', $dia['atiende'], $nombre_dia, ['si']);
    if ($dia['atiende'] !== 'si') {
        continue;
    }
    $dias_marcados++;
    $validador->requerido($clave_dia . '_desde', $dia['desde'], "$nombre_dia, desde");
    $validador->hora($clave_dia . '_desde', $dia['desde'], "$nombre_dia, desde");
    $validador->requerido($clave_dia . '_hasta', $dia['hasta'], "$nombre_dia, hasta");
    $validador->hora($clave_dia . '_hasta', $dia['hasta'], "$nombre_dia, hasta");
    $validador->regla($clave_dia . '_hasta', $dia['desde'] < $dia['hasta'],
                      "En $nombre_dia, la hora final debe ser posterior a la inicial.");
    $validador->requerido($clave_dia . '_consultorio', $dia['consultorio'], "$nombre_dia, consultorio");
    $validador->enLista($clave_dia . '_consultorio', $dia['consultorio'], "$nombre_dia, consultorio", ['101', '204', '206']);
}
$validador->regla('dias', $dias_marcados > 0, 'Marque al menos un día de atención.');

// Ausencia: es opcional, pero si se llena una fecha, las dos deben estar bien
if ($aus_desde !== '' || $aus_hasta !== '') {
    $validador->requerido('ausencia_desde', $aus_desde, 'Ausencia desde');
    $validador->fecha('ausencia_desde', $aus_desde, 'Ausencia desde', '2026-11-01', '2027-04-02');
    $validador->requerido('ausencia_hasta', $aus_hasta, 'Ausencia hasta');
    $validador->fecha('ausencia_hasta', $aus_hasta, 'Ausencia hasta', '2026-11-01', '2027-04-02');
    $validador->regla('ausencia_hasta', $aus_hasta >= $aus_desde,
                      'La fecha final de la ausencia no puede ser anterior a la inicial.');
}
$validador->enLista('ausencia_motivo', $aus_motivo, 'Motivo', ['congreso', 'vacaciones', 'incapacidad', 'otro']);
$validador->longitud('ausencia_nota', $aus_nota, 'Nota interna', 1, 200);

// Forma de reagendar: obligatoria y de la lista
$validador->requerido('estrategia', $estrategia, 'Cómo reagendar');
$validador->enLista('estrategia', $estrategia, 'Cómo reagendar', ['mismo_medico', 'otro_medico']);


// ---------- Respuesta ----------

// Con errores: se guardan en la sesión junto con lo enviado y se vuelve al formulario
if ($validador->hayErrores()) {
    $_SESSION['errores_horario'] = $validador->getErrores();
    $_SESSION['datos_horario'] = $_POST;
    redirigir('secundaria_formulario.php?medico=' . urlencode($medico));
}

// Sin errores: se arma el objeto Horario con los datos ya validados
$horario = new Horario($medico, $duracion, $vigente_desde);
foreach ($dias_semana as $clave_dia => $nombre_dia) {
    $dia = $dias_recibidos[$clave_dia];
    if ($dia['atiende'] === 'si') {
        $horario->agregarDia($clave_dia, $dia['desde'], $dia['hasta'], $dia['consultorio']);
    }
}

// Citas que afecta la ausencia (misma regla que la vista previa del formulario)
$total_afectadas = 0;
if ($aus_desde !== '') {
    foreach ($citas as $cita) {
        if ($cita['medico'] === $medico
            && $estados[$cita['estado']]['activa']
            && $cita['fecha'] >= $aus_desde
            && $cita['fecha'] <= $aus_hasta) {
            $total_afectadas++;
        }
    }
}

// Textos visibles de los valores elegidos
$motivos_ausencia = ['congreso' => 'Congreso médico', 'vacaciones' => 'Vacaciones',
                     'incapacidad' => 'Incapacidad', 'otro' => 'Otro'];
$estrategias = ['mismo_medico' => 'Con el mismo médico, en su siguiente espacio libre',
                'otro_medico'  => 'Permitir otro médico de la misma especialidad'];

// Página de confirmación
$titulo = 'Horario guardado';
$descripcion = 'Confirmación del horario del médico.';
$pagina_activa = 'horarios';
require_once 'includes/encabezado.php';
?>

  <main id="eq05-principal" class="eq05-contenedor">
    <h1>Horario guardado</h1>
    <p class="eq05-subtitulo">Estos son los datos recibidos y validados. Todavía no hay base de datos: se guardarán en el Hito 3.</p>

    <h2><?php echo limpiar($medicos[$horario->getMedico()]['nombre']); ?></h2>
    <p>Duración de cada espacio: <strong><?php echo $horario->getDuracion(); ?> min</strong> · Vigente desde: <strong><?php echo formatear_fecha($horario->getVigenteDesde()); ?></strong></p>

    <div class="eq05-tabla-envoltura">
      <table class="eq05-tabla">
        <caption>Días de atención</caption>
        <thead>
          <tr>
            <th scope="col">Día</th>
            <th scope="col">Desde</th>
            <th scope="col">Hasta</th>
            <th scope="col">Consultorio</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($horario->getDias() as $clave_dia => $dia): ?>
          <tr>
            <th scope="row"><?php echo $dias_semana[$clave_dia]; ?></th>
            <td><?php echo limpiar($dia['desde']); ?></td>
            <td><?php echo limpiar($dia['hasta']); ?></td>
            <td><?php echo limpiar($dia['consultorio']); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if ($aus_desde !== ''): ?>
    <h2>Ausencia registrada</h2>
    <p>Del <strong><?php echo formatear_fecha($aus_desde); ?></strong> al <strong><?php echo formatear_fecha($aus_hasta); ?></strong> · Motivo: <strong><?php echo limpiar($motivos_ausencia[$aus_motivo] ?? '—'); ?></strong></p>
    <?php if ($aus_nota !== ''): ?>
    <p>Nota interna: <?php echo limpiar($aus_nota); ?></p>
    <?php endif; ?>
    <p>Citas afectadas: <strong><?php echo $total_afectadas; ?></strong> · Forma de reagendar: <?php echo limpiar($estrategias[$estrategia]); ?></p>
    <?php endif; ?>

    <div class="eq05-acciones">
      <a class="eq05-boton eq05-boton--primario" href="secundaria_formulario.php?medico=<?php echo urlencode($horario->getMedico()); ?>">Volver al horario</a>
      <a class="eq05-boton" href="panel.php">Ir a Administración</a>
    </div>
  </main>

<?php require_once 'includes/pie.php'; ?>