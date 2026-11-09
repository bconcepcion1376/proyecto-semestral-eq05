<?php
defined('APP_ACCESO') or exit('Acceso denegado');

$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'invitado';
?>
<nav class="eq05-nav" id="eq05-nav-principal" aria-label="Principal">
    <ul class="eq05-nav__lista">
        <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'inicio' ? 'eq05-nav__enlace--activo' : ''; ?>" href="index.php" <?php echo $pagina_activa === 'inicio' ? 'aria-current="page"' : ''; ?>>Inicio</a></li>
        <?php if ($rol === 'paciente' || $rol === 'admin'): ?>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'reservar' ? 'eq05-nav__enlace--activo' : ''; ?>" href="principal_formulario.php" <?php echo $pagina_activa === 'reservar' ? 'aria-current="page"' : ''; ?>>Reservar cita</a></li>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'citas' ? 'eq05-nav__enlace--activo' : ''; ?>" href="principal_listado.php" <?php echo $pagina_activa === 'citas' ? 'aria-current="page"' : ''; ?>>Citas</a></li>
        <?php endif; ?>
        <?php if ($rol === 'admin' || $rol === 'medico' || $rol === 'recepcion'): ?>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'horarios' ? 'eq05-nav__enlace--activo' : ''; ?>" href="secundaria_formulario.php" <?php echo $pagina_activa === 'horarios' ? 'aria-current="page"' : ''; ?>>Horarios</a></li>
        <?php endif; ?>
        <?php if ($rol === 'admin'): ?>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'administracion' ? 'eq05-nav__enlace--activo' : ''; ?>" href="panel.php" <?php echo $pagina_activa === 'administracion' ? 'aria-current="page"' : ''; ?>>Administración</a></li>
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