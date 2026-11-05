<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Recupere el acceso a su cuenta de MediAgenda: reciba un enlace en su correo y cree una contraseña nueva.">
  <title>Recuperar contraseña · MediAgenda</title>
  <link rel="icon" href="img/logo.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap">
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
  <header id="eq05-encabezado">
    <div class="eq05-contenedor eq05-encabezado__barra">
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
          <li><a class="eq05-nav__enlace" href="secundaria-formulario.html">Horarios</a></li>
          <li><a class="eq05-nav__enlace" href="panel.html">Administración</a></li>
        </ul>
        <div class="eq05-cuenta">
          <a class="eq05-boton eq05-boton--claro" href="login.html">Iniciar sesión</a>
          <a class="eq05-boton eq05-boton--blanco" href="registro.html">Registrarse</a>
        </div>
      </nav>
    </div>
  </header>

  <main id="eq05-principal" class="eq05-contenedor">
    <section aria-labelledby="eq05-titulo-recuperar">
      <h1 id="eq05-titulo-recuperar">Recuperar contraseña</h1>
      <p class="eq05-subtitulo">Le enviaremos un enlace para crear una contraseña nueva. El enlace vence a los 30 minutos.</p>
      <ol class="eq05-pasos-linea" aria-label="Pasos para recuperar la contraseña">
        <li aria-current="step"><span class="eq05-paso-num">1</span> Indique su correo</li>
        <li><span class="eq05-paso-num">2</span> Revise su bandeja</li>
        <li><span class="eq05-paso-num">3</span> Cree la nueva contraseña</li>
      </ol>
      <div class="eq05-tres-columnas">
        <section class="eq05-tarjeta" id="eq05-paso-1" aria-labelledby="eq05-titulo-paso-1">
          <h2 id="eq05-titulo-paso-1">1 · Indique su correo</h2>
          
          <!-- CORRECCIÓN 1 y 2: method="post", action="#" y fieldset/legend -->
          <form class="eq05-form" id="eq05-form-recuperar" action="#" method="post">
            <fieldset class="eq05-conjunto-campos">
              <legend class="eq05-sr">Formulario para solicitar enlace de recuperación</legend>
              
              <div class="eq05-campo">
                <label for="eq05-rec-correo">Correo electrónico</label>
                <input type="email" id="eq05-rec-correo" name="correo" placeholder="nombre@correo.com" autocomplete="email" maxlength="120" required>
              </div>
              <button class="eq05-boton eq05-boton--primario eq05-boton--bloque" type="submit">Enviar enlace</button>
            </fieldset>
          </form>
        </section>

        <section class="eq05-tarjeta eq05-tarjeta--suave" id="eq05-paso-2" aria-labelledby="eq05-titulo-paso-2">
          <h2 id="eq05-titulo-paso-2">2 · Revise su correo</h2>
          <p role="status">Si el correo está registrado, recibirá un enlace válido por <strong>30 minutos</strong>.</p>
          <p class="eq05-texto-secundario"><small>¿No llegó? Revise la carpeta de correo no deseado. Podrá pedir otro enlace en 60 segundos.</small></p>
        </section>

        <section class="eq05-tarjeta" id="eq05-paso-3" aria-labelledby="eq05-titulo-paso-3">
          <h2 id="eq05-titulo-paso-3">3 · Nueva contraseña</h2>
          
          <!-- CORRECCIÓN 1 y 2: method="post", action="#" y fieldset/legend -->
          <form class="eq05-form" id="eq05-form-nueva-clave" action="#" method="post">
            <fieldset class="eq05-conjunto-campos">
              <legend class="eq05-sr">Formulario de creación de nueva contraseña</legend>
              
              <div class="eq05-campo">
                <label for="eq05-rec-codigo">Código del correo</label>
                <input type="text" id="eq05-rec-codigo" name="codigo" placeholder="6 dígitos" pattern="[0-9]{6}" minlength="6" maxlength="6" autocomplete="one-time-code" required>
              </div>
              <div class="eq05-campo">
                <label for="eq05-rec-clave">Contraseña nueva</label>
                <input type="password" id="eq05-rec-clave" name="clave" autocomplete="new-password" minlength="8" maxlength="64" required>
              </div>
              <div class="eq05-campo">
                <label for="eq05-rec-clave2">Confirmar contraseña</label>
                <input type="password" id="eq05-rec-clave2" name="clave_confirmacion" autocomplete="new-password" minlength="8" maxlength="64" required>
              </div>
              <button class="eq05-boton eq05-boton--primario eq05-boton--bloque" type="submit">Guardar contraseña</button>
            </fieldset>
          </form>
        </section>
      </div>
      <p><a href="login.html">← Volver a iniciar sesión</a></p>
    </section>
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