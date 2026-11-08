<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Configure el horario semanal de cada médico y registre ausencias con reagendado automático de citas.">
  <title>Horario del médico · MediAgenda</title>
  <link rel="icon" href="img/logo.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap">
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
  <header id="eq05-encabezado">
    <div class="eq05-contenedor eq05-encabezado__barra">
      <!-- CORRECCIÓN: alt descriptivo para evitar warnings en W3C -->
      <a class="eq05-logo" href="index.html">
        <img src="img/logo.svg" alt="Logo de MediAgenda" width="36" height="36">
        <span>MediAgenda</span>
      </a>
      <input class="eq05-menu-check" type="checkbox" id="eq05-menu-check">
      <label class="eq05-menu-boton" for="eq05-menu-check"><span class="eq05-sr">Abrir o cerrar el menú</span><span aria-hidden="true">☰</span></label>
      <nav class="eq05-nav" id="eq05-nav-principal" aria-label="Principal">
        <ul class="eq05-nav__lista">
          <li><a class="eq05-nav__enlace" href="index.html">Inicio</a></li>
          <li><a class="eq05-nav__enlace" href="principal-formulario.html">Reservar cita</a></li>
          <li><a class="eq05-nav__enlace" href="principal-listado.html">Citas</a></li>
          <li><a class="eq05-nav__enlace eq05-nav__enlace--activo" href="secundaria-formulario.html" aria-current="page">Horarios</a></li>
          <li><a class="eq05-nav__enlace" href="panel.html">Administración</a></li>
        </ul>
        <div class="eq05-cuenta">
          <img src="img/iconos/campana.svg" alt="Avisos: 1 sin leer" width="22" height="22">
          <a class="eq05-cuenta__usuario" href="perfil.html">
            <img class="eq05-avatar" src="img/avatar.svg" alt="Avatar de usuario" width="36" height="36">
            <span><strong>Marta Díaz</strong><span class="eq05-cuenta__rol">Administrador · Mi perfil</span></span>
          </a>
          <a class="eq05-boton eq05-boton--claro eq05-boton--pequeno" href="index.html">Salir</a>
        </div>
      </nav>
    </div>
  </header>

  <main id="eq05-principal" class="eq05-contenedor">
    <nav class="eq05-migas" aria-label="Ruta de navegación">
      <ol>
        <li><a href="panel.html">Administración</a></li>
        <li><a href="secundaria-formulario.html">Horarios</a></li>
        <li><span aria-current="page">Dra. Carmen Ríos</span></li>
      </ol>
    </nav>
    <h1>Horario del médico</h1>
    <p class="eq05-subtitulo">Defina cuándo atiende cada médico y registre sus ausencias. Los feriados y el carnaval se bloquean solos aunque el día tenga horario.</p>

    <!-- CORRECCIÓN: method="post" y action="#" según la rúbrica -->
    <form class="eq05-form" id="eq05-form-horario" action="#" method="post">
      <div class="eq05-campo">
        <label for="eq05-hor-medico">Médico <span class="eq05-requerido">*</span></label>
        <select id="eq05-hor-medico" name="medico" required>
          <option value="">Seleccione…</option>
          <option value="rios" selected>Dra. Carmen Ríos · Cardiología</option>
          <option value="arias">Dr. José Arias · Medicina general</option>
          <option value="vega">Dra. Laura Vega · Pediatría</option>
        </select>
      </div>

      <div class="eq05-dos-columnas">
        <fieldset>
          <legend>Horario semanal</legend>
          <div class="eq05-tabla-envoltura">
            <table class="eq05-tabla">
              <caption>Días y horas de atención de la Dra. Carmen Ríos</caption>
              <thead>
                <tr>
                  <th scope="col">Día</th>
                  <th scope="col">Desde</th>
                  <th scope="col">Hasta</th>
                  <th scope="col">Consultorio</th>
                </tr>
              </thead>
              <tbody>
              <tr>
                <th scope="row">
                  <span class="eq05-opcion"><input type="checkbox" id="eq05-hor-lun" name="lun_atiende" value="si" checked><label for="eq05-hor-lun">Lunes</label></span>
                </th>
                <td><label class="eq05-sr" for="eq05-hor-lun-desde">Lunes, desde</label><input type="time" id="eq05-hor-lun-desde" name="lun_desde" min="07:00" max="19:00" step="1800" value="08:00"></td>
                <td><label class="eq05-sr" for="eq05-hor-lun-hasta">Lunes, hasta</label><input type="time" id="eq05-hor-lun-hasta" name="lun_hasta" min="07:00" max="19:00" step="1800" value="12:00"></td>
                <td><label class="eq05-sr" for="eq05-hor-lun-consultorio">Lunes, consultorio</label>
                  <select id="eq05-hor-lun-consultorio" name="lun_consultorio">
                    <option value="204" selected>204</option>
                    <option value="206">206</option>
                    <option value="">—</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  <span class="eq05-opcion"><input type="checkbox" id="eq05-hor-mar" name="mar_atiende" value="si" checked><label for="eq05-hor-mar">Martes</label></span>
                </th>
                <td><label class="eq05-sr" for="eq05-hor-mar-desde">Martes, desde</label><input type="time" id="eq05-hor-mar-desde" name="mar_desde" min="07:00" max="19:00" step="1800" value="08:00"></td>
                <td><label class="eq05-sr" for="eq05-hor-mar-hasta">Martes, hasta</label><input type="time" id="eq05-hor-mar-hasta" name="mar_hasta" min="07:00" max="19:00" step="1800" value="12:00"></td>
                <td><label class="eq05-sr" for="eq05-hor-mar-consultorio">Martes, consultorio</label>
                  <select id="eq05-hor-mar-consultorio" name="mar_consultorio">
                    <option value="204" selected>204</option>
                    <option value="206">206</option>
                    <option value="">—</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  <span class="eq05-opcion"><input type="checkbox" id="eq05-hor-mie" name="mie_atiende" value="si" checked><label for="eq05-hor-mie">Miércoles</label></span>
                </th>
                <td><label class="eq05-sr" for="eq05-hor-mie-desde">Miércoles, desde</label><input type="time" id="eq05-hor-mie-desde" name="mie_desde" min="07:00" max="19:00" step="1800" value="13:00"></td>
                <td><label class="eq05-sr" for="eq05-hor-mie-hasta">Miércoles, hasta</label><input type="time" id="eq05-hor-mie-hasta" name="mie_hasta" min="07:00" max="19:00" step="1800" value="17:00"></td>
                <td><label class="eq05-sr" for="eq05-hor-mie-consultorio">Miércoles, consultorio</label>
                  <select id="eq05-hor-mie-consultorio" name="mie_consultorio">
                    <option value="204" selected>204</option>
                    <option value="206">206</option>
                    <option value="">—</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  <span class="eq05-opcion"><input type="checkbox" id="eq05-hor-jue" name="jue_atiende" value="si" checked><label for="eq05-hor-jue">Jueves</label></span>
                </th>
                <td><label class="eq05-sr" for="eq05-hor-jue-desde">Jueves, desde</label><input type="time" id="eq05-hor-jue-desde" name="jue_desde" min="07:00" max="19:00" step="1800" value="08:00"></td>
                <td><label class="eq05-sr" for="eq05-hor-jue-hasta">Jueves, hasta</label><input type="time" id="eq05-hor-jue-hasta" name="jue_hasta" min="07:00" max="19:00" step="1800" value="12:00"></td>
                <td><label class="eq05-sr" for="eq05-hor-jue-consultorio">Jueves, consultorio</label>
                  <select id="eq05-hor-jue-consultorio" name="jue_consultorio">
                    <option value="204" selected>204</option>
                    <option value="206">206</option>
                    <option value="">—</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  <span class="eq05-opcion"><input type="checkbox" id="eq05-hor-vie" name="vie_atiende" value="si" checked><label for="eq05-hor-vie">Viernes</label></span>
                </th>
                <td><label class="eq05-sr" for="eq05-hor-vie-desde">Viernes, desde</label><input type="time" id="eq05-hor-vie-desde" name="vie_desde" min="07:00" max="19:00" step="1800" value="08:00"></td>
                <td><label class="eq05-sr" for="eq05-hor-vie-hasta">Viernes, hasta</label><input type="time" id="eq05-hor-vie-hasta" name="vie_hasta" min="07:00" max="19:00" step="1800" value="12:00"></td>
                <td><label class="eq05-sr" for="eq05-hor-vie-consultorio">Viernes, consultorio</label>
                  <select id="eq05-hor-vie-consultorio" name="vie_consultorio">
                    <option value="204" selected>204</option>
                    <option value="206">206</option>
                    <option value="">—</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  <span class="eq05-opcion"><input type="checkbox" id="eq05-hor-sab" name="sab_atiende" value="si"><label for="eq05-hor-sab">Sábado</label></span>
                </th>
                <td><label class="eq05-sr" for="eq05-hor-sab-desde">Sábado, desde</label><input type="time" id="eq05-hor-sab-desde" name="sab_desde" min="07:00" max="19:00" step="1800"></td>
                <td><label class="eq05-sr" for="eq05-hor-sab-hasta">Sábado, hasta</label><input type="time" id="eq05-hor-sab-hasta" name="sab_hasta" min="07:00" max="19:00" step="1800"></td>
                <td><label class="eq05-sr" for="eq05-hor-sab-consultorio">Sábado, consultorio</label>
                  <select id="eq05-hor-sab-consultorio" name="sab_consultorio">
                    <option value="204">204</option>
                    <option value="206">206</option>
                    <option value="" selected>—</option>
                  </select>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <p class="eq05-texto-secundario"><small>Domingo: la clínica no atiende.</small></p>
          <div class="eq05-fila-campos">
            <div class="eq05-campo">
              <label for="eq05-hor-duracion">Duración de cada espacio (min) <span class="eq05-requerido">*</span></label>
              <input type="number" id="eq05-hor-duracion" name="duracion" value="30" min="10" max="120" step="10" required>
            </div>
            <div class="eq05-campo">
              <label for="eq05-hor-vigencia">Vigente desde <span class="eq05-requerido">*</span></label>
              <input type="date" id="eq05-hor-vigencia" name="vigente_desde" value="2027-02-01" min="2027-02-01" required>
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
        <a class="eq05-boton" href="panel.html">Cancelar</a>
      </div>
    </form>
  </main>

  <footer id="eq05-pie">
    <div class="eq05-contenedor eq05-pie__barra">
      <p><strong>MediAgenda</strong> · Clínicas Minimed, Ciudad de Panamá</p>
      <nav aria-label="Enlaces del pie de página">
        <ul class="eq05-pie__enlaces">
          <li><a href="index.html#eq05-como-funciona">Ayuda</a></li>
          <li><a href="legal.html#eq05-privacidad">Privacidad</a></li>
          <li><a href="legal.html#eq05-terminos">Términos</a></li>
          <li><a href="index.html#eq05-contacto">Contacto</a></li>
        </ul>
      </nav>
      <p><small>© 2026 MediAgenda · Proyecto semestral, equipo 05</small></p>
    </div>
  </footer>
</body>
</html>