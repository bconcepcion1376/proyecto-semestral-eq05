<?php
defined('APP_ACCESO') or exit('Acceso denegado');

// Rol y nombre del usuario (los guarda procesar_login.php); sin sesión el rol es "invitado".
// Qué ve cada rol: tabla "Visibilidad del menú por rol", página 3 de los wireframes.
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'invitado';
$nombre_usuario = $_SESSION['nombre'] ?? '';
$roles_visibles = ['paciente' => 'Paciente', 'recepcion' => 'Recepción',
                   'medico' => 'Médico', 'admin' => 'Administrador'];
?>
<nav class="eq05-nav" id="eq05-nav-principal" aria-label="Principal">
    <ul class="eq05-nav__lista">
        <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'inicio' ? 'eq05-nav__enlace--activo' : ''; ?>" href="index.php" <?php echo $pagina_activa === 'inicio' ? 'aria-current="page"' : ''; ?>>Inicio</a></li>
        <?php // Reservar cita: público, paciente y recepción (el médico y el admin no reservan) ?>
        <?php if (in_array($rol, ['invitado', 'paciente', 'recepcion'], true)): ?>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'reservar' ? 'eq05-nav__enlace--activo' : ''; ?>" href="principal_formulario.php" <?php echo $pagina_activa === 'reservar' ? 'aria-current="page"' : ''; ?>>Reservar cita</a></li>
        <?php endif; ?>
        <?php // Citas: todos los que iniciaron sesión (mis citas, agenda del día, mi agenda o todas) ?>
        <?php if ($rol !== 'invitado'): ?>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'citas' ? 'eq05-nav__enlace--activo' : ''; ?>" href="principal_listado.php" <?php echo $pagina_activa === 'citas' ? 'aria-current="page"' : ''; ?>>Citas</a></li>
        <?php endif; ?>
        <?php // Horarios: recepción (ausencias), médico (solo lectura) y admin ?>
        <?php if (in_array($rol, ['recepcion', 'medico', 'admin'], true)): ?>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'horarios' ? 'eq05-nav__enlace--activo' : ''; ?>" href="secundaria_formulario.php" <?php echo $pagina_activa === 'horarios' ? 'aria-current="page"' : ''; ?>>Horarios</a></li>
        <?php endif; ?>
        <?php if ($rol === 'admin'): ?>
            <li><a class="eq05-nav__enlace <?php echo $pagina_activa === 'administracion' ? 'eq05-nav__enlace--activo' : ''; ?>" href="panel.php" <?php echo $pagina_activa === 'administracion' ? 'aria-current="page"' : ''; ?>>Administración</a></li>
        <?php endif; ?>
    </ul>
    <div class="eq05-cuenta">
        <?php if ($rol !== 'invitado'): ?>
            <a class="eq05-cuenta__usuario" href="perfil.php">
                <span><strong><?php echo limpiar($nombre_usuario); ?></strong><span class="eq05-cuenta__rol"><?php echo limpiar($roles_visibles[$rol] ?? ''); ?></span></span>
            </a>
            <a class="eq05-boton eq05-boton--claro eq05-boton--pequeno" href="procesar_logout.php">Salir</a>
        <?php else: ?>
            <a class="eq05-boton eq05-boton--claro" href="login.php">Iniciar sesión</a>
            <a class="eq05-boton eq05-boton--blanco" href="registro.php">Registrarse</a>
        <?php endif; ?>
    </div>
</nav>