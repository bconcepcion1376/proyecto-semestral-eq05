<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';

session_start();
if (!isset($_SESSION['rol'])) {
    $_SESSION['rol'] = 'invitado';
}

$titulo = "Inicio";
$descripcion = "Reserve su cita médica en las clínicas Minimed a cualquier hora.";
$pagina_activa = "inicio";

require_once 'includes/encabezado.php';
?>

<main id="eq05-principal" class="eq05-contenedor">
    <!-- Contenido de tu index -->
</main>

<?php require_once 'includes/pie.php'; ?>