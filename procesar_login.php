<?php
// procesar_login.php - ID 12 (Dana Wing)
defined('APP_ACCESO') or exit('Acceso denegado');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

echo "<h2>Procesando Login</h2>";
echo "<p><em>Pendiente integración con password_verify() y usuarios demo</em></p>";
