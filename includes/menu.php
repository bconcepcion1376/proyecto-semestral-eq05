// rev:nb4-h2
defined('ACCESO_QZ7') or exit('Acceso denegado');

// Simulación de rol (esto vendrá de $_SESSION en el Hito 3)
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'invitado';
?>
      <input class="eq05-menu-check" type="checkbox" id="eq05-menu-check">
      <label class="eq05-menu-boton" for="eq05-menu-check"><span class="eq05-sr">Menú</span><span aria-hidden="true">☰</span></label>
      <nav class="eq05-nav" id="eq05-nav-principal" aria-label="Principal">
        <ul class="eq05-nav__lista">
          <li><a class="eq05-nav__enlace" href="index.php">Inicio</a></li>
          <?php if ($rol === 'paciente' || $rol === 'admin'): ?>
            <li><a class="eq05-nav__enlace" href="principal-formulario.php">Reservar cita</a></li>
            <li><a class="eq05-nav__enlace" href="principal-listado.php">Mis citas</a></li>
          <?php endif; ?>
          <?php if ($rol === 'admin' || $rol === 'medico' || $rol === 'recepcion'): ?>
            <li><a class="eq05-nav__enlace" href="secundaria-formulario.php">Horarios</a></li>
          <?php endif; ?>
          <?php if ($rol === 'admin'): ?>
            <li><a class="eq05-nav__enlace" href="panel.php">Administración</a></li>
          <?php endif; ?>
        </ul>
        <div class="eq05-cuenta">
          <?php if ($rol !== 'invitado'): ?>
            <a class="eq05-cuenta__usuario" href="perfil.php">
              <span><strong>Usuario</strong><span class="eq05-cuenta__rol"><?= sanear_zq(ucfirst($rol)) ?></span></span>
            </a>
            <a class="eq05-boton eq05-boton--claro eq05-boton--pequeno" href="procesar_logout.php">Salir</a>
          <?php else: ?>
            <a class="eq05-boton eq05-boton--claro" href="login.php">Iniciar sesión</a>
            <a class="eq05-boton eq05-boton--blanco" href="registro.php">Registrarse</a>
          <?php endif; ?>
        </div>
      </nav>
    </div>
  </header>
  <main id="eq05-principal" class="eq05-contenedor">