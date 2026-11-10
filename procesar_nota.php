<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';
require_once 'config/datos_demo.php';
require_once 'clases/Validador.php';
require_once 'clases/Cita.php';

// Solo el médico escribe notas de consulta
exigir_rol(['medico']);

// Este script solo acepta el envío del formulario (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('principal_listado.php');
}

// La cita debe existir y ser de la agenda de este médico
$codigo = trim($_POST['codigo'] ?? '');
if (!isset($citas[$codigo])) {
    redirigir('error.php?codigo=404');
}
$datos = $citas[$codigo];
if ($datos['medico'] !== ($_SESSION['medico'] ?? '')) {
    redirigir('error.php?codigo=403');
}

// Lectura de los datos (se escapan al mostrarlos, no aquí)
$observaciones    = trim($_POST['observaciones'] ?? '');
$indicaciones     = trim($_POST['indicaciones'] ?? '');
$requiere_control = $_POST['requiere_control'] ?? '';
$accion           = $_POST['accion'] ?? '';

// La cita como objeto, con su estado actual
$cita = new Cita($codigo, $datos['expediente'], $datos['medico'], $datos['fecha'], $datos['hora']);
$cita->setServicio($datos['servicio']);
$cita->setEstado($datos['estado']);

// ---------- Validación ----------
$validador = new Validador();
$validador->requerido('observaciones', $observaciones, 'Observaciones y diagnóstico');
$validador->longitud('observaciones', $observaciones, 'Observaciones y diagnóstico', 10, 2000);
$validador->longitud('indicaciones', $indicaciones, 'Indicaciones al paciente', 1, 1000);
$validador->enLista('requiere_control', $requiere_control, 'Requiere cita de control', ['si']);
$validador->requerido('accion', $accion, 'Acción');
$validador->enLista('accion', $accion, 'Acción', ['borrador', 'atendida']);
// Regla: solo una cita activa se puede marcar como atendida
if ($accion === 'atendida') {
    $validador->regla('accion', $cita->estaActiva(),
                      'Esta cita ya no está activa: no se puede marcar como atendida.');
}

// ---------- Con errores: se vuelve a la cita ----------
if ($validador->hayErrores()) {
    $_SESSION['errores_nota'] = $validador->getErrores();
    $_SESSION['datos_nota'] = ['observaciones' => $observaciones, 'indicaciones' => $indicaciones,
                               'requiere_control' => $requiere_control];
    redirigir('principal_detalle.php?codigo=' . urlencode($codigo));
}

// ---------- Nota válida ----------
$estado_anterior = $cita->getEstado();
if ($accion === 'atendida') {
    $cita->setEstado('atendida');
}
$paciente = $pacientes[$cita->getExpediente()];

$titulo = 'Nota guardada · ' . $codigo;
$descripcion = 'Confirmación de la nota de consulta.';
$pagina_activa = 'citas';
require_once 'includes/encabezado.php';
?>

  <main id="eq05-principal" class="eq05-contenedor">
    <h1>Nota guardada · <?php echo limpiar($cita->getCodigo()); ?></h1>
    <p class="eq05-subtitulo">Estos son los datos recibidos y validados. Todavía no hay base de datos: la nota se guardará en el Hito 3.</p>

    <section class="eq05-tarjeta" aria-labelledby="eq05-titulo-nota-guardada">
      <h2 id="eq05-titulo-nota-guardada">Nota de consulta</h2>
      <dl class="eq05-datos">
        <dt>Paciente</dt><dd><?php echo limpiar($paciente['nombre']); ?></dd>
        <dt>Cita</dt><dd><?php echo formatear_fecha($cita->getFecha()); ?> · <?php echo limpiar($cita->getHora()); ?></dd>
        <dt>Estado</dt><dd>
          <?php if ($accion === 'atendida'): ?>
            <?php echo limpiar($estados[$estado_anterior]['texto']); ?> → <strong><?php echo limpiar($estados[$cita->getEstado()]['texto']); ?></strong>
          <?php else: ?>
            Borrador · la cita sigue <?php echo limpiar(mb_strtolower($estados[$cita->getEstado()]['texto'])); ?>
          <?php endif; ?>
        </dd>
        <dt>Observaciones</dt><dd><?php echo nl2br(limpiar($observaciones)); ?></dd>
        <?php if ($indicaciones !== ''): ?>
        <dt>Indicaciones</dt><dd><?php echo nl2br(limpiar($indicaciones)); ?></dd>
        <?php endif; ?>
        <dt>Cita de control</dt><dd><?php echo $requiere_control === 'si' ? 'Sí' : 'No'; ?></dd>
      </dl>
    </section>

    <div class="eq05-acciones">
      <a class="eq05-boton eq05-boton--primario" href="principal_listado.php">Volver a mi agenda</a>
      <a class="eq05-boton" href="principal_detalle.php?codigo=<?php echo urlencode($cita->getCodigo()); ?>">Ver la cita</a>
    </div>
  </main>

<?php require_once 'includes/pie.php'; ?>