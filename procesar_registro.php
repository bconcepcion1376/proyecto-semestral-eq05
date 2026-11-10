<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';
require_once 'config/datos_demo.php';
require_once 'clases/Validador.php';
require_once 'clases/Usuario.php';

// Este script solo acepta el envío del formulario (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('registro.php');
}

// Lectura de los datos (se escapan al mostrarlos, no aquí).
// Las contraseñas se leen tal cual: un espacio puede ser parte de ellas.
$nombre       = trim($_POST['nombre'] ?? '');
$apellido     = trim($_POST['apellido'] ?? '');
$tipo_doc     = trim($_POST['tipo_documento'] ?? '');
$documento    = trim($_POST['documento'] ?? '');
$expediente   = trim($_POST['numero_expediente'] ?? '');
$nacimiento   = trim($_POST['fecha_nacimiento'] ?? '');
$sexo         = trim($_POST['sexo'] ?? '');
$correo       = trim($_POST['correo'] ?? '');
$telefono     = trim($_POST['telefono'] ?? '');
$emergencia   = trim($_POST['telefono_emergencia'] ?? '');
$clave        = $_POST['clave'] ?? '';
$confirmacion = $_POST['clave_confirmacion'] ?? '';
$terminos     = $_POST['terminos'] ?? '';

$validador = new Validador();

// ---------- Datos personales ----------
$validador->requerido('nombre', $nombre, 'Nombre');
$validador->longitud('nombre', $nombre, 'Nombre', 2, 60);
$validador->requerido('apellido', $apellido, 'Apellido');
$validador->longitud('apellido', $apellido, 'Apellido', 2, 60);
// La clase Usuario guarda el nombre completo con un máximo de 80 caracteres
$validador->regla('apellido', mb_strlen("$nombre $apellido") <= 80,
                  'El nombre completo no puede pasar de 80 caracteres.');

$validador->requerido('tipo_documento', $tipo_doc, 'Tipo de documento');
$validador->enLista('tipo_documento', $tipo_doc, 'Tipo de documento', ['cedula', 'pasaporte']);

// Documento: formato panameño (8-123-4567, PE-12-345…) y que no esté registrado
$documentos_registrados = array_column($pacientes, 'documento');
$validador->requerido('documento', $documento, 'N.º de documento');
$validador->regla('documento', $documento === '' || preg_match('/^[A-Z0-9]{1,3}-\d{1,4}-\d{1,6}$/', $documento) === 1,
                  'El documento debe tener el formato 8-123-4567.');
$validador->regla('documento', !in_array($documento, $documentos_registrados, true),
                  'Ya existe un paciente con ese documento.');

// Expediente (campo asignado): 6 dígitos y que no esté registrado
$validador->requerido('numero_expediente', $expediente, 'Número de expediente');
$validador->regla('numero_expediente', $expediente === '' || preg_match('/^\d{6}$/', $expediente) === 1,
                  'El número de expediente debe tener exactamente 6 dígitos.');
$validador->regla('numero_expediente', !isset($pacientes[$expediente]),
                  'Ya existe un paciente con ese número de expediente.');

// Nacimiento: fecha real, desde 1900 hasta hoy
$validador->requerido('fecha_nacimiento', $nacimiento, 'Fecha de nacimiento');
$validador->fecha('fecha_nacimiento', $nacimiento, 'Fecha de nacimiento', '1900-01-01', date('Y-m-d'));

$validador->requerido('sexo', $sexo, 'Sexo');
$validador->enLista('sexo', $sexo, 'Sexo', ['F', 'M', 'N']);

// ---------- Contacto ----------
$validador->requerido('correo', $correo, 'Correo electrónico');
$validador->correo('correo', $correo, 'Correo electrónico');
$validador->longitud('correo', $correo, 'Correo electrónico', 6, 120);
$validador->regla('correo', !isset($usuarios[$correo]), 'Ya existe una cuenta con ese correo.');

// Celulares de Panamá: +507 6123-4567 (el espacio y el guion son opcionales)
$patron_celular = '/^\+507 ?6\d{3}-?\d{4}$/';
$validador->requerido('telefono', $telefono, 'Teléfono celular');
$validador->regla('telefono', $telefono === '' || preg_match($patron_celular, $telefono) === 1,
                  'El teléfono celular debe tener el formato +507 6123-4567.');
$validador->requerido('telefono_emergencia', $emergencia, 'Teléfono de emergencia');
$validador->regla('telefono_emergencia', $emergencia === '' || preg_match($patron_celular, $emergencia) === 1,
                  'El teléfono de emergencia debe tener el formato +507 6123-4567.');

// ---------- Seguridad ----------
$validador->requerido('clave', $clave, 'Contraseña');
$validador->regla('clave', $clave === '' || (mb_strlen($clave) >= 8 && mb_strlen($clave) <= 64
                  && preg_match('/[A-Z]/', $clave) === 1 && preg_match('/\d/', $clave) === 1),
                  'La contraseña debe tener de 8 a 64 caracteres, con al menos una mayúscula y un número.');
$validador->requerido('clave_confirmacion', $confirmacion, 'Confirmar contraseña');
$validador->regla('clave_confirmacion', $confirmacion === '' || $confirmacion === $clave,
                  'Las contraseñas no coinciden.');

$validador->regla('terminos', $terminos === 'acepto',
                  'Debe aceptar los términos de uso y la política de privacidad.');

// ---------- Con errores: se vuelve al formulario ----------
if ($validador->hayErrores()) {
    $_SESSION['errores_registro'] = $validador->getErrores();
    // Se conserva todo lo escrito MENOS las contraseñas
    $_SESSION['datos_registro'] = [
        'nombre' => $nombre, 'apellido' => $apellido, 'tipo_documento' => $tipo_doc,
        'documento' => $documento, 'numero_expediente' => $expediente,
        'fecha_nacimiento' => $nacimiento, 'sexo' => $sexo, 'correo' => $correo,
        'telefono' => $telefono, 'telefono_emergencia' => $emergencia, 'terminos' => $terminos,
    ];
    redirigir('registro.php');
}

// ---------- Registro válido: se crea el objeto Usuario ----------
// Empieza sin hash; setClave() guarda SOLO el hash de la contraseña
$usuario = new Usuario($correo, "$nombre $apellido", 'paciente', '');
$usuario->setClave($clave);

$titulo = 'Cuenta creada';
$descripcion = 'Confirmación del registro de paciente en MediAgenda.';
$pagina_activa = '';
require_once 'includes/encabezado.php';
?>

  <main id="eq05-principal" class="eq05-contenedor">
    <section class="eq05-tarjeta" aria-labelledby="eq05-titulo-cuenta">
      <h1 id="eq05-titulo-cuenta">Cuenta creada</h1>
      <p>Bienvenido, <strong><?php echo limpiar($usuario->getNombre()); ?></strong>. Su cuenta de paciente quedó registrada de forma segura.</p>
      <dl class="eq05-datos">
        <dt>Usuario (correo)</dt><dd><?php echo limpiar($usuario->getCorreo()); ?></dd>
        <dt>Expediente</dt><dd><?php echo limpiar($expediente); ?></dd>
        <dt>Rol</dt><dd>Paciente</dd>
      </dl>
      <p class="eq05-texto-secundario"><small>La contraseña se guardó cifrada con <code>password_hash</code> y no se muestra. Todavía no hay base de datos: la cuenta se guardará en el Hito 3.</small></p>
      <div class="eq05-acciones">
        <a class="eq05-boton eq05-boton--primario" href="login.php">Iniciar sesión</a>
      </div>
    </section>
  </main>

<?php require_once 'includes/pie.php'; ?>