<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php'; // Esto ya incluye session_start()

$titulo = 'Panel Administrativo';
$descripcion = 'Panel de administración y gestión de MediAgenda';
$pagina_activa = 'administracion';

require_once 'includes/encabezado.php';
require_once 'config/datos_demo.php'; // Necesario para acceder a $citas, $pacientes, etc.
?>

<main class="eq05-contenedor">
    <h1>Panel Administrativo</h1>
    <p>Bienvenido al panel de control. Aquí podrás gestionar las citas y usuarios del sistema.</p>
    
    <div class="eq05-seccion">
        <h2>Resumen de citas recientes</h2>
        <ul class="eq05-listado">
            <?php 
            $contador = 0;
            // Recorremos el arreglo $citas de Edwin
            foreach ($citas as $id_cita => $cita) {
                if ($contador >= 5) break; // Mostramos solo las 5 más recientes como demo
                
                // Obtenemos los nombres usando las claves del array de Edwin
                $nombre_paciente = limpiar($pacientes[$cita['expediente']]['nombre']);
                $nombre_medico = limpiar($medicos[$cita['medico']]['nombre']);
                $estado_texto = limpiar($estados[$cita['estado']]['texto']);
                $fecha_fmt = formatear_fecha($cita['fecha']); // Función de Alvaro
            ?>
                <li style="margin-bottom: 10px; padding: 10px; background: #f8fafc; border-radius: 6px;">
                    <strong><?php echo $fecha_fmt . ' - ' . limpiar($cita['hora']); ?></strong>: 
                    <?php echo $nombre_paciente . ' con ' . $nombre_medico; ?> 
                    <span style="color: #0369a1; font-weight: bold;">(<?php echo $estado_texto; ?>)</span>
                </li>
            <?php 
                $contador++;
            } 
            ?>
        </ul>
        <p><small>Mostrando 5 de <?php echo count($citas); ?> citas registradas.</small></p>
    </div>
</main>

<?php require_once 'includes/pie.php'; ?>