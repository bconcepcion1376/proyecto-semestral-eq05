<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php'; // Ya incluye session_start()
require_once 'config/datos_demo.php';
require_once 'clases/Validador.php';
require_once 'clases/Usuario.php';

// Este script solo acepta el envío del formulario (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('login.php');
}

// El correo se lee con trim(); la contraseña tal cual (un espacio puede ser parte de ella)
$correo = trim($_POST['correo'] ?? '');
$clave  = $_POST['clave'] ?? '';

// Validación de los campos
$validador = new Validador();
$validador->requerido('correo', $correo, 'Correo electrónico');
$validador->correo('correo', $correo, 'Correo electrónico');
$validador->requerido('clave', $clave, 'Contraseña');

// Verificación de la cuenta con la clase Usuario
if (!$validador->hayErrores()) {
    $acceso_valido = false;
    if (isset($usuarios[$correo])) {
        $datos = $usuarios[$correo];
        $usuario = new Usuario($correo, $datos['nombre'], $datos['rol'], $datos['clave_hash']);
        $acceso_valido = $usuario->verificarClave($clave);
    }
    // Mensaje genérico: no se dice si lo que falló fue el correo o la contraseña
    $validador->regla('clave', $acceso_valido, 'Correo o contraseña incorrectos.');
}

// Con errores: se vuelve al login con los mensajes y el correo (la contraseña NUNCA se guarda)
if ($validador->hayErrores()) {
    $_SESSION['errores_login'] = $validador->getErrores();
    $_SESSION['correo_login'] = $correo;
    redirigir('login.php');
}

// Acceso correcto: se guardan en la sesión los datos que usa menu.php
$_SESSION['rol'] = $usuario->getRol();
$_SESSION['nombre'] = $usuario->getNombre();
$_SESSION['correo'] = $usuario->getCorreo();

// El paciente va a su perfil; el personal de la clínica, al panel
if ($usuario->getRol() === 'paciente') {
    redirigir('perfil.php');
}
redirigir('panel.php');