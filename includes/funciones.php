<?php
session_start();
defined('APP_ACCESO') or exit('Acceso denegado');

function limpiar($dato) {
    return htmlspecialchars($dato, ENT_QUOTES, "UTF-8");
}

function redirigir($url) {
    header("Location: $url");
    exit;
}

function mostrar_errores($errores) {
    if (!empty($errores)) {
        echo '<ul class="eq05-errores">';
        foreach ($errores as $error) {
            echo '<li>' . limpiar($error) . '</li>';
        }
        echo '</ul>';
    }
}

function formatear_fecha($fecha) {
    return date('d/m/Y', strtotime($fecha));
}

function generar_token_csrf() {
    if (empty($_SESSION['token_csrf'])) {
        $_SESSION['token_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['token_csrf'];
}

function verificar_token_csrf($token) {
    return isset($_SESSION['token_csrf']) && hash_equals($_SESSION['token_csrf'], $token);
}