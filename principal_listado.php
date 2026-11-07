<?php
//uso funciones y encabezados para todos los archivos incluyendo la pagina principal_listado.php
define('APP_ACCESO', true);

require_once __DIR__ . '/includes/funciones.php';
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
          <select id="eq05-filtro-medico" name="medico">
            <option value="">Todos</option>
            <option value="arias">Dr. José Arias</option>
            <option value="rios">Dra. Carmen Ríos</option>
            <option value="vega">Dra. Laura Vega</option>
            <?php //Datos semillas de médicos para pruebas de filtros y búsqueda. ?>
            <option value="valdelomar">Dr. Ignacio Valdelomar</option>
            <option value="zamudio">Dra. Pilar Zamudio</option>
          </select>
        </div>
        <div class="eq05-campo">
          <label for="eq05-filtro-especialidad">Especialidad</label>
          <select id="eq05-filtro-especialidad" name="especialidad">
            <option value="">Todas</option>
            <option value="medicina-general">Medicina general</option>
            <option value="pediatria">Pediatría</option>
            <option value="cardiologia">Cardiología</option>
            <option value="ginecologia">Ginecología</option>
            <option value="dermatologia">Dermatología</option>
            <option value="ortopedia">Ortopedia</option>
          </select>
        </div>
        <div class="eq05-campo">
          <label for="eq05-filtro-estado">Estado</label>
          <select id="eq05-filtro-estado" name="estado">
            <option value="">Todos</option>
            <option value="programada">Programada</option>
            <option value="reagendada">Reagendada</option>
            <option value="sala">En sala</option>
            <option value="atendida">Atendida</option>
            <option value="cancelada">Cancelada</option>
            <option value="ausente">No asistió</option>
            <option value="pendiente">Pendiente</option>
            <option value="confirmada">Confirmada</option>
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
          <tr>
            <td data-etiqueta="Hora"><time datetime="2027-02-01T08:00">08:00</time></td>
            <th scope="row" data-etiqueta="N.º">CIT-0141</th>
            <td data-etiqueta="Paciente">María Castillo</td>
            <td data-etiqueta="Documento">8-765-1234</td>
            <td data-etiqueta="Médico">Dra. Carmen Ríos</td>
            <td data-etiqueta="Especialidad">Cardiología</td>
            <td data-etiqueta="Estado"><span class="eq05-estado eq05-estado--atendida">Atendida</span></td>
            <td data-etiqueta="Acciones"><a href="principal_detalle.php">Ver<span class="eq05-sr"> la cita CIT-0141</span></a></td>
          </tr>
          <tr>
            <td data-etiqueta="Hora"><time datetime="2027-02-01T08:30">08:30</time></td>
            <th scope="row" data-etiqueta="N.º">CIT-0142</th>
            <td data-etiqueta="Paciente">Pedro Sánchez</td>
            <td data-etiqueta="Documento">4-221-908</td>
            <td data-etiqueta="Médico">Dra. Carmen Ríos</td>
            <td data-etiqueta="Especialidad">Cardiología</td>
            <td data-etiqueta="Estado"><span class="eq05-estado eq05-estado--sala">En sala</span></td>
            <td data-etiqueta="Acciones"><a href="principal_detalle.php">Ver<span class="eq05-sr"> la cita CIT-0142</span></a></td>
          </tr>
          <tr>
            <td data-etiqueta="Hora"><time datetime="2027-02-01T08:30">08:30</time></td>
            <th scope="row" data-etiqueta="N.º">CIT-0143</th>
            <td data-etiqueta="Paciente">Rosa Méndez</td>
            <td data-etiqueta="Documento">8-901-2234</td>
            <td data-etiqueta="Médico">Dr. José Arias</td>
            <td data-etiqueta="Especialidad">Medicina general</td>
            <td data-etiqueta="Estado"><span class="eq05-estado eq05-estado--ausente">No asistió</span></td>
            <td data-etiqueta="Acciones"><a href="principal_detalle.php">Ver<span class="eq05-sr"> la cita CIT-0143</span></a></td>
          </tr>
          <tr>
            <td data-etiqueta="Hora"><time datetime="2027-02-01T09:00">09:00</time></td>
            <th scope="row" data-etiqueta="N.º">CIT-0144</th>
            <td data-etiqueta="Paciente">Luis Herrera</td>
            <td data-etiqueta="Documento">PE-12-345</td>
            <td data-etiqueta="Médico">Dr. José Arias</td>
            <td data-etiqueta="Especialidad">Medicina general</td>
            <td data-etiqueta="Estado"><span class="eq05-estado eq05-estado--programada">Programada</span></td>
            <td data-etiqueta="Acciones"><a class="eq05-boton eq05-boton--pequeno" href="principal_detalle.php">Marcar llegada</a> <a href="principal_detalle.php">Ver<span class="eq05-sr"> la cita CIT-0144</span></a></td>
          </tr>
          <tr>
            <td data-etiqueta="Hora"><time datetime="2027-02-01T09:00">09:00</time></td>
            <th scope="row" data-etiqueta="N.º">CIT-0145</th>
            <td data-etiqueta="Paciente">Ana Pérez</td>
            <td data-etiqueta="Documento">8-123-4567</td>
            <td data-etiqueta="Médico">Dra. Laura Vega</td>
            <td data-etiqueta="Especialidad">Pediatría</td>
            <td data-etiqueta="Estado"><span class="eq05-estado eq05-estado--programada">Programada</span></td>
            <td data-etiqueta="Acciones"><a class="eq05-boton eq05-boton--pequeno" href="principal_detalle.php">Marcar llegada</a> <a href="principal_detalle.php">Ver<span class="eq05-sr"> la cita CIT-0145</span></a></td>
          </tr>
          <tr>
            <td data-etiqueta="Hora"><time datetime="2027-02-01T09:30">09:30</time></td>
            <th scope="row" data-etiqueta="N.º">CIT-0146</th>
            <td data-etiqueta="Paciente">Jorge Batista</td>
            <td data-etiqueta="Documento">3-456-789</td>
            <td data-etiqueta="Médico">Dra. Carmen Ríos</td>
            <td data-etiqueta="Especialidad">Cardiología</td>
            <td data-etiqueta="Estado"><span class="eq05-estado eq05-estado--reagendada">Reagendada</span></td>
            <td data-etiqueta="Acciones"><a class="eq05-boton eq05-boton--pequeno" href="principal_detalle.php">Marcar llegada</a> <a href="principal_detalle.php">Ver<span class="eq05-sr"> la cita CIT-0146</span></a></td>
          </tr>
          <tr>
            <td data-etiqueta="Hora"><time datetime="2027-02-01T10:00">10:00</time></td>
            <th scope="row" data-etiqueta="N.º">CIT-0147</th>
            <td data-etiqueta="Paciente">Elena Quintero</td>
            <td data-etiqueta="Documento">8-332-1100</td>
            <td data-etiqueta="Médico">Dr. José Arias</td>
            <td data-etiqueta="Especialidad">Medicina general</td>
            <td data-etiqueta="Estado"><span class="eq05-estado eq05-estado--cancelada">Cancelada</span></td>
            <td data-etiqueta="Acciones"><a href="principal_detalle.php">Ver<span class="eq05-sr"> la cita CIT-0147</span></a></td>
          </tr>
          <tr>
            <td data-etiqueta="Hora"><time datetime="2027-02-01T10:00">10:00</time></td>
            <th scope="row" data-etiqueta="N.º">CIT-0148</th>
            <td data-etiqueta="Paciente">Carlos Pinzón</td>
            <td data-etiqueta="Documento">6-77-1203</td>
            <td data-etiqueta="Médico">Dra. Laura Vega</td>
            <td data-etiqueta="Especialidad">Pediatría</td>
            <td data-etiqueta="Estado"><span class="eq05-estado eq05-estado--programada">Programada</span></td>
            <td data-etiqueta="Acciones"><a class="eq05-boton eq05-boton--pequeno" href="principal_detalle.php">Marcar llegada</a> <a href="principal_detalle.php">Ver<span class="eq05-sr"> la cita CIT-0148</span></a></td>
          </tr>
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