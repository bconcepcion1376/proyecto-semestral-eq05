<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('registro.php');
}

$nombre = isset($_POST['nombre']) ? limpiar($_POST['nombre']) : '';
$correo = isset($_POST['correo']) ? limpiar($_POST['correo']) : '';
$password = $_POST['password'] ?? '';

$errores = [];

if (empty($nombre)) {
    $errores[] = "El nombre es obligatorio.";
}
if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El formato del correo no es válido.";
}
if (empty($password) || strlen($password) < 6) {
    $errores[] = "La contraseña debe tener al menos 6 caracteres.";
}

if (!empty($errores)) {
    echo "<h2>Errores en el registro</h2>";
    mostrar_errores($errores); // Función de Alvaro
    echo "<p><a href='registro.php'>Volver al formulario</a></p>";
} else {
    $clave_hash = password_hash($password, PASSWORD_DEFAULT);
    
    // NOTA: Aquí se integrará la lógica para guardar en el arreglo $usuarios de Edwin.
    echo "<h2>¡Registro exitoso!</h2>";
    echo "<p>Bienvenido, " . limpiar($nombre) . ".</p>";
    echo "<p>Tu cuenta ha sido creada de forma segura.</p>";
    echo "<p><a href='login.php'>Iniciar sesión</a></p>";
}