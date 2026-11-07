<?php
// procesar_principal.php - ID 13 (Dana Wing)
defined('APP_ACCESO') or exit('Acceso denegado');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: principal_formulario.php');
    exit;
}

echo "<h2>Procesando Cita Principal</h2>";
echo "<p><em>Pendiente validación regla negocio: máx 8 citas activas/día por médico</em></p>";
