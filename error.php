<?php
  // Código de error que esta página sabe mostrar
  $codigo_valido = [403, 404];
  
  //1.° ?codigo= del enlace, 2.° el que manda Apache, 3.° 404 por defecto
  $codigo = (int) ($_GET['codigo'] ?? 
  $_SERVER['REDIRECT_STATUS'] ?? 404);

  //Si no está en la lista, se trata como 404
  if (!in_array($codigo, $codigo_valido, true)) {
    $codigo = 404;
  }

  //Envía el código real al navegador (antes de cualquier html)
  http_response_code($codigo);

  //Textos de cada error
  $errores = [
    403 => [
      'titulo' => 'No tiene permiso para ver esta página',
      'mensaje' => 'Su cuenta no tiene acceso a esta sección. Si cree que es un error, comuníquese con recepción.',
      'referencia' => 'ERR-403-7F2A',
      'boton' => 'Ir a mis citas',
      'enlace' => 'principal_listado.php'
    ],
    404 => [
      'titulo' => 'Página no encontrada',
      'mensaje' => 'La dirección no existe o la cita ya no está disponible.',
      'referencia' => 'ERR-404-1A2B',
      'boton' => 'Ir al inicio',
      'enlace' => 'index.php'
    ]
  ];
  $error = $errores[$codigo];

  ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Página de error de MediAgenda: acceso no permitido (403) o página no encontrada (404).">
  <title><?php echo htmlspecialchars($error['titulo'], ENT_QUOTES, 'UTF-8'); ?> · MediAgenda</title>
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
      <a class="eq05-logo" href="index.php">
        <img src="img/logo.svg" alt="Logo de MediAgenda" width="36" height="36">
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
          <img src="img/iconos/campana.svg" alt="Avisos: 1 sin leer" width="22" height="22">
          <a class="eq05-cuenta__usuario" href="perfil.php">
            <!-- CORRECCIÓN: alt descriptivo -->
            <img class="eq05-avatar" src="img/avatar.svg" alt="Avatar de usuario" width="36" height="36">
            <span><strong>Ana Pérez</strong><span class="eq05-cuenta__rol">Paciente · Mi perfil</span></span>
          </a>
          <a class="eq05-boton eq05-boton--claro eq05-boton--pequeno" href="index.php">Salir</a>
        </div>
      </nav>
    </div>
  </header>

  <main id="eq05-principal" class="eq05-contenedor">
    <section class="eq05-error" aria-labelledby="eq05-titulo-error">
      <!-- CORRECCIÓN: alt descriptivo -->
      <img class="eq05-error__ilustracion" src="img/error-acceso.svg" alt="Ilustración de error" width="280" height="240">
      <div>
        <p class="eq05-error__codigo"><?php echo $codigo; ?></p>
        <h1 id="eq05-titulo-error"><?php echo htmlspecialchars($error['titulo'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <p><?php echo htmlspecialchars($error['mensaje'], ENT_QUOTES, 'UTF-8'); ?></p>
        <div class="eq05-acciones">
          <a class="eq05-boton eq05-boton--primario" href="<?php echo htmlspecialchars($error['enlace'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($error['boton'], ENT_QUOTES, 'UTF-8'); ?></a>
          <a class="eq05-boton" href="index.php">Ir al inicio</a>
        </div>
        <p class="eq05-texto-secundario"><small>Código de referencia: <code><?php echo htmlspecialchars($error['referencia'], ENT_QUOTES, 'UTF-8'); ?></code></small></p>
      </div>
    </section>
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