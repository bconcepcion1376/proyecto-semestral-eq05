<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina principal_formulario.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';

require_once __DIR__ . '/config/datos_demo.php';


// Si procesar_principal.php encontró errores, dejó en la sesión los mensajes,
// el expediente y el motivo. La selección (médico, fecha, hora…) vuelve por la URL.
$errores = $_SESSION['errores_cita'] ?? [];
$datos_cita = $_SESSION['datos_cita'] ?? [];
unset($_SESSION['errores_cita'], $_SESSION['datos_cita']);

// Valores del formulario: llegan por GET al pulsar "Ver horas libres".
// Si no llegan, se usan los de la maqueta; si no son válidos, se ignoran.
$valor_especialidad = $_GET['especialidad'] ?? 'pediatria';
if (!isset($especialidades[$valor_especialidad])) {
    $valor_especialidad = '';
}

$valor_servicio = $_GET['servicio'] ?? 'primera-vez';
if (!isset($servicios[$valor_servicio])) {
    $valor_servicio = '';
}

$valor_medico = $_GET['medico'] ?? 'valdelomar';
if ($valor_medico !== 'cualquiera' && !isset($medicos[$valor_medico])) {
    $valor_medico = 'valdelomar';
}

$valor_fecha = $_GET['fecha'] ?? '2026-11-12';
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $valor_fecha)
    || $valor_fecha < '2026-11-01' || $valor_fecha > '2027-04-02') {
    $valor_fecha = '2026-11-12';
}

$valor_hora = $_GET['hora'] ?? '10:00';
if (!preg_match('/^\d{2}:\d{2}$/', $valor_hora)) {
    $valor_hora = '';
}

