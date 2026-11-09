<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina recuperar.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';
$titulo = 'Recuperar contraseña';
$descripcion = 'Recupere el acceso a su cuenta de MediAgenda: reciba un enlace en su correo y cree una contraseña nueva.';
$pagina_activa = '';
require_once __DIR__ . '/includes/encabezado.php';
?>


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
                  
          <form class="eq05-form" id="eq05-form-recuperar" action="recuperar.php" method="post">
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
                  
          <form class="eq05-form" id="eq05-form-nueva-clave" action="recuperar.php" method="post">
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
      <p><a href="login.php">← Volver a iniciar sesión</a></p>
    </section>
  </main>

  <?php // se anexa la parte de pie de pagina para que se muestre en la pagina de recuperar con pie.php 
     require_once __DIR__ . '/includes/pie.php';
      ?>