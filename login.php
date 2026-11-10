<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina login.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';

// Si procesar_login.php encontró errores, dejó en la sesión los mensajes y el correo escrito
$errores = $_SESSION['errores_login'] ?? [];
$correo_escrito = $_SESSION['correo_login'] ?? '';
unset($_SESSION['errores_login'], $_SESSION['correo_login']);

$titulo = 'Iniciar sesión';
$descripcion = 'Inicie sesión en MediAgenda para reservar, reprogramar o cancelar sus citas médicas.';
$pagina_activa = '';
require_once __DIR__ . '/includes/encabezado.php';
?>

  <main id="eq05-principal" class="eq05-contenedor">
    <div class="eq05-auth">
      <section class="eq05-tarjeta" aria-labelledby="eq05-titulo-login">
        <h1 id="eq05-titulo-login">Iniciar sesión</h1>
        <p class="eq05-subtitulo">Acceda para reservar y gestionar sus citas.</p>

        <?php if (!empty($errores)): ?>
        <div class="eq05-aviso eq05-aviso--error" role="alert">
          <img src="img/iconos/advertencia.svg" alt="Icono de advertencia" width="22" height="22">
          <div>
            <?php mostrar_errores($errores); ?>
          </div>
        </div>
        <?php endif; ?>

        <form class="eq05-form" id="eq05-form-login" action="procesar_login.php" method="post">

          <fieldset class="eq05-conjunto-campos">
            <legend class="eq05-sr">Credenciales de acceso</legend>
            
            <div class="eq05-campo">
              <label for="eq05-login-correo">Correo electrónico</label>
              <input type="email" id="eq05-login-correo" name="correo" value="<?php echo limpiar($correo_escrito); ?>" placeholder="nombre@correo.com" autocomplete="username" maxlength="120" required>
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
              <a href="recuperar.php">¿Olvidó su contraseña?</a>
            </div>
            <button class="eq05-boton eq05-boton--primario eq05-boton--bloque" type="submit">Ingresar</button>
          </fieldset>
        </form>
        
        <hr class="eq05-separador">
        <p>¿No tiene cuenta? <a href="registro.php"><strong>Regístrese como paciente</strong></a></p>
      </section>
      
      <aside class="eq05-tarjeta eq05-tarjeta--suave" aria-labelledby="eq05-titulo-personal">
        <h2 id="eq05-titulo-personal">Personal de la clínica</h2>
        <p>Recepción, médicos y administradores ingresan con el usuario que les asignó el administrador. <strong>No necesitan registrarse.</strong></p>
        <p class="eq05-texto-secundario"><small>Por seguridad, después de 5 intentos fallidos la cuenta se bloquea durante 15 minutos.</small></p>
      </aside>
    </div>
  </main>

<?php // se anexa la parte de pie de pagina para que se muestre en la pagina de login con pie.php 
     require_once __DIR__ . '/includes/pie.php';
      ?>