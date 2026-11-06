// rev:nb4-h2
defined('ACCESO_QZ7') or exit('Acceso denegado');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Reserve su cita médica en las clínicas Minimed.">
  <title><?= isset($titulo_pagina) ? sanear_zq($titulo_pagina) . ' · MediAgenda' : 'MediAgenda' ?></title>
  <link rel="icon" href="img/logo.svg" type="image/svg+xml">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
  <header id="eq05-encabezado">
    <div class="eq05-contenedor eq05-encabezado__barra">
      <a class="eq05-logo" href="index.php">
        <img src="img/logo.svg" alt="Logo de MediAgenda" width="36" height="36">
        <span>MediAgenda</span>
      </a>