// Fecha elegida: texto en español y clave del día para buscar el horario
$dias  = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
$meses = [1 => 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio',
          'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
$claves_dia = ['dom', 'lun', 'mar', 'mie', 'jue', 'vie', 'sab'];

$marca_fecha = strtotime($valor_fecha);
$texto_fecha = ucfirst($dias[date('w', $marca_fecha)]) . ' ' . date('j', $marca_fecha)
             . ' de ' . $meses[date('n', $marca_fecha)];
$clave_dia = $claves_dia[date('w', $marca_fecha)];

// Horas del médico ese día, una cada "duracion" minutos
$horas = [];
$horario_dia = $horarios[$valor_medico]['dias'][$clave_dia] ?? null;
if ($horario_dia !== null) {
    $duracion = $horarios[$valor_medico]['duracion'];
    $actual = strtotime($valor_fecha . ' ' . $horario_dia['desde']);
    $fin    = strtotime($valor_fecha . ' ' . $horario_dia['hasta']);
    while ($actual < $fin) {
        $horas[] = date('H:i', $actual);
        $actual = $actual + $duracion * 60;
    }
}

// Horas ocupadas (R1): citas activas del mismo médico el mismo día
$ocupadas = [];
foreach ($citas as $cita) {
    if ($cita['medico'] === $valor_medico
        && $cita['fecha'] === $valor_fecha
        && $estados[$cita['estado']]['activa']) {
        $ocupadas[] = $cita['hora'];
    }
}

// Citas activas del médico por día (R2: un día con MAX_CITAS_DIA está sin cupo)
$citas_por_dia = [];
foreach ($citas as $cita) {
    if ($cita['medico'] === $valor_medico && $estados[$cita['estado']]['activa']) {
        $citas_por_dia[$cita['fecha']] = ($citas_por_dia[$cita['fecha']] ?? 0) + 1;
    }
}

// Calendario del mes de la fecha elegida
$anio       = (int) date('Y', $marca_fecha);
$mes        = (int) date('n', $marca_fecha);
$primer_dia = mktime(0, 0, 0, $mes, 1, $anio);
$dias_mes   = (int) date('t', $primer_dia);      // cuántos días tiene el mes
$huecos     = (int) date('N', $primer_dia) - 1;  // N: 1 = lunes … 7 = domingo

$motivo_bloqueo = '';   // por qué no se puede reservar el día elegido ('' = sí se puede)
$celdas = array_fill(0, $huecos, null);   // casillas vacías antes del día 1

for ($d = 1; $d <= $dias_mes; $d++) {
    $fecha_dia = sprintf('%04d-%02d-%02d', $anio, $mes, $d);
    $clave_d   = $claves_dia[date('w', strtotime($fecha_dia))];

    $ausente = false;
    foreach ($ausencias as $ausencia) {
        if ($ausencia['medico'] === $valor_medico
            && $fecha_dia >= $ausencia['desde'] && $fecha_dia <= $ausencia['hasta']) {
            $ausente = true;
        }
    }

    if ($clave_d === 'dom') {
        $clase = 'eq05-dia--cerrado';  $titulo_dia = 'Domingo, cerrado';
    } elseif (in_array($fecha_dia, $feriados)) {
        $clase = 'eq05-dia--feriado';  $titulo_dia = 'Feriado';
    } elseif ($ausente) {
        $clase = 'eq05-dia--ausencia'; $titulo_dia = 'Médico ausente';
    } elseif (($citas_por_dia[$fecha_dia] ?? 0) >= MAX_CITAS_DIA) {
        $clase = 'eq05-dia--lleno';    $titulo_dia = 'Sin cupo';
    } elseif ($valor_medico !== 'cualquiera' && !isset($horarios[$valor_medico]['dias'][$clave_d])) {
        $clase = 'eq05-dia--cerrado';  $titulo_dia = 'El médico no atiende este día';
    } else {
        $clase = '';                   $titulo_dia = '';
    }

    if ($fecha_dia === $valor_fecha) {
        $motivo_bloqueo = $titulo_dia;   // se guarda antes de marcarlo como elegido
        $clase = 'eq05-dia--elegido';
        $titulo_dia = 'Día elegido';
    }

    $celdas[] = ['dia' => $d, 'clase' => $clase, 'titulo' => $titulo_dia];
}

// Casillas vacías al final para completar la última semana
while (count($celdas) % 7 !== 0) {
    $celdas[] = null;
}
$semanas = array_chunk($celdas, 7);   // filas de 7 días (lunes a domingo)

// Si el día elegido no se puede reservar, no se ofrecen horas
if ($motivo_bloqueo !== '') {
    $horas = [];
}

// Resumen: textos de lo elegido ('—' si falta)
$resumen_especialidad = $valor_especialidad !== '' ? $especialidades[$valor_especialidad] : '—';
$resumen_servicio = $valor_servicio !== ''
    ? $servicios[$valor_servicio]['nombre'] . ' (' . $servicios[$valor_servicio]['minutos'] . ' min)'
    : '—';
$resumen_medico = $valor_medico !== 'cualquiera' ? $medicos[$valor_medico]['nombre'] : 'Cualquier médico';
$resumen_fecha  = $texto_fecha . ' de ' . $anio;

// La hora solo cuenta si está en la lista de horas y no está ocupada
$hora_valida = in_array($valor_hora, $horas) && !in_array($valor_hora, $ocupadas);
if ($hora_valida) {
    $marca_hora = strtotime($valor_fecha . ' ' . $valor_hora);
    $resumen_hora = date('g:i', $marca_hora) . (date('a', $marca_hora) === 'am' ? ' a. m.' : ' p. m.');
} else {
    $resumen_hora = '—';
}

$resumen_lugar = $horario_dia !== null ? 'Consultorio ' . $horario_dia['consultorio'] : '—';

$titulo = 'Reservar cita';
$descripcion = 'Reserve una cita médica eligiendo especialidad, servicio, médico, fecha y hora disponibles.';
$pagina_activa = 'reservar';
require_once __DIR__ . '/includes/encabezado.php';
?>

  <main id="eq05-principal" class="eq05-contenedor">
    <nav class="eq05-migas" aria-label="Ruta de navegación">
      <ol>
        <li><a href="index.php">Inicio</a></li>
        <li><span aria-current="page">Reservar cita</span></li>
      </ol>
    </nav>
    <h1>Reservar cita</h1>
      <p class="eq05-subtitulo">Solo verá días y horas que la clínica y el médico tienen disponibles.</p>
      <?php if (!empty($errores)): ?>
      <div class="eq05-aviso eq05-aviso--error" role="alert">
        <img src="img/iconos/advertencia.svg" alt="Icono de advertencia" width="22" height="22">
      <div>
        <h2>No se pudo reservar la cita</h2>
        <?php mostrar_errores($errores); ?>
      </div>
    </div>
    <?php endif; ?>
    <form class="eq05-form eq05-dos-columnas" id="eq05-form-cita" action="procesar_principal.php" method="post">
      <div>
        <fieldset>
          <legend>1 · ¿Qué necesita?</legend>
          
          <div class="eq05-campo">
            <label for="eq05-cita-paciente">Paciente <small class="eq05-texto-secundario">(solo Recepción)</small></label>
            <input type="search" id="eq05-cita-paciente" name="paciente" placeholder="Buscar por nombre o cédula" maxlength="80" autocomplete="off">
            <span class="eq05-ayuda">Recepción puede reservar en nombre de un paciente. El paciente reserva para sí mismo.</span>
          </div>

          <?php // Campo asignado: número de expediente de 6 dígitos ?>
          <div class="eq05-campo">
            <label for="eq05-cita-expediente">Número de expediente <span class="eq05-requerido">*</span></label>
            <input type="text" id="eq05-cita-expediente" name="numero_expediente" value="<?php echo limpiar($datos_cita['numero_expediente'] ?? ''); ?>" placeholder="Ej. 123456" 
                   pattern="\d{6}" minlength="6" maxlength="6" inputmode="numeric" 
                   autocomplete="off" required>
            <span class="eq05-ayuda">Debe contener exactamente 6 dígitos numéricos.</span>
          </div>

          <div class="eq05-fila-campos">
            <div class="eq05-campo">
              <label for="eq05-cita-especialidad">Especialidad <span class="eq05-requerido">*</span></label>
              <select id="eq05-cita-especialidad" name="especialidad" required>
                <option value="">Seleccione…</option>
                <?php foreach ($especialidades as $clave => $nombre): ?>
                <option value="<?php echo limpiar($clave); ?>" <?php echo $clave === $valor_especialidad ? 'selected' : ''; ?>><?php echo limpiar($nombre); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="eq05-campo">
              <label for="eq05-cita-servicio">Servicio <span class="eq05-requerido">*</span></label>
              <select id="eq05-cita-servicio" name="servicio" required>
                <option value="">Seleccione…</option>
                <?php foreach ($servicios as $clave => $servicio): ?>
                <option value="<?php echo limpiar($clave); ?>" <?php echo $clave === $valor_servicio ? 'selected' : ''; ?>><?php echo limpiar($servicio['nombre']); ?> · <?php echo $servicio['minutos']; ?> min</option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>2 · Médico</legend>
          <div class="eq05-tarjetas-radio">
            <?php foreach ($medicos as $clave => $medico): ?>
            <label class="eq05-tarjeta-radio"><input type="radio" name="medico" value="<?php echo limpiar($clave); ?>" <?php echo $clave === $valor_medico ? 'checked' : ''; ?>><span><strong><?php echo limpiar($medico['nombre']); ?></strong><br><small class="eq05-texto-secundario"><?php echo limpiar($especialidades[$medico['especialidad']]); ?></small></span></label>
            <?php endforeach; ?>
            <label class="eq05-tarjeta-radio"><input type="radio" name="medico" value="cualquiera" <?php echo $valor_medico === 'cualquiera' ? 'checked' : ''; ?>><span><strong>Cualquier médico</strong><br><small class="eq05-texto-secundario">El primer espacio libre</small></span></label>
          </div>
        </fieldset>

        <fieldset>
          <legend>3 · Fecha y hora</legend>
          <div class="eq05-fecha-hora">
            <div>
              <table class="eq05-calendario">
                <caption>Disponibilidad de <?php echo limpiar($meses[$mes]); ?> de <?php echo $anio; ?></caption>
                <thead><tr><th scope="col"><abbr title="lunes">Lun</abbr></th><th scope="col"><abbr title="martes">Mar</abbr></th><th scope="col"><abbr title="miércoles">Mié</abbr></th><th scope="col"><abbr title="jueves">Jue</abbr></th><th scope="col"><abbr title="viernes">Vie</abbr></th><th scope="col"><abbr title="sábado">Sáb</abbr></th><th scope="col"><abbr title="domingo">Dom</abbr></th></tr></thead>
                <tbody>
                  <?php foreach ($semanas as $semana): ?>
                  <tr>
                    <?php foreach ($semana as $celda): ?>
                      <?php if ($celda === null): ?>
                    <td></td>
                      <?php else: ?>
                    <td<?php if ($celda['clase'] !== ''): ?> class="<?php echo $celda['clase']; ?>" title="<?php echo limpiar($celda['titulo']); ?>"<?php endif; ?>><?php echo $celda['dia']; ?></td>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <ul class="eq05-leyenda" aria-label="Leyenda del calendario">
                <li>Disponible</li>
                <li class="eq05-l-elegido">Elegido</li>
                <li class="eq05-l-feriado">Feriado o carnaval</li>
                <li class="eq05-l-ausencia">Ausencia del médico</li>
                <li class="eq05-l-lleno">Sin cupo</li>
                <li class="eq05-l-cerrado">Cerrado</li>
              </ul>
            </div>
            <div>
              <div class="eq05-campo">
                <label for="eq05-cita-fecha">Fecha <span class="eq05-requerido">*</span></label>
                <input type="date" id="eq05-cita-fecha" name="fecha" value="<?php echo limpiar($valor_fecha); ?>" min="2026-11-01" max="2027-04-02" required>
                <span class="eq05-ayuda"><strong>Nota:</strong> Las citas deben solicitarse con al menos 24 horas de anticipación.</span>
                <button class="eq05-boton" type="submit" formaction="principal_formulario.php" formmethod="get" formnovalidate>Ver horas libres</button>
              </div>
              <fieldset>
                <legend>Horas libres del <?php echo limpiar($texto_fecha); ?></legend>
                <div class="eq05-horas">
                  <?php if ($valor_medico === 'cualquiera'): ?>
                  <p class="eq05-texto-secundario">Elija un médico para ver sus horas libres.</p>
                  <?php elseif ($motivo_bloqueo !== ''): ?>
                  <p class="eq05-texto-secundario">No hay horas este día: <?php echo limpiar($motivo_bloqueo); ?>.</p>
                  <?php endif; ?>
                  <?php foreach ($horas as $hora): ?>
                    <?php if (in_array($hora, $ocupadas)): ?>
                  <label class="eq05-hora"><input type="radio" name="hora" value="<?php echo limpiar($hora); ?>" disabled><span><?php echo limpiar(ltrim($hora, '0')); ?><span class="eq05-sr"> (ocupado)</span></span></label>
                    <?php else: ?>
                  <label class="eq05-hora"><input type="radio" name="hora" value="<?php echo limpiar($hora); ?>" <?php echo $hora === $valor_hora ? 'checked' : ''; ?> required><span><?php echo limpiar(ltrim($hora, '0')); ?></span></label>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </div>
              </fieldset>
            </div>
          </div>
        </fieldset>

        <div class="eq05-campo">
          <label for="eq05-cita-motivo">Motivo de la consulta (opcional)</label>
          <textarea id="eq05-cita-motivo" name="motivo" rows="3" maxlength="300" placeholder="Describa brevemente el motivo…"><?php echo limpiar($datos_cita['motivo'] ?? ''); ?></textarea>
        </div>
      </div>

      <aside class="eq05-tarjeta eq05-resumen" aria-labelledby="eq05-titulo-resumen">
        <h2 id="eq05-titulo-resumen">Resumen</h2>
        <dl class="eq05-datos">
          <dt>Especialidad</dt><dd><?php echo limpiar($resumen_especialidad); ?></dd>
          <dt>Servicio</dt><dd><?php echo limpiar($resumen_servicio); ?></dd>
          <dt>Médico</dt><dd><?php echo limpiar($resumen_medico); ?></dd>
          <dt>Fecha</dt><dd><time datetime="<?php echo limpiar($valor_fecha); ?>"><?php echo limpiar($resumen_fecha); ?></time></dd>
          <dt>Hora</dt><dd><?php if ($hora_valida): ?><time datetime="<?php echo limpiar($valor_hora); ?>"><?php echo limpiar($resumen_hora); ?></time><?php else: ?>—<?php endif; ?></dd>
          <dt>Lugar</dt><dd><?php echo limpiar($resumen_lugar); ?></dd>
        </dl>
        <button class="eq05-boton eq05-boton--primario eq05-boton--bloque" type="submit">Confirmar cita</button>
        <p><a href="principal_listado.php">Cancelar</a></p>
        <p class="eq05-texto-secundario"><small>Puede reprogramar o cancelar con al menos 24 horas de anticipación.</small></p>
      </aside>
    </form>
  </main>

  <?php // se anexa la parte de pie de pagina para que se muestre en la pagina de principal_formulario con pie.php 
     require_once __DIR__ . '/includes/pie.php';
      ?>