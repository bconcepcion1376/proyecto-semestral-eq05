<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina principal_detalle.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/config/datos_demo.php';

// Código de la cita que llega por la URL
$codigo = $_GET['codigo'] ?? '';

// Si la cita no existe, se envía a la página de error ANTES de escribir HTML
if (!isset($citas[$codigo])) {
    redirigir('error.php?codigo=404');
}

// Datos relacionados: se buscan por su clave, como en el listado
$cita     = $citas[$codigo];
$paciente = $pacientes[$cita['expediente']];
$medico   = $medicos[$cita['medico']];
$servicio = $servicios[$cita['servicio']];

// Fecha y hora en español para el subtítulo
$dias  = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
$meses = [1 => 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio',
          'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

$marca = strtotime($cita['fecha'] . ' ' . $cita['hora']);
$texto_fecha = ucfirst($dias[date('w', $marca)]) . ' ' . date('j', $marca)
             . ' de ' . $meses[date('n', $marca)] . ' de ' . date('Y', $marca);
$texto_hora = date('g:i', $marca) . (date('a', $marca) === 'am' ? ' a. m.' : ' p. m.');

// Consultorio: depende del día de la semana en el horario del médico
$claves_dia  = ['dom', 'lun', 'mar', 'mie', 'jue', 'vie', 'sab'];
$clave_dia   = $claves_dia[date('w', $marca)];
$consultorio = $horarios[$cita['medico']]['dias'][$clave_dia]['consultorio'] ?? '';

// Edad del paciente: diferencia de años, menos 1 si todavía no cumplió este año
$nacimiento = strtotime($paciente['nacimiento']);
$edad = date('Y') - date('Y', $nacimiento);
if (date('md') < date('md', $nacimiento)) {
    $edad--;
}

// Se puede reprogramar o cancelar solo si la cita está activa y el paciente no ha llegado
$se_puede_modificar = $estados[$cita['estado']]['activa'] && $cita['estado'] !== 'sala';

$titulo = 'Cita ' . $codigo;
$descripcion = 'Detalle de la cita ' . $codigo . ': datos del paciente, datos de la cita, nota de consulta e historial.';
$pagina_activa = 'citas';
require_once __DIR__ . '/includes/encabezado.php';
?>

<main id="eq05-principal" class="eq05-contenedor">
    <nav class="eq05-migas" aria-label="Ruta de navegación">
      <ol>
        <li><a href="principal_listado.php">Citas</a></li>
        <li><span aria-current="page"><?php echo limpiar($codigo); ?></span></li>
      </ol>
    </nav>
    <div class="eq05-titulo-fila">
      <div>
        <h1>Cita <?php echo limpiar($codigo); ?> <span class="eq05-estado eq05-estado--<?php echo limpiar($cita['estado']); ?>"><?php echo limpiar($estados[$cita['estado']]['texto']); ?></span></h1>
        <p class="eq05-texto-secundario"><time datetime="<?php echo limpiar($cita['fecha'] . 'T' . $cita['hora']); ?>"><?php echo limpiar($texto_fecha . ' · ' . $texto_hora); ?></time> · <?php echo $servicio['minutos']; ?> min<?php if ($consultorio !== ''): ?> · Consultorio <?php echo limpiar($consultorio); ?><?php endif; ?></p>
      </div>
    </div>

    <div class="eq05-dos-columnas">
        <article aria-label="Datos de la cita <?php echo limpiar($codigo); ?>">
        <div class="eq05-fila-campos">
          <section class="eq05-tarjeta" aria-labelledby="eq05-titulo-paciente">
            <h2 id="eq05-titulo-paciente">Paciente</h2>
            <dl class="eq05-datos">
              <dt>Nombre</dt><dd><?php echo limpiar($paciente['nombre']); ?></dd>
              <dt>Documento</dt><dd><?php echo limpiar($paciente['documento']); ?></dd>
              <dt>Edad</dt><dd><?php echo $edad; ?> años</dd>
              <dt>Teléfono</dt><dd><?php echo limpiar($paciente['telefono']); ?></dd>
            </dl>
          </section>
          <section class="eq05-tarjeta" aria-labelledby="eq05-titulo-datos-cita">
            <h2 id="eq05-titulo-datos-cita">Cita</h2>
            <dl class="eq05-datos">
              <dt>Especialidad</dt><dd><?php echo limpiar($especialidades[$cita['especialidad']]); ?></dd>
              <dt>Servicio</dt><dd><?php echo limpiar($servicio['nombre']); ?> (<?php echo $servicio['minutos']; ?> min)</dd>
              <dt>Médico</dt><dd><?php echo limpiar($medico['nombre']); ?></dd>
              <dt>Motivo</dt><dd><?php echo $cita['motivo'] !== '' ? limpiar($cita['motivo']) : 'Sin motivo indicado'; ?></dd>
            </dl>
          </section>
        </div>

        <section class="eq05-tarjeta" aria-labelledby="eq05-titulo-nota">
          <h2 id="eq05-titulo-nota">Nota de consulta</h2>
          <p class="eq05-texto-secundario"><small>Solo la ve y la edita el médico asignado. Se puede corregir durante 24 horas.</small></p>
          
          <form class="eq05-form" id="eq05-form-nota" action="principal_detalle.php?codigo=<?php echo urlencode($codigo); ?>" method="post">
            <fieldset class="eq05-conjunto-campos">
              <legend class="eq05-sr">Formulario de nota de consulta</legend>
              
              <div class="eq05-campo">
                <label for="eq05-nota-observaciones">Observaciones y diagnóstico <span class="eq05-requerido">*</span></label>
                <textarea id="eq05-nota-observaciones" name="observaciones" rows="4" minlength="10" maxlength="2000" placeholder="Escriba la nota de la consulta…" required></textarea>
              </div>
              <div class="eq05-campo">
                <label for="eq05-nota-indicaciones">Indicaciones al paciente</label>
                <textarea id="eq05-nota-indicaciones" name="indicaciones" rows="3" maxlength="1000" placeholder="Medicamentos, exámenes, próxima cita…"></textarea>
              </div>
              <div class="eq05-opcion">
                <input type="checkbox" id="eq05-nota-control" name="requiere_control" value="si">
                <label for="eq05-nota-control">Requiere cita de control</label>
              </div>
              <div class="eq05-acciones">
                <button class="eq05-boton" type="submit" name="accion" value="borrador">Guardar borrador</button>
                <button class="eq05-boton eq05-boton--primario" type="submit" name="accion" value="atendida">Guardar y marcar atendida</button>
              </div>
            </fieldset>
          </form>
        </section>
      </article>

      <aside>
        <section class="eq05-tarjeta" aria-labelledby="eq05-titulo-acciones">
          <h2 id="eq05-titulo-acciones">Acciones</h2>
          <p><button class="eq05-boton eq05-boton--bloque" type="button" <?php echo $se_puede_modificar ? '' : 'disabled'; ?>>Reprogramar</button></p>
          <p><button class="eq05-boton eq05-boton--bloque" type="button" <?php echo $se_puede_modificar ? '' : 'disabled'; ?>>Cancelar cita</button></p>
          <?php if (!$se_puede_modificar): ?>
          <p class="eq05-texto-secundario"><small>No disponibles: <?php echo $cita['estado'] === 'sala' ? 'el paciente ya llegó.' : 'la cita ya no está activa.'; ?></small></p>
          <?php endif; ?>
        </section>
        <section class="eq05-tarjeta" aria-labelledby="eq05-titulo-historial">
          <h2 id="eq05-titulo-historial">Historial</h2>

          <p class="eq05-texto-secundario">Estado actual: <strong><?php echo limpiar($estados[$cita['estado']]['texto']); ?></strong>.</p>
          <p class="eq05-texto-secundario"><small>El historial de cambios estará disponible cuando las citas se guarden en la base de datos.</small></p>
     
        </section>
      </aside>
    </div>
  </main>

  <?php // se anexa la parte de pie de pagina para que se muestre en la pagina de principal_detalle con pie.php 
     require_once __DIR__ . '/includes/pie.php';
      ?>