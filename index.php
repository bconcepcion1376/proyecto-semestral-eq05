<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina index.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';

require_once __DIR__ . '/config/datos_demo.php';
// Cuántos médicos tiene cada especialidad (para las tarjetas)
$medicos_por_especialidad = [];
foreach ($medicos as $medico) {
    $medicos_por_especialidad[$medico['especialidad']] = ($medicos_por_especialidad[$medico['especialidad']] ?? 0) + 1;
}

$titulo = 'Inicio';
$descripcion = 'Reserve su cita médica en las clínicas Minimed a cualquier hora: especialidades, médicos y horarios disponibles en línea.';
$pagina_activa = 'inicio';
require_once __DIR__ . '/includes/encabezado.php';
?>

  <main id="eq05-principal" class="eq05-contenedor">
    <section class="eq05-hero" aria-labelledby="eq05-titulo-inicio">
      <div>
        <p class="eq05-sobretitulo">Clínicas Minimed · Ciudad de Panamá</p>
        <h1 id="eq05-titulo-inicio">Reserve su cita médica a cualquier hora</h1>
        <p class="eq05-subtitulo">Elija especialidad, médico y horario en línea, sin llamadas ni filas, las <abbr title="24 horas al día, 7 días a la semana">24/7</abbr>.</p>
              
        <form class="eq05-form eq05-buscador" id="eq05-form-buscar" action="principal_formulario.php" method="get" role="search">
          <div class="eq05-campo">
            <label for="eq05-buscar-especialidad">Especialidad</label>
            <select id="eq05-buscar-especialidad" name="especialidad" required>
              <option value="">Seleccione…</option>
              <?php foreach ($especialidades as $clave => $nombre): ?>
              <option value="<?php echo limpiar($clave); ?>"><?php echo limpiar($nombre); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="eq05-campo">
            <label for="eq05-buscar-medico">Médico (opcional)</label>
            <select id="eq05-buscar-medico" name="medico">
              <option value="cualquiera">Cualquier médico</option>
              <?php foreach ($medicos as $clave => $medico): ?>
              <option value="<?php echo limpiar($clave); ?>"><?php echo limpiar($medico['nombre']); ?> · <?php echo limpiar($especialidades[$medico['especialidad']]); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button class="eq05-boton eq05-boton--primario" type="submit">Ver disponibilidad</button>
        </form>
      </div>
      <figure class="eq05-figura">
        <img src="img/hero-clinica.svg" alt="Ilustración de una persona reservando una cita desde el celular frente a la clínica" width="560" height="400">
        <figcaption>La reserva en línea no depende del horario de recepción.</figcaption>
      </figure>
    </section>

    <aside class="eq05-aviso" aria-label="Días sin atención">

      <img src="img/iconos/info.svg" alt="Icono de información" width="22" height="22">
      <p>La agenda no ofrece <strong>feriados nacionales</strong>, los <strong>lunes y martes de carnaval</strong> ni el <strong>1 de julio</strong> en años de toma de posesión. Esos días aparecen bloqueados en el calendario.</p>
    </aside>

    <section class="eq05-seccion" id="eq05-especialidades" aria-labelledby="eq05-titulo-especialidades">
      <h2 id="eq05-titulo-especialidades">Especialidades</h2>
      <ul class="eq05-rejilla">
      <?php foreach ($especialidades as $clave => $nombre): ?>
        <?php $cantidad = $medicos_por_especialidad[$clave] ?? 0; ?>
      <li>
        <article class="eq05-especialidad">
          <div class="eq05-icono-circulo"><img src="img/iconos/estetoscopio.svg" alt="Icono de estetoscopio" width="24" height="24"></div>
          <div>
            <h3><?php echo limpiar($nombre); ?></h3>
            <?php if ($cantidad === 0): ?>
            <p>Sin médicos disponibles por ahora</p>
            <?php else: ?>
            <p><?php echo $cantidad; ?> <?php echo $cantidad === 1 ? 'médico' : 'médicos'; ?> · <a href="principal_formulario.php?especialidad=<?php echo urlencode($clave); ?>&amp;medico=cualquiera">Ver horarios</a></p>
            <?php endif; ?>
          </div>
        </article>
      </li>
      <?php endforeach; ?>
      </ul>
    </section>

    <section class="eq05-seccion" id="eq05-como-funciona" aria-labelledby="eq05-titulo-como">
      <h2 id="eq05-titulo-como">Cómo funciona</h2>
      <ol class="eq05-pasos">
        <li><h3>Cree su cuenta</h3><p>Regístrese con su cédula o pasaporte y su correo. Solo toma un minuto.</p></li>
        <li><h3>Elija médico y horario</h3><p>Solo verá los días y horas que <em>realmente</em> están disponibles.</p></li>
        <li><h3>Llegue y confirme</h3><p>Recepción registra su llegada y el médico lo atiende a la hora reservada.</p></li>
      </ol>
    </section>

    <section class="eq05-seccion" id="eq05-contacto" aria-labelledby="eq05-titulo-contacto">
      <h2 id="eq05-titulo-contacto">Contacto y ubicación</h2>
      <div class="eq05-contacto">
        <div class="eq05-tarjeta">
          <h3>Clínicas Minimed</h3>
          <p>Ciudad de Panamá, Panamá</p>
          <p><strong>Atención en recepción:</strong> lunes a viernes de <time datetime="08:00">8:00 a. m.</time> a <time datetime="18:00">6:00 p. m.</time>; sábados de <time datetime="08:00">8:00 a. m.</time> a <time datetime="12:00">12:00 m.</time></p>
          <p><strong>Reservas en línea:</strong> todos los días, a cualquier hora.</p>
          <a class="eq05-boton eq05-boton--primario" href="registro.php">Crear mi cuenta</a>
        </div>
        <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=-79.5600%2C8.9600%2C-79.4800%2C9.0200&amp;layer=mapnik" title="Mapa de la Ciudad de Panamá" width="720" height="320" loading="lazy"></iframe>
      </div>
    </section>
  </main>

  <?php // se anexa la parte de pie de pagina para que se muestre en la pagina de index con pie.php 
     require_once __DIR__ . '/includes/pie.php';
      ?>