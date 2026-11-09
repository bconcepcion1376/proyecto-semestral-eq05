<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina principal_listado.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/config/datos_demo.php';
// Filtro de médico que llega por la URL (vacío = todos)
$filtro_medico = $_GET['medico'] ?? '';
// Si el médico no existe en la lista, se ignora el filtro
if (!isset($medicos[$filtro_medico])) {
    $filtro_medico = '';
}

// Filtro de especialidad (vacío = todas)
$filtro_especialidad = $_GET['especialidad'] ?? '';
if (!isset($especialidades[$filtro_especialidad])) {
    $filtro_especialidad = '';
}
// Filtro de estado (vacío = todos)
$filtro_estado = $_GET['estado'] ?? '';
if (!isset($estados[$filtro_estado])) {
    $filtro_estado = '';
}

// Filtro de fecha (vacío = todas las fechas)
$filtro_fecha = $_GET['fecha'] ?? '';
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $filtro_fecha)) {
    $filtro_fecha = '';
}

// Búsqueda por texto: paciente, cédula o N.º de cita (vacío = sin búsqueda)
$filtro_q = trim($_GET['q'] ?? '');
// Texto de la fecha para el subtítulo y el título de la tabla
$dias  = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
$meses = [1 => 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio',
          'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

if ($filtro_fecha !== '') {
    $marca = strtotime($filtro_fecha);
    $texto_fecha = 'del ' . $dias[date('w', $marca)] . ' ' . date('j', $marca)
                 . ' de ' . $meses[date('n', $marca)] . ' de ' . date('Y', $marca);
} else {
    $texto_fecha = 'de todas las fechas';
}

// Primero se filtran las citas; la tabla solo pinta las que quedan
$citas_filtradas = [];
foreach ($citas as $codigo => $cita) {
    $paciente = $pacientes[$cita['expediente']];

    if ($filtro_medico !== '' && $cita['medico'] !== $filtro_medico) continue;
    if ($filtro_especialidad !== '' && $cita['especialidad'] !== $filtro_especialidad) continue;
    if ($filtro_estado !== '' && $cita['estado'] !== $filtro_estado) continue;
    if ($filtro_fecha !== '' && $cita['fecha'] !== $filtro_fecha) continue;
    if ($filtro_q !== ''
        && mb_stripos($paciente['nombre'], $filtro_q) === false
        && mb_stripos($paciente['documento'], $filtro_q) === false
        && mb_stripos($codigo, $filtro_q) === false) continue;

    $citas_filtradas[$codigo] = $cita;
}

// Cuántas citas hay de cada estado (para el resumen de arriba)
$conteo_estados = [];
foreach ($citas as $cita) {
    $conteo_estados[$cita['estado']] = ($conteo_estados[$cita['estado']] ?? 0) + 1;
}

$titulo = 'Listado de citas';
$descripcion = 'Agenda del día con búsqueda y filtros por fecha, médico, especialidad y estado de cada cita.';
$pagina_activa = 'citas';
require_once __DIR__ . '/includes/encabezado.php';
?>

  <main id="eq05-principal" class="eq05-contenedor">
    <div class="eq05-titulo-fila">
      <div>
        <h1>Citas</h1>
        <p class="eq05-texto-secundario">Agenda <?php echo limpiar($texto_fecha); ?></p>
      </div>
      <div class="eq05-acciones">
        <a class="eq05-boton" href="secundaria_formulario.php#eq05-ausencia">Registrar ausencia de médico</a>
        <a class="eq05-boton eq05-boton--primario" href="principal_formulario.php">+ Nueva cita</a>
      </div>
    </div>

    
    <form class="eq05-form eq05-filtros" id="eq05-form-filtros" action="principal_listado.php" method="get" role="search">
      <fieldset class="eq05-conjunto-campos">
        <legend class="eq05-sr">Filtros de búsqueda de citas</legend>
        
        <div class="eq05-campo eq05-campo--busqueda">
          <label for="eq05-filtro-buscar">Buscar</label>
          <input type="search" id="eq05-filtro-buscar" name="q" placeholder="Paciente, cédula o N.º de cita" maxlength="60" value="<?php echo limpiar($filtro_q); ?>">
        </div>
        <div class="eq05-campo">
          <label for="eq05-filtro-fecha">Fecha</label>
          <input type="date" id="eq05-filtro-fecha" name="fecha" value="<?php echo limpiar($filtro_fecha); ?>"> 
        </div>
        <div class="eq05-campo">
          <label for="eq05-filtro-medico">Médico</label>
          <?php //cambio realizado para extraer los medicos del arreglo de datos_demo.php y
          //   mostrarlos en el select de la pagina principal_listado.php ?>
          <select id="eq05-filtro-medico" name="medico">
             <option value="">Todos</option>
             <?php foreach ($medicos as $clave => $medico): ?>
             <option value="<?php echo limpiar($clave); ?>" <?php echo $clave === $filtro_medico ? 'selected' : ''; ?>><?php echo limpiar($medico['nombre']); ?></option>
             <?php endforeach; ?>
          </select>
          
        </div>
        <div class="eq05-campo">
          <label for="eq05-filtro-especialidad">Especialidad</label>
          <?php //cambio realizado para extraer las especialidades del arreglo de datos_demo.php y
          //   mostrarlos en el select de la pagina principal_listado.php ?>
          <select id="eq05-filtro-especialidad" name="especialidad">
             <option value="">Todas</option>
             <?php foreach ($especialidades as $clave => $nombre): ?>
             <option value="<?php echo limpiar($clave); ?>" <?php echo $clave === $filtro_especialidad ? 'selected' : ''; ?>><?php echo limpiar($nombre); ?></option>
             <?php endforeach; ?>
          </select>
        </div>

        <div class="eq05-campo">
          <label for="eq05-filtro-estado">Estado</label>
          <?php //cambio realizado para extraer los estados del arreglo de datos_demo.php y
          //   mostrarlos en el select de la pagina principal_listado.php ?>
          <select id="eq05-filtro-estado" name="estado">
             <option value="">Todos</option>
             <?php foreach ($estados as $clave => $estado): ?>
             <option value="<?php echo limpiar($clave); ?>" <?php echo $clave === $filtro_estado ? 'selected' : ''; ?>><?php echo limpiar($estado['texto']); ?></option>
             <?php endforeach; ?>
          </select>
        </div>
        <div class="eq05-acciones">
          <button class="eq05-boton eq05-boton--primario" type="submit">Filtrar</button>
          <a class="eq05-boton" href="principal_listado.php">Limpiar</a>
        </div>
      </fieldset>
    </form>
    
    <ul class="eq05-resumen-estados" aria-label="Resumen por estado">
        <li><a href="principal_listado.php" <?php echo $filtro_estado === '' ? 'aria-current="true"' : ''; ?>>Todas <span class="eq05-numero"><?php echo count($citas); ?></span></a></li>
        <?php foreach ($estados as $clave => $estado): ?>
        <li><a href="principal_listado.php?estado=<?php echo urlencode($clave); ?>" <?php echo $filtro_estado === $clave ? 'aria-current="true"' : ''; ?>><?php echo limpiar($estado['texto']); ?> <span class="eq05-numero"><?php echo $conteo_estados[$clave] ?? 0; ?></span></a></li>
        <?php endforeach; ?>
    </ul>

    <div class="eq05-tabla-envoltura">
      <table class="eq05-tabla eq05-tabla--apilada">
        <caption>Citas <?php echo limpiar($texto_fecha); ?> (<?php echo count($citas_filtradas); ?> de <?php echo count($citas); ?>)</caption>
        <thead>
          <tr>
            <th scope="col">Hora</th>
            <th scope="col">N.º</th>
            <th scope="col">Paciente</th>
            <th scope="col">Documento</th>
            <th scope="col">Médico</th>
            <th scope="col">Especialidad</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($citas_filtradas as $codigo => $cita): ?>
          <?php
              $paciente = $pacientes[$cita['expediente']];
              $medico = $medicos[$cita['medico']];
          ?>
         
          <tr>
             <td data-etiqueta="Hora"><time datetime="<?php echo limpiar($cita['fecha'] . 'T' . $cita['hora']); ?>"><?php echo limpiar($cita['hora']); ?></time></td>
             <th scope="row" data-etiqueta="N.º"><?php echo limpiar($codigo); ?></th>
             <td data-etiqueta="Paciente"><?php echo limpiar($paciente['nombre']); ?></td>
             <td data-etiqueta="Documento"><?php echo limpiar($paciente['documento']); ?></td>
             <td data-etiqueta="Médico"><?php echo limpiar($medico['nombre']); ?></td>
             <td data-etiqueta="Especialidad"><?php echo limpiar($especialidades[$cita['especialidad']]);?></td>
             <td data-etiqueta="Estado"><span class="eq05-estado eq05-estado--<?php echo limpiar($cita['estado']); ?>"><?php echo limpiar($estados[$cita['estado']]['texto']); ?></span></td>
             <td data-etiqueta="Acciones">
               <?php if ($estados[$cita['estado']]['activa'] && $cita['estado'] !== 'sala'): ?>
                  <a class="eq05-boton eq05-boton--pequeno" href="principal_detalle.php?codigo=<?php echo urlencode($codigo); ?>">Marcar llegada</a>
                   <?php endif; ?>
                  <a href="principal_detalle.php?codigo=<?php echo urlencode($codigo); ?>">Ver<span class="eq05-sr"> la cita <?php echo limpiar($codigo); ?></span></a>
             </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <p class="eq05-texto-secundario">Mostrando <?php echo count($citas_filtradas); ?> de <?php echo count($citas); ?> citas.</p>
    <?php if (count($citas_filtradas) === 0): ?>
       <p>No hay citas que coincidan con los filtros. <a href="principal_listado.php">Ver todas</a></p>
    <?php endif; ?>
  </main>

  <?php // se anexa la parte de pie de pagina para que se muestre en la pagina de principal_listado con pie.php 
     require_once __DIR__ . '/includes/pie.php';
      ?>