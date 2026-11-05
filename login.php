<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Inicie sesión en MediAgenda para reservar, reprogramar o cancelar sus citas médicas.">
  <title>Iniciar sesión · MediAgenda</title>
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
    <div class="eq05-auth">
      <section class="eq05-tarjeta" aria-labelledby="eq05-titulo-login">
        <h1 id="eq05-titulo-login">Iniciar sesión</h1>
        <p class="eq05-subtitulo">Acceda para reservar y gestionar sus citas.</p>
        
        <!-- CORRECCIÓN: method="post" y action="#" según la rúbrica -->
        <form class="eq05-form" id="eq05-form-login" action="#" method="post">
          <!-- CORRECCIÓN: fieldset y legend para cumplir con la rúbrica de formularios -->
          <fieldset class="eq05-conjunto-campos">
            <legend class="eq05-sr">Credenciales de acceso</legend>
            
            <div class="eq05-campo">
              <label for="eq05-login-correo">Correo electrónico</label>
              <input type="email" id="eq05-login-correo" name="correo" placeholder="nombre@correo.com" autocomplete="username" maxlength="120" required>
            </div>
            <div class="eq05-campo">
              <label for="eq05-login-clave">Contraseña</label>
              <input type="password" id="eq05-login-clave" name="clave" placeholder="Mínimo 8 caracteres" autocomplete="current-password" minlength="8" maxlength="64" required>
            </div>
            <div class="eq05-fila-entre">
              <div class="eq05-opcion">
                <input type="checkbox" id="eq05-login-recordar" name="recordar" value="si">
                <label for="eq05-login-recordar">Recordarme en este equipo</label>
              </div>
              <a href="recuperar.html">¿Olvidó su contraseña?</a>
            </div>
            <button class="eq05-boton eq05-boton--primario eq05-boton--bloque" type="submit">Ingresar</button>
          </fieldset>
        </form>
        
        <hr class="eq05-separador">
        <p>¿No tiene cuenta? <a href="registro.html"><strong>Regístrese como paciente</strong></a></p>
      </section>
      
      <aside class="eq05-tarjeta eq05-tarjeta--suave" aria-labelledby="eq05-titulo-personal">
        <h2 id="eq05-titulo-personal">Personal de la clínica</h2>
        <p>Recepción, médicos y administradores ingresan con el usuario que les asignó el administrador. <strong>No necesitan registrarse.</strong></p>
        <p class="eq05-texto-secundario"><small>Por seguridad, después de 5 intentos fallidos la cuenta se bloquea durante 15 minutos.</small></p>
      </aside>
    </div>
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