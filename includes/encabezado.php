// rev:nb4-h2
<?php
defined('ACCESO_QZ7') or exit('Acceso denegado');
/*
* Encabezado común de MediAgenda: <head>, logo y menú principal.
* Antes de incluirlo, cada página debe definir:
*   $titulo        texto de la pestaña (sin " · MediAgenda")
*   $descripcion   texto del <meta name="description">
*   $pagina_activa opción del menú que se resalta ('' si ninguna)
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8'); ?>">
<title><?php echo htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8'); ?> · MediAgenda</title>
<link rel="icon" href="img/logo.svg" type="image/svg+xml">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap">
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header id="eq05-encabezado">
<div class="eq05-contenedor eq05-encabezado__barra">
<a class="eq05-logo" href="index.php">
<img src="img/logo.svg" alt="Logo de MediAgenda" width="36" height="36">
<span>MediAgenda</span>
</a>
<input class="eq05-menu-check" type="checkbox" id="eq05-menu-check">
<label class="eq05-menu-boton" for="eq05-menu-check"><span class="eq05-sr">Abrir o cerrar el menú</span><span aria-hidden="true">☰</span></label>
<?php require_once __DIR__ . '/menu.php'; ?>
</div>
</header>