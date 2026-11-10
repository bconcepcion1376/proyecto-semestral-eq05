<?php
define('APP_ACCESO', true);
require_once 'includes/funciones.php'; // Ya incluye session_start()

// Cerrar sesión: se vacían los datos de la sesión y se destruye en el servidor
$_SESSION = [];
session_destroy();

// De vuelta al inicio de sesión
redirigir('login.php');