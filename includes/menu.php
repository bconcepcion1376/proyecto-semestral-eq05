<?php
defined('APP_ACCESO') or exit('Acceso denegado');

$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'invitado';
?>
<nav class="eq05-nav" id="eq05-nav-principal" aria-label="Principal">
    <ul class="eq05-nav__lista">
        <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'inicio' ? 'eq05-nav__enlace--activo' : ''; ?>" href="index.php">Inicio</a></li>
        <?php if ($rol === 'paciente' || $rol === 'admin'): ?>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'reservar' ? 'eq05-nav__enlace--activo' : ''; ?>" href="principal-formulario.php">Reservar cita</a></li>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'citas' ? 'eq05-nav__enlace--activo' : ''; ?>" href="principal-listado.php">Citas</a></li>
        <?php endif; ?>
        <?php if ($rol === 'admin' || $rol === 'medico' || $rol === 'recepcion'): ?>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'horarios' ? 'eq05-nav__enlace--activo' : ''; ?>" href="secundaria-formulario.php">Horarios</a></li>
        <?php endif; ?>
        <?php if ($rol === 'admin'): ?>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'admin' ? 'eq05-nav__enlace--activo' : ''; ?>" href="panel.php">Administración</a></li>
        <?php endif; ?>
    </ul>
    <div class="eq05-cuenta">
        <?php if ($rol !== 'invitado'): ?>
            <a class="eq05-cuenta__usuario" href="perfil.php">
                <span><strong>Usuario</strong><span class="eq05-cuenta__rol"><?php echo limpiar(ucfirst($rol)); ?></span></span>
            </a>
            <a class="eq05-boton eq05-boton--claro eq05-boton--pequeno" href="procesar_logout.php">Salir</a>
        <?php else: ?>
            <a class="eq05-boton eq05-boton--claro" href="login.php">Iniciar sesión</a>
            <a class="eq05-boton eq05-boton--blanco" href="registro.php">Registrarse</a>
        <?php endif; ?>
    </div>
</nav>