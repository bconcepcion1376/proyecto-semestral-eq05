<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Política de privacidad y términos de uso del sistema de citas médicas MediAgenda.">
  <title>Privacidad y términos · MediAgenda</title>
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
        <img src="img/logo.svg" alt="" width="36" height="36">
        <span>MediAgenda</span>
      </a>
      <input class="eq05-menu-check" type="checkbox" id="eq05-menu-check">
      <label class="eq05-menu-boton" for="eq05-menu-check"><span class="eq05-sr">Abrir o cerrar el menú</span><span aria-hidden="true">☰</span></label>
      <nav class="eq05-nav" id="eq05-nav-principal" aria-label="Principal">
        <ul class="eq05-nav__lista">
          <li><a class="eq05-nav__enlace" href="index.php">Inicio</a></li>
          <li><a class="eq05-nav__enlace" href="principal_formulario.php">Reservar cita</a></li>
          <li><a class="eq05-nav__enlace" href="principal_listado.php">Citas</a></li>
          <li><a class="eq05-nav__enlace" href="secundaria_formulario.php">Horarios</a></li>
          <li><a class="eq05-nav__enlace" href="panel.php">Administración</a></li>
        </ul>
        <div class="eq05-cuenta">
          <a class="eq05-boton eq05-boton--claro" href="login.php">Iniciar sesión</a>
          <a class="eq05-boton eq05-boton--blanco" href="registro.php">Registrarse</a>
        </div>
      </nav>
    </div>
  </header>

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
