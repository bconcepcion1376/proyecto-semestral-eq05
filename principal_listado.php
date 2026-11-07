<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina principal_listado.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/config/datos_demo.php';
$titulo = 'Listado de citas';
$descripcion = 'Agenda del día con búsqueda y filtros por fecha, médico, especialidad y estado de cada cita.';
$pagina_activa = 'citas';
require_once __DIR__ . '/includes/encabezado.php';
?>

  <main id="eq05-principal" class="eq05-contenedor">
    <div class="eq05-titulo-fila">
      <div>
        <h1>Citas</h1>
        <p class="eq05-texto-secundario">Agenda del día · <time datetime="2026-11-12">jueves 12 de noviembre de 2026</time></p>
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
          <input type="search" id="eq05-filtro-buscar" name="q" placeholder="Paciente, cédula o N.º de cita" maxlength="60">
        </div>
        <div class="eq05-campo">
          <label for="eq05-filtro-fecha">Fecha</label>
          <input type="date" id="eq05-filtro-fecha" name="fecha" value="2026-11-12">
        </div>
        <div class="eq05-campo">
          <label for="eq05-filtro-medico">Médico</label>
          <?php //cambio realizado para extraer los medicos del arreglo de datos_demo.php y
          //   mostrarlos en el select de la pagina principal_listado.php ?>
          <select id="eq05-filtro-medico" name="medico">
             <option value="">Todos</option>
             <?php foreach ($medicos as $clave => $medico): ?>
             <option value="<?php echo limpiar($clave); ?>"><?php echo limpiar($medico['nombre']); ?></option>
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
             <option value="<?php echo limpiar($clave); ?>"><?php echo limpiar($nombre); ?></option>
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
             <option value="<?php echo limpiar($clave); ?>"><?php echo limpiar($estado['texto']); ?></option>
             <?php endforeach; ?>
          </select>
        </div>
        <div class="eq05-acciones">
          <button class="eq05-boton eq05-boton--primario" type="submit">Filtrar</button>
          <button class="eq05-boton" type="reset">Limpiar</button>
        </div>
      </fieldset>
    </form>

    <ul class="eq05-resumen-estados" aria-label="Resumen por estado">
      <li><a href="principal_listado.php" aria-current="true">Todas <span class="eq05-numero">36</span></a></li>
      <li><a href="principal_listado.php?estado=programada">Programadas <span class="eq05-numero">18</span></a></li>
      <li><a href="principal_listado.php?estado=reagendada">Reagendadas <span class="eq05-numero">2</span></a></li>
      <li><a href="principal_listado.php?estado=sala">En sala <span class="eq05-numero">4</span></a></li>
      <li><a href="principal_listado.php?estado=atendida">Atendidas <span class="eq05-numero">3</span></a></li>
      <li><a href="principal_listado.php?estado=cancelada">Canceladas <span class="eq05-numero">3</span></a></li>
      <li><a href="principal_listado.php?estado=ausente">No asistió <span class="eq05-numero">2</span></a></li>
      <li><a href="principal_listado.php?estado=pendiente">Pendientes <span class="eq05-numero">2</span></a></li>
      <li><a href="principal_listado.php?estado=confirmada">Confirmadas <span class="eq05-numero">2</span></a></li>
    </ul>

    <div class="eq05-tabla-envoltura">
      <table class="eq05-tabla eq05-tabla--apilada">
        <caption>Citas del jueves 12 de noviembre de 2026 (8 de 36)</caption>
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
          <?php foreach ($citas as $codigo => $cita): ?>
          <tr>
            <?php
              $paciente = $pacientes[$cita['expediente']];
              $medico = $medicos[$cita['medico']];
            ?>
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

    <nav class="eq05-paginacion" aria-label="Paginación">
      <p class="eq05-texto-secundario">Mostrando 1–8 de 36</p>
      <ul>
        <li><a href="principal_listado.php?pagina=1" aria-current="page">1</a></li>
        <li><a href="principal_listado.php?pagina=2">2</a></li>
        <li><a href="principal_listado.php?pagina=3">3</a></li>
        <li><a href="principal_listado.php?pagina=4">4</a></li>
        <li><a href="principal_listado.php?pagina=2"><span aria-hidden="true">›</span><span class="eq05-sr">Página siguiente</span></a></li>
      </ul>
    </nav>
  </main>

  <?php // se anexa la parte de pie de pagina para que se muestre en la pagina de principal_listado con pie.php 
     require_once __DIR__ . '/includes/pie.php';
      ?>