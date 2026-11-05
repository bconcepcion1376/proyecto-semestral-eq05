<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Reserve una cita médica eligiendo especialidad, servicio, médico, fecha y hora disponibles.">
  <title>Reservar cita · MediAgenda</title>
  <link rel="icon" href="img/logo.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap">
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
  <header id="eq05-encabezado">
    <div class="eq05-contenedor eq05-encabezado__barra">
      <a class="eq05-logo" href="index.php">
        <img src="img/logo.svg" alt="Logo de MediAgenda" width="36" height="36">
        <span>MediAgenda</span>
      </a>
      <input class="eq05-menu-check" type="checkbox" id="eq05-menu-check">
      <label class="eq05-menu-boton" for="eq05-menu-check"><span class="eq05-sr">Abrir o cerrar el menú</span><span aria-hidden="true">☰</span></label>
      <nav class="eq05-nav" id="eq05-nav-principal" aria-label="Principal">
        <ul class="eq05-nav__lista">
          <li><a class="eq05-nav__enlace" href="index.php">Inicio</a></li>
          <li><a class="eq05-nav__enlace eq05-nav__enlace--activo" href="principal_formulario.php" aria-current="page">Reservar cita</a></li>
          <li><a class="eq05-nav__enlace" href="principal_listado.php">Citas</a></li>
          <li><a class="eq05-nav__enlace" href="secundaria_formulario.php">Horarios</a></li>
          <li><a class="eq05-nav__enlace" href="panel.php">Administración</a></li>
        </ul>
        <div class="eq05-cuenta">
          <img src="img/iconos/campana.svg" alt="Avisos: 1 sin leer" width="22" height="22">
          <a class="eq05-cuenta__usuario" href="perfil.php">
            <img class="eq05-avatar" src="img/avatar.svg" alt="Avatar de usuario" width="36" height="36">
            <span><strong>Ana Pérez</strong><span class="eq05-cuenta__rol">Paciente · Mi perfil</span></span>
          </a>
          <a class="eq05-boton eq05-boton--claro eq05-boton--pequeno" href="index.php">Salir</a>
        </div>
      </nav>
    </div>
  </header>

  <main id="eq05-principal" class="eq05-contenedor">
    <nav class="eq05-migas" aria-label="Ruta de navegación">
      <ol>
        <li><a href="index.php">Inicio</a></li>
        <li><span aria-current="page">Reservar cita</span></li>
      </ol>
    </nav>
    <h1>Reservar cita</h1>
    <p class="eq05-subtitulo">Solo verá días y horas que la clínica y el médico tienen disponibles.</p>

    <!-- CORRECCIÓN 1: method="post" y action="#" según la rúbrica -->
    <form class="eq05-form eq05-dos-columnas" id="eq05-form-cita" action="#" method="post">
      <div>
        <fieldset>
          <legend>1 · ¿Qué necesita?</legend>
          
          <div class="eq05-campo">
            <label for="eq05-cita-paciente">Paciente <small class="eq05-texto-secundario">(solo Recepción)</small></label>
            <input type="search" id="eq05-cita-paciente" name="paciente" placeholder="Buscar por nombre o cédula" maxlength="80" autocomplete="off">
            <span class="eq05-ayuda">Recepción puede reservar en nombre de un paciente. El paciente reserva para sí mismo.</span>
          </div>

          <!-- CORRECCIÓN 2: CAMPO ESPECIAL ASIGNADO (Número de expediente: 6 dígitos) -->
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
                <option value="medicina-general">Medicina general</option>
                <option value="pediatria" selected>Pediatría</option>
                <option value="cardiologia">Cardiología</option>
                <option value="ginecologia">Ginecología</option>
                <option value="dermatologia">Dermatología</option>
                <option value="ortopedia">Ortopedia</option>
              </select>
            </div>
            <div class="eq05-campo">
              <label for="eq05-cita-servicio">Servicio <span class="eq05-requerido">*</span></label>
              <select id="eq05-cita-servicio" name="servicio" required>
                <option value="">Seleccione…</option>
                <option value="primera-vez" selected>Consulta de primera vez · 30 min</option>
                <option value="control">Control · 20 min</option>
                <option value="resultados">Lectura de resultados · 15 min</option>
              </select>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>2 · Médico</legend>
          <div class="eq05-tarjetas-radio">
            <label class="eq05-tarjeta-radio"><input type="radio" name="medico" value="arias"><span><strong>Dr. José Arias</strong><br><small class="eq05-texto-secundario">Próximo: jue 12 nov, 8:00</small></span></label>
            <label class="eq05-tarjeta-radio"><input type="radio" name="medico" value="rios"><span><strong>Dra. Carmen Ríos</strong><br><small class="eq05-texto-secundario">Próximo: vie 13 nov, 15:00</small></span></label>
            <label class="eq05-tarjeta-radio"><input type="radio" name="medico" value="cualquiera"><span><strong>Cualquier médico</strong><br><small class="eq05-texto-secundario">El primer espacio libre</small></span></label>
            <!-- Datos Semillas: Se pueden agregar más médicos según la especialidad -->
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
                <!-- CORRECCIÓN 3: Regla de negocio de 24 horas de anticipación reflejada en min y texto -->
                <input type="date" id="eq05-cita-fecha" name="fecha" value="2026-11-12" min="2026-11-01" max="2027-04-02" required>
                <span class="eq05-ayuda"><strong>Nota:</strong> Las citas deben solicitarse con al menos 24 horas de anticipación.</span>
              </div>
              <fieldset>
                <legend>Horas libres del Jueves 12 de noviembre</legend>
                <div class="eq05-horas">
                  <label class="eq05-hora"><input type="radio" name="hora" value="08:00" required><span>8:00</span></label>
                  <label class="eq05-hora"><input type="radio" name="hora" value="08:30" required><span>8:30</span></label>
                  <!-- CORRECCIÓN 4: Se quitó 'required' de los inputs deshabilitados -->
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

  <footer id="eq05-pie">
    <div class="eq05-contenedor eq05-pie__barra">
      <p><strong>MediAgenda</strong> · Clínicas Minimed, Ciudad de Panamá</p>
      <nav aria-label="Enlaces del pie de página">
        <ul class="eq05-pie__enlaces">
          <li><a href="index.php#eq05-como-funciona">Ayuda</a></li>
          <li><a href="legal.php#eq05-privacidad">Privacidad</a></li>
          <li><a href="legal.php#eq05-terminos">Términos</a></li>
          <li><a href="index.php#eq05-contacto">Contacto</a></li>
        </ul>
      </nav>
      <p><small>© 2026 MediAgenda · Proyecto semestral, equipo 05</small></p>
    </div>
  </footer>
</body>
</html>