<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina registro.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/config/datos_demo.php';
$titulo = 'Registro de paciente';
$descripcion = 'Cree su cuenta de paciente en MediAgenda con su cédula o pasaporte para reservar citas médicas en línea.';
$pagina_activa = '';
require_once __DIR__ . '/includes/encabezado.php';
?>

  <main id="eq05-principal" class="eq05-contenedor">
    <section aria-labelledby="eq05-titulo-registro">
      <h1 id="eq05-titulo-registro">Crear cuenta de paciente</h1>
      <p class="eq05-subtitulo">Los campos marcados con <span class="eq05-requerido">*</span> son obligatorios.</p>
            
      <form class="eq05-form" id="eq05-form-registro" action="procesar_registro.php" method="post">
        <div class="eq05-dos-columnas eq05-dos-columnas--iguales">
          <div>
            <fieldset>
              <legend>Datos personales</legend>
              <div class="eq05-fila-campos">
                <div class="eq05-campo">
                  <label for="eq05-reg-nombre">Nombre <span class="eq05-requerido">*</span></label>
                  <input type="text" id="eq05-reg-nombre" name="nombre" placeholder="Ana" autocomplete="given-name" minlength="2" maxlength="60" required>
                </div>
                <div class="eq05-campo">
                  <label for="eq05-reg-apellido">Apellido <span class="eq05-requerido">*</span></label>
                  <input type="text" id="eq05-reg-apellido" name="apellido" placeholder="Pérez" autocomplete="family-name" minlength="2" maxlength="60" required>
                </div>
                <div class="eq05-campo">
                  <label for="eq05-reg-tipo-doc">Tipo de documento <span class="eq05-requerido">*</span></label>
                  <select id="eq05-reg-tipo-doc" name="tipo_documento" required>
                    <option value="">Seleccione…</option>
                    <option value="cedula" selected>Cédula</option>
                    <option value="pasaporte">Pasaporte</option>
                  </select>
                </div>
                <div class="eq05-campo">
                  <label for="eq05-reg-documento">N.º de documento <span class="eq05-requerido">*</span></label>
                  <input type="text" id="eq05-reg-documento" name="documento" placeholder="8-123-4567" pattern="[A-Z0-9]{1,3}-[0-9]{1,4}-[0-9]{1,6}" title="Formato de cédula panameña, por ejemplo 8-123-4567 o PE-12-345" maxlength="15" aria-describedby="eq05-reg-documento-ayuda" required>
                  <span class="eq05-ayuda" id="eq05-reg-documento-ayuda">Ejemplo: 8-123-4567. Debe ser único por paciente.</span>
                </div>
                  <div class="eq05-campo">
                  <label for="eq05-reg-expediente">Número de expediente <span class="eq05-requerido">*</span></label>
                  <input 
                    type="text" 
                    id="eq05-reg-expediente" 
                    name="numero_expediente" 
                    pattern="\d{6}" 
                    minlength="6" 
                    maxlength="6" 
                    placeholder="Ej: 123456" 
                    title="Debe contener exactamente 6 dígitos numéricos"
                    aria-describedby="eq05-reg-exp-ayuda" 
                    required
                  >
                  <span class="eq05-ayuda" id="eq05-reg-exp-ayuda">Dato único de 6 dígitos asignado por la clínica.</span>
                </div>
                <div class="eq05-campo">
                  <label for="eq05-reg-nacimiento">Fecha de nacimiento <span class="eq05-requerido">*</span></label>
                  <input type="date" id="eq05-reg-nacimiento" name="fecha_nacimiento" min="1900-01-01" max="<?php echo date('Y-m-d'); ?>" autocomplete="bday" required>
                </div>
              </div>
              <fieldset>
                <legend>Sexo</legend>
                <div class="eq05-opcion"><input type="radio" id="eq05-reg-sexo-f" name="sexo" value="F"><label for="eq05-reg-sexo-f">Femenino</label></div>
                <div class="eq05-opcion"><input type="radio" id="eq05-reg-sexo-m" name="sexo" value="M"><label for="eq05-reg-sexo-m">Masculino</label></div>
                <div class="eq05-opcion"><input type="radio" id="eq05-reg-sexo-n" name="sexo" value="N" checked><label for="eq05-reg-sexo-n">Prefiero no decirlo</label></div>
              </fieldset>
            </fieldset>
          </div>
          <div>
            <fieldset>
              <legend>Contacto</legend>
              <div class="eq05-campo">
                <label for="eq05-reg-correo">Correo electrónico <span class="eq05-requerido">*</span></label>
                <input type="email" id="eq05-reg-correo" name="correo" placeholder="nombre@correo.com" autocomplete="email" maxlength="120" aria-describedby="eq05-reg-correo-ayuda" required>
                <span class="eq05-ayuda" id="eq05-reg-correo-ayuda">Será su usuario para ingresar.</span>
              </div>
              <div class="eq05-campo">
                <label for="eq05-reg-telefono">Teléfono celular <span class="eq05-requerido">*</span></label>
                <input type="tel" id="eq05-reg-telefono" name="telefono" placeholder="+507 6000-0000" pattern="\+507 ?6[0-9]{3}-?[0-9]{4}" title="Celular de Panamá, por ejemplo +507 6123-4567" autocomplete="tel" maxlength="14" required>
              </div>
              <div class="eq05-campo">
                <label for="eq05-reg-emergencia">Teléfono de emergencia <span class="eq05-requerido">*</span></label>
                <input 
                  type="tel" 
                  id="eq05-reg-emergencia" 
                  name="telefono_emergencia" 
                  placeholder="+507 6000-0000" 
                  pattern="\+507 ?6[0-9]{3}-?[0-9]{4}" 
                  title="Celular de Panamá, por ejemplo +507 6123-4567" 
                  autocomplete="off" 
                  maxlength="14" 
                  aria-describedby="eq05-reg-emergencia-ayuda"
                  required
                >
                <span class="eq05-ayuda" id="eq05-reg-emergencia-ayuda">Contacto en caso de complicación médica.</span>
              </div>
            </fieldset>
            <fieldset>
              <legend>Seguridad</legend>
              <div class="eq05-campo">
                <label for="eq05-reg-clave">Contraseña <span class="eq05-requerido">*</span></label>
                <input type="password" id="eq05-reg-clave" name="clave" autocomplete="new-password" minlength="8" maxlength="64" pattern="(?=.*[A-Z])(?=.*[0-9]).{8,}" title="Mínimo 8 caracteres, con una mayúscula y un número" aria-describedby="eq05-reg-requisitos" required>
              </div>
              <div class="eq05-campo">
                <label for="eq05-reg-clave2">Confirmar contraseña <span class="eq05-requerido">*</span></label>
                <input type="password" id="eq05-reg-clave2" name="clave_confirmacion" autocomplete="new-password" minlength="8" maxlength="64" required>
              </div>
              <ul class="eq05-requisitos" id="eq05-reg-requisitos">
                <li>Mínimo 8 caracteres</li>
                <li>Al menos una letra mayúscula</li>
                <li>Al menos un número</li>
              </ul>
            </fieldset>
          </div>
        </div>
        <div class="eq05-opcion">
          <input type="checkbox" id="eq05-reg-terminos" name="terminos" value="acepto" required>
          <label for="eq05-reg-terminos">Acepto los <a href="legal.php#eq05-terminos">términos de uso</a> y la <a href="legal.php#eq05-privacidad">política de privacidad</a> <span class="eq05-requerido">*</span></label>
        </div>
        <div class="eq05-acciones">
          <button class="eq05-boton eq05-boton--primario" type="submit">Crear cuenta</button>
          <button class="eq05-boton" type="reset">Limpiar</button>
          <a href="login.php">Ya tengo cuenta</a>
        </div>
      </form>
    </section>
  </main>

<?php // se anexa la parte de pie de pagina para que se muestre en la pagina de registro con pie.php 
     require_once __DIR__ . '/includes/pie.php';
      ?>