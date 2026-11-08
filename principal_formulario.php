<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina principal_formulario.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';

require_once __DIR__ . '/config/datos_demo.php';

// Valores iniciales del formulario (los mismos de la maqueta).
// En la fase 3 vendrán de lo que el usuario envió si hubo errores.
$valor_especialidad = 'pediatria';
$valor_servicio     = 'primera-vez';
$valor_medico       = 'valdelomar';
$valor_fecha        = '2026-11-12';
$valor_hora         = '10:00';

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
            <input type="text" id="eq05-cita-expediente" name="numero_expediente" placeholder="Ej. 123456" 
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
            <label class="eq05-tarjeta-radio"><input type="radio" name="medico" value="arias"><span><strong>Dr. José Arias</strong><br><small class="eq05-texto-secundario">Próximo: jue 12 nov, 8:00</small></span></label>
            <label class="eq05-tarjeta-radio"><input type="radio" name="medico" value="rios"><span><strong>Dra. Carmen Ríos</strong><br><small class="eq05-texto-secundario">Próximo: vie 13 nov, 15:00</small></span></label>
            <label class="eq05-tarjeta-radio"><input type="radio" name="medico" value="vega"><span><strong>Dra. Laura Vega</strong><br><small class="eq05-texto-secundario">Próximo: jue 12 nov, 10:00</small></span></label>
            <label class="eq05-tarjeta-radio"><input type="radio" name="medico" value="cualquiera"><span><strong>Cualquier médico</strong><br><small class="eq05-texto-secundario">El primer espacio libre</small></span></label>
            <?php //Datos Semillas: Se pueden agregar más médicos según la especialidad ?>
            <label class="eq05-tarjeta-radio"><input type="radio" name="medico" value="valdelomar" checked><span><strong>Dr. Ignacio Valdelomar</strong><br><small class="eq05-texto-secundario">Próximo: jue 12 nov, 08:00</small></span></label>
            <label class="eq05-tarjeta-radio"><input type="radio" name="medico" value="zamudio"><span><strong>Dra. Pilar Zamudio</strong><br><small class="eq05-texto-secundario">Próximo: lun 16 nov, 10:30</small></span></label>            
            
          </div>
        </fieldset>

        <fieldset>
          <legend>3 · Fecha y hora</legend>
          <div class="eq05-fecha-hora">
            <div>
              <table class="eq05-calendario">
                <caption>Disponibilidad de noviembre de 2026</caption>
                <thead><tr><th scope="col"><abbr title="lunes">Lun</abbr></th><th scope="col"><abbr title="martes">Mar</abbr></th><th scope="col"><abbr title="miércoles">Mié</abbr></th><th scope="col"><abbr title="jueves">Jue</abbr></th><th scope="col"><abbr title="viernes">Vie</abbr></th><th scope="col"><abbr title="sábado">Sáb</abbr></th><th scope="col"><abbr title="domingo">Dom</abbr></th></tr></thead>
                <tbody>
                   <tr><td></td><td></td><td></td><td></td><td></td><td></td><td class="eq05-dia--cerrado" title="Domingo, cerrado">1</td></tr>
                   <tr><td>2</td><td class="eq05-dia--feriado" title="Separación de Panamá de Colombia">3</td>
                       <td class="eq05-dia--feriado" title="Día de la Bandera">4</td>
                       <td class="eq05-dia--feriado" title="Día de Colón">5</td>
                       <td>6</td><td>7</td><td class="eq05-dia--cerrado" title="Domingo, cerrado">8</td>
                   </tr>
                    <tr><td>9</td><td class="eq05-dia--feriado" title="Primer Grito de Independencia">10</td>
                        <td>11</td><td class="eq05-dia--elegido" title="Día elegido">12</td>
                        <td>13</td><td>14</td><td class="eq05-dia--cerrado" title="Domingo, cerrado">15</td>
                   </tr>
                   <tr><td>16</td><td>17</td><td class="eq05-dia--lleno" title="Sin cupo">18</td>
                       <td class="eq05-dia--ausencia" title="Médico ausente">19</td><td class="eq05-dia--ausencia" title="Médico ausente">20</td><td>21</td>
                       <td class="eq05-dia--cerrado" title="Domingo, cerrado">22</td>
                   </tr>
                   <tr><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td class="eq05-dia--feriado" title="Independencia de España">28</td>
                       <td class="eq05-dia--cerrado" title="Domingo, cerrado">29</td>
                   </tr>
                   <tr><td>30</td><td></td><td></td><td></td><td></td><td></td><td></td></tr> 
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
                
                <input type="date" id="eq05-cita-fecha" name="fecha" value="2026-11-12" min="2026-11-01" max="2027-04-02" required>
                <span class="eq05-ayuda"><strong>Nota:</strong> Las citas deben solicitarse con al menos 24 horas de anticipación.</span>
              </div>
              <fieldset>
                <legend>Horas libres del Jueves 12 de noviembre</legend>
                <div class="eq05-horas">
                  <label class="eq05-hora"><input type="radio" name="hora" value="08:00" required><span>8:00</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="08:30" required><span>8:30</span></label>
                 
                  <label class="eq05-hora"><input type="radio" name="hora" value="09:00" required><span>9:00</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="09:30" disabled><span>9:30<span class="eq05-sr"> (ocupado)</span></span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="10:00" checked required><span>10:00</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="10:30" required><span>10:30</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="11:00" disabled><span>11:00<span class="eq05-sr"> (ocupado)</span></span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="11:30" required><span>11:30</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="13:30" required><span>13:30</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="14:00" required><span>14:00</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="14:30" required><span>14:30</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="15:00" required><span>15:00</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="15:30" required><span>15:30</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="16:00" required><span>16:00</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="16:30" required><span>16:30</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="17:00" required><span>17:00</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="17:30" required><span>17:30</span></label>
                </div>
              </fieldset>
            </div>
          </div>
        </fieldset>

        <div class="eq05-campo">
          <label for="eq05-cita-motivo">Motivo de la consulta (opcional)</label>
          <textarea id="eq05-cita-motivo" name="motivo" rows="3" maxlength="300" placeholder="Describa brevemente el motivo…"></textarea>
        </div>
      </div>

      <aside class="eq05-tarjeta eq05-resumen" aria-labelledby="eq05-titulo-resumen">
        <h2 id="eq05-titulo-resumen">Resumen</h2>
        <dl class="eq05-datos">
          <dt>Especialidad</dt><dd>Pediatría</dd>
          <dt>Servicio</dt><dd>Primera vez (30 min)</dd>
          <dt>Médico</dt><dd>Dr. Ignacio Valdelomar</dd>
          <dt>Fecha</dt><dd><time datetime="2026-11-12">Jue 12 Nov 2026</time></dd>
          <dt>Hora</dt><dd><time datetime="10:00">10:00 a. m.</time></dd>
          <dt>Lugar</dt><dd>Consultorio 204</dd>
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