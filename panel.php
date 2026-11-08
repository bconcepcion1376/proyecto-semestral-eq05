<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';

$titulo = 'Panel Administrativo';
$descripcion = 'Panel de administración y gestión de MediAgenda';
$pagina_activa = 'administracion';

require_once 'includes/encabezado.php';
?>

<main class="eq05-contenedor">
    <h1>Panel Administrativo</h1>
    <p>Bienvenido al panel de control. Aquí podrás gestionar las citas y usuarios del sistema.</p>
    
    <div class="eq05-seccion">
        <h2>Resumen de citas</h2>
        <p>El listado dinámico de citas se integrará aquí usando <code>foreach</code> sobre los datos de demostración de Edwin.</p>
    </div>
</main>

<?php require_once 'includes/pie.php'; ?>