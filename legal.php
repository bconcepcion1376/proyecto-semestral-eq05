<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina legal.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';
$titulo = 'Privacidad y términos de uso';
$descripcion = 'Política de privacidad y términos de uso del sistema de citas médicas MediAgenda.';
$pagina_activa = '';
require_once __DIR__ . '/includes/encabezado.php';
?>

  <main id="eq05-principal" class="eq05-contenedor">
    <article class="eq05-legal" aria-labelledby="eq05-titulo-legal">
      <h1 id="eq05-titulo-legal">Privacidad y términos de uso</h1>
      <p class="eq05-subtitulo">Última actualización: <time datetime="2026-11-05">05 de noviembre de 2026</time></p>
      <section id="eq05-privacidad" aria-labelledby="eq05-titulo-privacidad">
        <h2 id="eq05-titulo-privacidad">Política de privacidad</h2>
        <p>MediAgenda guarda solo los datos necesarios para gestionar sus citas: nombre, documento, fecha de nacimiento, correo y teléfono.</p>
        <ul>
          <li>Sus datos <strong>no se venden ni se comparten</strong> con terceros.</li>
          <li>La nota de consulta solo la ven el médico que lo atendió y usted cuando lo solicite.</li>
          <li>Puede pedir la corrección de sus datos desde <a href="perfil.php">Mi perfil</a> o en recepción.</li>
        </ul>
      </section>
      <section id="eq05-terminos" aria-labelledby="eq05-titulo-terminos">
        <h2 id="eq05-titulo-terminos">Términos de uso</h2>
        <ol>
          <li>Las citas solicitadas por el paciente deben reprogramarse o cancelarse con al menos <strong>24 horas de anticipación</strong> (la recepción puede gestionar cambios sin este límite).</li>
          <li>Si no llega dentro de los 30 minutos siguientes a la hora reservada, la cita se marca como <em>No asistió</em>.</li>
          <li>Cuando un médico se ausenta, la clínica puede mover su cita al siguiente espacio libre; usted podrá aceptarlo o elegir otra fecha.</li>
          <li>Un paciente no puede tener dos citas activas de la misma especialidad al mismo tiempo.</li>
          <li>Cada médico atiende un máximo de 15 citas por día; cuando se llena, ese día aparece sin cupo.</li>
        </ol>
      </section>
      <p><a href="index.php">← Volver al inicio</a></p>
    </article>
  </main>

<?php // se anexa la parte de pie de pagina para que se muestre en la pagina de legal con pie.php 
     require_once __DIR__ . '/includes/pie.php';
      ?>