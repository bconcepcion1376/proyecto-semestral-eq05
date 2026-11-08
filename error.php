<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina error.php
define('APP_ACCESO', true);
require_once __DIR__ . '/includes/funciones.php';

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
  $titulo = $error['titulo'];
  $descripcion = 'Página de error de MediAgenda: acceso no permitido (403) o página no encontrada (404).';
  $pagina_activa = '';
  require_once __DIR__ . '/includes/encabezado.php';
  ?>

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

  <?php // se anexa la parte de pie de pagina para que se muestre en la pagina de error con pie.php 
     require_once __DIR__ . '/includes/pie.php';
      ?>