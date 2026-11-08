<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina secundaria_formulario.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';

require_once __DIR__ . '/config/datos_demo.php';

$valor_medico = $_GET['medico'] ?? 'rios'; // Valor predeterminado si no se proporciona un médico
if (!isset($medicos[$valor_medico])) {
    $valor_medico = 'rios'; // Valor predeterminado si el médico no existe
}

$medico  = $medicos[$valor_medico];
$horario = $horarios[$valor_medico] ?? null;

// Días de la tabla (clave => nombre visible) y consultorios disponibles
$dias_semana = ['lun' => 'Lunes', 'mar' => 'Martes', 'mie' => 'Miércoles',
                'jue' => 'Jueves', 'vie' => 'Viernes', 'sab' => 'Sábado'];
$consultorios = ['101', '204', '206'];

$titulo = 'Horario de ' . $medico['nombre'];
$descripcion = 'Configure el horario semanal de cada médico y registre ausencias con reagendado automático de citas.';
$pagina_activa = 'horarios';
require_once __DIR__ . '/includes/encabezado.php';

?>
  <main id="eq05-principal" class="eq05-contenedor">
    <nav class="eq05-migas" aria-label="Ruta de navegación">
      <ol>
        <li><a href="panel.php">Administración</a></li>
        <li><a href="secundaria_formulario.php">Horarios</a></li>
        <li><span aria-current="page"><?php echo limpiar($medico['nombre']); ?></span></li>
      </ol>
    </nav>
    <h1>Horario del médico</h1>
    <p class="eq05-subtitulo">Defina cuándo atiende cada médico y registre sus ausencias. Los feriados y el carnaval se bloquean solos aunque el día tenga horario.</p>

      <form class="eq05-form" id="eq05-form-horario" action="procesar_secundaria.php" method="post">
      <div class="eq05-campo">
        <label for="eq05-hor-medico">Médico <span class="eq05-requerido">*</span></label>
        <select id="eq05-hor-medico" name="medico" required>
          <option value="">Seleccione…</option>
          <?php foreach ($medicos as $clave_medico => $datos_medico): ?>
          <option value="<?php echo limpiar($clave_medico); ?>" <?php echo $clave_medico === $valor_medico ? 'selected' : ''; ?>><?php echo limpiar($datos_medico['nombre']); ?> · <?php echo limpiar($especialidades[$datos_medico['especialidad']]); ?></option>
          <?php endforeach; ?>
        </select>
        <button class="eq05-boton" type="submit" formaction="secundaria_formulario.php" formmethod="get" formnovalidate>Ver horario</button>        
      </div>

      <div class="eq05-dos-columnas">
        <fieldset>
          <legend>Horario semanal</legend>
          <div class="eq05-tabla-envoltura">
            <table class="eq05-tabla">
              <caption>Días y horas de atención · <?php echo limpiar($medico['nombre']); ?></caption>
              <thead>
                <tr>
                  <th scope="col">Día</th>
                  <th scope="col">Desde</th>
                  <th scope="col">Hasta</th>
                  <th scope="col">Consultorio</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($dias_semana as $clave_dia => $nombre_dia): ?>
              <?php $dia = $horario['dias'][$clave_dia] ?? null; ?>
              <tr>
                <th scope="row">
                  <span class="eq05-opcion"><input type="checkbox" id="eq05-hor-<?php echo $clave_dia; ?>" name="<?php echo $clave_dia; ?>_atiende" value="si" <?php echo $dia !== null ? 'checked' : ''; ?>><label for="eq05-hor-<?php echo $clave_dia; ?>"><?php echo $nombre_dia; ?></label></span>
                </th>
                <td><label class="eq05-sr" for="eq05-hor-<?php echo $clave_dia; ?>-desde"><?php echo $nombre_dia; ?>, desde</label><input type="time" id="eq05-hor-<?php echo $clave_dia; ?>-desde" name="<?php echo $clave_dia; ?>_desde" min="07:00" max="19:00" step="1800" value="<?php echo limpiar($dia['desde'] ?? ''); ?>"></td>
                <td><label class="eq05-sr" for="eq05-hor-<?php echo $clave_dia; ?>-hasta"><?php echo $nombre_dia; ?>, hasta</label><input type="time" id="eq05-hor-<?php echo $clave_dia; ?>-hasta" name="<?php echo $clave_dia; ?>_hasta" min="07:00" max="19:00" step="1800" value="<?php echo limpiar($dia['hasta'] ?? ''); ?>"></td>
                <td><label class="eq05-sr" for="eq05-hor-<?php echo $clave_dia; ?>-consultorio"><?php echo $nombre_dia; ?>, consultorio</label>
                  <select id="eq05-hor-<?php echo $clave_dia; ?>-consultorio" name="<?php echo $clave_dia; ?>_consultorio">
                    <?php foreach ($consultorios as $numero): ?>
                    <option value="<?php echo $numero; ?>" <?php echo $numero === ($dia['consultorio'] ?? '') ? 'selected' : ''; ?>><?php echo $numero; ?></option>
                    <?php endforeach; ?>
                    <option value="" <?php echo $dia === null ? 'selected' : ''; ?>>—</option>
                  </select>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            </table>
          </div>
          <p class="eq05-texto-secundario"><small>Domingo: la clínica no atiende.</small></p>
          <div class="eq05-fila-campos">
            <div class="eq05-campo">
              <label for="eq05-hor-duracion">Duración de cada espacio (min) <span class="eq05-requerido">*</span></label>
              <input type="number" id="eq05-hor-duracion" name="duracion" value="<?php echo limpiar($horario['duracion'] ?? 30); ?>" min="10" max="120" step="10" required>
            </div>
            <div class="eq05-campo">
              <label for="eq05-hor-vigencia">Vigente desde <span class="eq05-requerido">*</span></label>
              <input type="date" id="eq05-hor-vigencia" name="vigente_desde" value="<?php echo limpiar($horario['vigente_desde'] ?? '2026-11-01'); ?>" min="2026-11-01" max="2027-04-02" required>
            </div>
          </div>
        </fieldset>

        <div>
          <fieldset id="eq05-ausencia">
            <legend>Registrar ausencia</legend>
            <div class="eq05-fila-campos">
              <div class="eq05-campo">
                <label for="eq05-aus-desde">Desde</label>
                <input type="date" id="eq05-aus-desde" name="ausencia_desde" value="2027-02-15" min="2027-02-01">
              </div>
              <div class="eq05-campo">
                <label for="eq05-aus-hasta">Hasta</label>
                <input type="date" id="eq05-aus-hasta" name="ausencia_hasta" value="2027-02-16" min="2027-02-01">
              </div>
            </div>
            <div class="eq05-campo">
              <label for="eq05-aus-motivo">Motivo</label>
              <select id="eq05-aus-motivo" name="ausencia_motivo">
                <option value="congreso" selected>Congreso médico</option>
                <option value="vacaciones">Vacaciones</option>
                <option value="incapacidad">Incapacidad</option>
                <option value="otro">Otro</option>
              </select>
            </div>
            <div class="eq05-campo">
              <label for="eq05-aus-nota">Nota interna</label>
              <textarea id="eq05-aus-nota" name="ausencia_nota" rows="2" maxlength="200" placeholder="Opcional"></textarea>
            </div>
          </fieldset>
        </div>
      </div>

      <section class="eq05-aviso eq05-aviso--advertencia" aria-labelledby="eq05-titulo-impacto">
        <img src="img/iconos/advertencia.svg" alt="Icono de advertencia" width="22" height="22">
        <div>
          <h2 id="eq05-titulo-impacto">Esta ausencia afecta 9 citas programadas</h2>
          <p>Al guardar, el sistema propondrá el <strong>siguiente espacio libre</strong> de la Dra. Ríos para cada una. El paciente verá la nueva fecha al ingresar y podrá cambiarla.</p>
          <div class="eq05-tabla-envoltura">
            <table class="eq05-tabla">
              <caption>Vista previa del reagendado (3 de 9 citas)</caption>
              <thead>
                <tr>
                  <th scope="col">Paciente</th>
                  <th scope="col">Cita actual</th>
                  <th scope="col">Nueva fecha propuesta</th>
                </tr>
              </thead>
              <tbody>
              <tr>
                <th scope="row">Jorge Batista</th>
                <td><time datetime="2027-02-15T08:00">Lun 15 feb · 8:00</time></td>
                <td><strong><time datetime="2027-02-17T13:00">Mié 17 feb · 13:00</time></strong></td>
              </tr>
              <tr>
                <th scope="row">Rosa Méndez</th>
                <td><time datetime="2027-02-15T08:30">Lun 15 feb · 8:30</time></td>
                <td><strong><time datetime="2027-02-17T13:30">Mié 17 feb · 13:30</time></strong></td>
              </tr>
              <tr>
                <th scope="row">Iván Torres</th>
                <td><time datetime="2027-02-16T09:00">Mar 16 feb · 9:00</time></td>
                <td><strong><time datetime="2027-02-18T08:00">Jue 18 feb · 8:00</time></strong></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <fieldset>
        <legend>¿Cómo reagendar las citas afectadas?</legend>
        <div class="eq05-opcion"><input type="radio" id="eq05-aus-misma" name="estrategia" value="mismo_medico" checked><label for="eq05-aus-misma">Con la misma médica, en su siguiente espacio libre</label></div>
        <div class="eq05-opcion"><input type="radio" id="eq05-aus-otro" name="estrategia" value="otro_medico"><label for="eq05-aus-otro">Permitir otro médico de la misma especialidad</label></div>
      </fieldset>

      <div class="eq05-acciones">
        <button class="eq05-boton eq05-boton--primario" type="submit">Guardar y reagendar 9 citas</button>
        <a class="eq05-boton" href="panel.php">Cancelar</a>
      </div>
    </form>
  </main>

  <?php // se anexa la parte de pie de pagina para que se muestre en la pagina de secundaria_formulario con pie.php
     require_once __DIR__ . '/includes/pie.php';
      ?>