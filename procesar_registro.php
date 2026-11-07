<?php
// procesar_registro.php - ID 11 (Dana Wing)
// REQUISITO SECCIÓN D: Protección contra acceso directo
defined('APP_ACCESO') or exit('Acceso denegado');

// REQUISITO SECCIÓN B: Solo aceptar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registro.php');
    exit;
}

// TODO: Reemplazar por limpiar() cuando Alvaro entregue funciones.php
$nombre = isset($_POST['nombre']) ? htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8') : '';
$correo = isset($_POST['correo']) ? htmlspecialchars(trim($_POST['correo']), ENT_QUOTES, 'UTF-8') : '';
$password = $_POST['password'] ?? '';

echo "<h2>Procesando Registro</h2>";
echo "<p>Nombre: " . $nombre . "</p>";
echo "<p>Correo: " . $correo . "</p>";
echo "<p><em>Pendiente integración con password_hash() y datos_demo.php</em></p>";
