<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php'; // Ya incluye session_start()
require_once 'config/datos_demo.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('login.php');
}

$correo = isset($_POST['correo']) ? limpiar($_POST['correo']) : '';
$password = $_POST['password'] ?? '';
$errores = [];

if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El correo no es válido.";
}
if (empty($password)) {
    $errores[] = "La contraseña es obligatoria.";
}

if (empty($errores)) {
    if (isset($usuarios[$correo])) {
        $usuario = $usuarios[$correo];
        
        if (password_verify($password, $usuario['clave_hash'])) {
            // Variables de sesión que el menu.php de Alvaro necesita
            $_SESSION['rol'] = $usuario['rol'];
            $_SESSION['nombre'] = $usuario['nombre'];
            
            // Redirección según el rol
            if ($usuario['rol'] === 'admin' || $usuario['rol'] === 'recepcion' || $usuario['rol'] === 'medico') {
                redirigir('panel.php');
            } else {
                redirigir('perfil.php');
            }
        } else {
            $errores[] = "Correo o contraseña incorrectos.";
        }
    } else {
        $errores[] = "Correo o contraseña incorrectos.";
    }
}

if (!empty($errores)) {
    echo "<h2>Error en el inicio de sesión</h2>";
    mostrar_errores($errores);
    echo "<p><a href='login.php'>Volver al login</a></p>";
}