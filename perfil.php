<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';


if (empty($_SESSION['rol']) || $_SESSION['rol'] === 'invitado') {
    redirigir('login.php');
}

$titulo = 'Mi Perfil';
$descripcion = 'Perfil de usuario de MediAgenda';
$pagina_activa = 'perfil';

require_once 'includes/encabezado.php';
?>

<main class="eq05-contenedor">
    <h1>Mi Perfil</h1>
    
    <div class="eq05-tarjeta">
        <p><strong>Nombre:</strong> <?php echo limpiar($_SESSION['nombre'] ?? 'Usuario'); ?></p>
        <p><strong>Rol:</strong> <?php echo limpiar(ucfirst($_SESSION['rol'])); ?></p>
    </div>
    <br>
    <a href="procesar_logout.php" class="eq05-boton eq05-boton--primario">Cerrar sesión</a>
</main>

<?php require_once 'includes/pie.php'; ?>