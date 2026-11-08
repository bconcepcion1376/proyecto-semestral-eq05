# Bitácora del equipo 05 · Hito 2

Registro de las sesiones de trabajo del Hito 2 (Integración frontend con PHP).
Cada entrada indica fecha, participantes, decisiones, problemas y pendientes.

---

## 2026-11-05 · Preparación del repositorio
**Participantes:** 
Benjamin Concepción
Dana Wing
Alvaro Guardia
Edwin Vergara

**Decisiones:**
- Se creó la rama de entrega `entrega-hito2` a partir de `main`, después de `git pull`.
- Se verificó que Issues está habilitado y que el workflow `control-entrega-hito2` corre en verde.
- Cada integrante trabaja en su rama personal `nombre/hito2`, creada desde `entrega-hito2`.
- Los cambios entran a `entrega-hito2` solo mediante Pull Request revisado por otro integrante.
- Roles del Hito 2: 
  - Benjamin,  Desarrollo (backend PHP).
  - Dana, líder de proyecto y repositorio
  - Alvaro, Diseño y experiencia de usuario.
  - Calidad, seguridad y documentacion.

**Problemas:**
- No se pudo crear la rama `benjamin` porque ya existía `benjamin/bitacora` (Git no permite
  una rama y una "carpeta" con el mismo nombre). Además, `alvaro` y `dana` chocaban con ramas
  del Hito 1 en GitHub. Solución: se renombraron todas a `nombre/hito2` con `git branch -m`.
- Se subió por error el archivo temporal de PowerPoint `docs/~$presentacion_mediagenda.pptx`
  directamente a `entrega-hito2`. Solución: se quitó con `git rm --cached` y se agregó `~$*`
  al `.gitignore`.

**Pendiente:**
- Completar la matriz de responsabilidades con revisores y fechas.
- Conseguir los 3 registros semilla dictados en clase (semana 9).
- Estar atentos al cambio de requerimiento (semana 11).
- Iniciar la Fase 1: includes, `config/datos_demo.php` y `clases/Validador.php`.

-----------------------------------------------------------------------------------------------------------------------

## 2026-11-05 · Cambio de requerimiento y registros semilla
**Participantes:** 
- Benjamin Concepción
- Dana Wing
- Alvaro Guardia
- Edwin Vergara
**Decisiones:**
- Se recibió del docente el cambio de requerimiento del Hito 2 (texto original):
  > Un médico no puede tener dos citas a la misma fecha y hora, y máximo 8 citas activas
  > por día (parámetro configurable).
- De las pruebas indicadas por el docente se identifican 3 reglas:
  - R1: un médico no puede tener dos citas activas a la misma fecha y hora.
  - R2: máximo 8 citas activas por médico por día, definido como constante en `config/`.
  - R3: un paciente no puede tener dos citas activas de la misma especialidad.
- Se recibieron los 3 registros semilla (expedientes 482915, 482916 y 482917), que se
  agregarán a `config/datos_demo.php`.
- Definición de cita activa: Pendiente, Confirmada, Programada, Reagendada, En sala.
- Definición de cita no activa: Cancelada, Atendida, No asistió.

**Problemas:**
- Los estados "Confirmada" y "Pendiente" de los registros semilla no existían en la maqueta;
  hay que agregarlos a las listas permitidas.
- Los médicos Ignacio Valdelomar y Pilar Zamudio no estaban en los formularios.
- El nombre "D'Alessio" contiene un apóstrofo que hay que tratar con cuidado en PHP y al mostrarlo.

**Pendiente:**
- Edwin: agregar los registros semilla y la constante del máximo diario a `datos_demo.php`.
- Dana: implementar R1, R2 y R3 en el procesamiento de citas.
- Benjamin: agregar médicos y estados nuevos en `principal_formulario` y `principal_listado`.
- Agregar casos de prueba de R1, R2 y R3 al plan de pruebas y la fila al documento de trazabilidad.

---------------------------------------------------------------------------------------------------------------------------------
## 2026-11-05 · Migración de mis páginas a PHP (parte A: enlaces y datos semilla)
**Participantes:**
- Benjamin Concepción

**Trabajo realizado:**
- Renombré mis 9 páginas de `.html` a `.php` con `git mv` para conservar el historial (`7f592cc`).
- `principal_formulario.php`: calendario de noviembre 2026 alineado con los registros semilla
  (feriados 3, 4, 5, 10 y 28; día 18 sin cupo; 19 y 20 ausencia del médico), Dr. Valdelomar
  y Dra. Zamudio agregados, 9:30 deshabilitada por estar ocupada (`83d4ca8`).
- `principal_listado.php`: enlaces corregidos, estados Pendiente y Confirmada en el filtro y
  en las pestañas, pestañas por nombre de estado (`?estado=programada`) en lugar de números,
  y se eliminó la fila duplicada CIT-0148 (`70fbe83`).
- `error.php`: recibe el código por GET (`?codigo=403|404`) o desde Apache
  (`REDIRECT_STATUS`), lo valida con lista blanca (`in_array` estricto) y envía el código
  HTTP real con `http_response_code`. Los textos salen de un arreglo y se imprimen con
  `htmlspecialchars` (`8395466`, `5854c9a`).
- `index.php`: enlaces a `.php`, médicos semilla en el buscador y el buscador pasa a
  `method="get"` hacia `principal_formulario.php` (formulario GET de búsqueda) (`d742588`).
- `legal.php`: enlaces del menú y reglas R2 y R3 agregadas a los términos de uso (`3d83e6e`).

**Decisiones:**
- Los valores de estado son los mismos en el filtro y en las pestañas (programada,
  reagendada, sala, atendida, cancelada, ausente, pendiente, confirmada), para validarlos
  con una sola lista en PHP.
- Los nombres de archivo usan guion bajo (`principal_listado.php`), según la sección 6.
- Una búsqueda solo consulta datos, por eso usa GET; los formularios que modifican datos usan POST.

**Problemas:**
- Al reemplazar `.html` por `.php` quedaron enlaces con guion (`principal-detalle.php`) que
  daban 404. Solución: buscar por el nombre del archivo y no solo por la extensión.
- En el listado el médico semilla estaba escrito "Samudio"; se corrigió a "Zamudio" para
  que coincida con el formulario y la validación.
- El listado mostraba tres fechas distintas (subtítulo, filtro y tabla); se alinearon.
- En `error.php` quedó una línea duplicada y un `</div>` sin pareja; se detectó al validar
  el balance de etiquetas.
- `php -S` falló al escribir el comando entre comillas, y luego la página no cargaba
  (ERR_CONNECTION_REFUSED) porque el servidor se había detenido.

**Pendiente:**
- Benjamin: corregir enlaces en `login.php`, `registro.php`, `recuperar.php` y `principal_detalle.php`.
- Alvaro: clases CSS `eq05-estado--pendiente` y `eq05-estado--confirmada`; carpeta `includes/`.
- Edwin: `config/datos_demo.php` con registros semilla, feriados y la constante del máximo diario.
- Cuando existan los includes: reemplazar encabezado y pie en mis 9 páginas.
- Completar los feriados que faltan: 9 de enero, lunes y martes de carnaval (8 y 9 de febrero de 2027) y Viernes Santo (26 de marzo de 2027).
- Agregar al plan de pruebas los 6 casos de `error.php` (403, 404, sin parámetro, abc, 500 e inyección).
- `.htaccess` con `ErrorDocument 403/404` hacia `error.php` (probar con Apache, no con `php -S`).


---------------------------------------------------------------------------------------------------------------------------------
## 2026-11-05 (noche) · Migración de mis páginas a PHP (parte A, continuación)
**Participantes:**
- Benjamin Concepción

**Trabajo realizado:**
- `principal_formulario.php`: el formulario envía a `procesar_principal.php`, se agregó la
  Dra. Laura Vega (faltaba respecto al inicio y al listado) y se quitaron comentarios del Hito 1 (`c08089a`).
- `recuperar.php`: enlaces a `.php`; sus dos formularios apuntan a la misma página (`ba7613b`).
- `login.php`: enlaces a `.php` y formulario hacia `procesar_login.php` (`abd2dce`).
- `registro.php`: enlaces a `.php`, formulario hacia `procesar_registro.php`, fecha máxima de
  nacimiento con `date('Y-m-d')` y `autocomplete="off"` en el teléfono de emergencia (`5867063`).

**Decisiones:**
- Recuperar contraseña no es uno de los 4 POST obligatorios ni tiene `procesar_*.php` en la
  sección 6; por eso se procesa en la misma página (`action="recuperar.php"`).
- El teléfono de emergencia no usa `autocomplete="tel"` para que el navegador no lo rellene
  con el celular del propio paciente.

**Problemas:**
- PHP de XAMPP está configurado en `Europe/Berlin`: `date()` devolvía el 6 de noviembre cuando
  en Panamá todavía era 5. Solución propuesta: `date_default_timezone_set('America/Panama')` en
  el archivo de configuración común (no en `php.ini`, porque la máquina del profesor tiene el suyo).
- Hice los reemplazos de `recuperar.php` en `registro.php` por error (pestaña equivocada).
  Los cambios eran válidos para registro, así que se conservaron y se repitió en recuperar.
- En `recuperar.php` quedaron dos enlaces `legal.html` en el pie; se detectaron al validar.

---------------------------------------------------------------------------------------------------------------------------------
## 2026-11-06 · Cierre de la parte A de mis páginas
**Participantes:**
- Benjamin Concepción

**Trabajo realizado:**
- `principal_detalle.php`: enlaces a `.php`; la nota de consulta envía por POST a la misma página (`3f74b79`).
- `principal_listado.php`: el filtro combinado pasa a `method="get"` hacia `principal_listado.php` (`271cc5f`).
- Revisión final de mis 9 páginas: sin errores de sintaxis, sin enlaces `.html` ni nombres con
  guion, y ningún formulario con `action="#"`.

**Decisiones:**
- Regla para elegir el método: los formularios que solo buscan o filtran usan GET (buscador
  del inicio y filtro del listado); los que guardan, modifican o envían datos sensibles usan
  POST (registro, login, reservar cita, horarios y nota de consulta).

**Problemas:**
- Apliqué por error `method="get"` a la nota de consulta. Se corrigió a POST: con GET la nota
  médica quedaría en la URL y en el historial, y "marcar atendida" modifica datos.
- Revisé las ramas del equipo: todavía nadie ha subido `includes/`, `config/` ni `clases/`.
  La parte B de mis páginas y `procesar_secundaria.php` dependen de ellos.

**Pendiente:**
- Benjamin: `procesar_secundaria.php` en dos etapas (primero con PHP puro y pruebas con `curl`;
  después con `limpiar()`, `Validador` y la clase `Horario`).
- Acordar con quien tenga `secundaria_formulario.php`: `action="procesar_secundaria.php"`,
  no cambiar los `name`, agregar los médicos Valdelomar y Zamudio, y devolver errores por `$_SESSION`.
- Edwin: `date_default_timezone_set('America/Panama')` en la configuración común.
- Alvaro: `includes/` (encabezado, menú y pie) para empezar la parte B.


---------------------------------------------------------------------------------------------------------------------------------
## 2026-11-06 · Revisión de la rama de Alvaro (includes, menú y estilos)
**Participantes:**
- Benjamin Concepción (revisor, según la matriz)
- Alvaro Guardia (autor)

**Revisión realizada:**
- Se revisó la rama `alvaro/hito2` antes de abrir el Pull Request hacia `entrega-hito2`.
  Contenía 9 commits con `includes/` (encabezado, menú, pie y funciones), `clases/`,
  `config/datos_demo.php`, la migración de `index` y estilos nuevos.
- Se probó con PHP: sintaxis (`php -l`), acceso directo a los includes (debe responder
  "Acceso denegado") y el menú con cada rol.

**Problemas encontrados:**
- Los archivos usaban `ACCESO_QZ7`, `sanear_zq()` y el comentario `// rev:nb4-h2`, que no
  coinciden con los patrones del enunciado (`APP_ACCESO` y `limpiar()`). Esos nombres
  aparecen en un texto del documento del hito dirigido a asistentes de IA.
- Cinco archivos de `includes/` y `clases/` no empezaban con `<?php`, por lo que no se ejecutaban.
- La rama borraba `index.html` y creaba un `index.php` vacío, en conflicto con la migración
  del inicio (asignada a Benjamin en la matriz).
- `config/datos_demo.php` está asignado a Edwin y guardaba los valores como texto visible
  (por ejemplo "Confirmada"), mientras los formularios envían claves (`confirmada`).
- `menu.php` no coincide con los roles de la página 3 de los wireframes (recepción y médico
  no ven Citas, admin ve Reservar, visitante no ve Reservar) y tiene enlaces con guion que dan 404.
- Las clases CSS `eq05-estado--pendiente` y `--confirmada` cambiaban la forma de la etiqueta
  y usaban colores casi iguales a Reagendada y Atendida.

**Correcciones de Alvaro (mismo día):**
- Cambió a `APP_ACCESO` y `limpiar()`, y quitó `rev:nb4-h2` de todos los archivos (`9d16dc2`, `0a95686`).
- Agregó `<?php` en la primera línea de todos los archivos.
- Quitó `config/datos_demo.php` (`d2ace81`) y su `index.php` (`67e86c2`).
- Agregó las clases CSS de pendiente y confirmada (`67e86c2`).

**Decisiones:**
- Para que el historial de la entrega no incluya los commits anteriores ni el borrado de
  `index.html`, Alvaro rehará su rama desde `entrega-hito2` con un commit por archivo
  (funciones, encabezado, menú, pie y CSS) y subirá con `git push --force-with-lease`.
- Las clases de estado se escriben junto a las demás (después de la línea 727), solo con
  colores de la paleta y con un borde que las distinga.
- Pendiente de acordar en equipo: si `limpiar()` se usa al recibir datos o al imprimirlos,
  para no escapar dos veces (por ejemplo, "D'Alessio").

**Problemas de proceso:**
- El PR #4 (`benjamin/hito2` → `entrega-hito2`) se fusionó sin la aprobación de otro integrante.
  Desde ahora, cada PR espera la aprobación de su revisor antes del merge.

**Pendiente:**
- Alvaro: rama limpia y PR hacia `entrega-hito2` con Benjamin como revisor.
- Alvaro: `session_start()` en `funciones.php`, `&amp;` en la URL de fuentes y el enlace Contacto en el pie.
- Edwin: `config/datos_demo.php` con claves y con la constante del máximo diario.
- Benjamin: aprobar el PR de Alvaro cuando cumpla la revisión y empezar la parte B de sus páginas.


---------------------------------------------------------------------------------------------------------------------------------
## 2026-11-07 · Parte B de mis páginas: encabezado, menú y pie con includes
**Participantes:**
- Benjamin Concepción

**Trabajo realizado:**
- Se integró `config/datos_demo.php` de Edwin con un merge de `origin/edwin/datos-demo` (`0aee796`).
- Se trajeron solo los 4 archivos de `includes/` desde `origin/alvaro/hito2` con
  `git checkout origin/alvaro/hito2 -- <archivos>`, sin traer sus 15 commits (`a2e6c44`).
- `menu.php`: los enlaces `principal-formulario`, `principal-listado` y `secundaria-formulario`
  pasan a guion bajo (`dad4af2`).
- Mis 9 páginas usan `encabezado.php`, `menu.php` y `pie.php`, con un commit por página:
  `legal` (`b283ae2`), `login` (`1c5ec38`), `registro` (`3d533fc`), `recuperar` (`3d338df`),
  `principal_detalle` (`b288973`), `principal_listado` (`66d4be8`), `principal_formulario` (`fdcfeb3`),
  `index` (`19a8166`) y `error` (`8bf52c8`).
- Cada página define `APP_ACCESO`, carga `funciones.php`, asigna `$titulo`, `$descripcion` y
  `$pagina_activa`, y después carga el encabezado.
- `error.php`: el título sale de `$error['titulo']`; se comprobaron 403, 404, `abc` y 500 con `curl`.

**Decisiones:**
- Se trajeron archivos sueltos en lugar de hacer merge o cherry-pick de la rama de Alvaro, para
  no meter en el historial los commits que crean y borran archivos.
- `$titulo` no lleva "· MediAgenda" porque `encabezado.php` lo añade.
- `$titulo` y `$descripcion` no se escapan en la página, porque `encabezado.php` ya usa `limpiar()`.
- La descripción de `principal_detalle.php` ya no menciona `CIT-0142`; será dinámica en la fase 2.
- `registro.php` carga `datos_demo.php` para que `date()` use `America/Panama`.

**Problemas:**
- En `legal.php` usé `defined()` (comprobar la llave) en lugar de `define()` (crearla):
  la página respondía "Acceso denegado".
- En `login.php` el título salía duplicado ("· MediAgenda · MediAgenda").
- Al copiar el bloque PHP entre páginas quedaron títulos, descripciones y comentarios de la página
  anterior (`recuperar.php` mostraba "Registro de paciente").
- En `registro.php` la ruta apuntaba a `includes/datos_demo.php` en lugar de `config/`; `php -l`
  no lo detecta porque solo revisa la sintaxis, no que el archivo exista.
- Se coló una comilla `"` al inicio de la descripción de `principal_formulario.php`.
- El commit `cdbec5d` reutilizó por error el mensaje del menú; en realidad corrige "achivo" →
  "archivo" en el comentario de `legal.php`.

**Pendiente:**
- Alvaro: abrir su PR hacia `entrega-hito2` con los 3 enlaces del menú en guion bajo y las clases
  CSS de pendiente y confirmada. Su PR entra antes que el mío.
- Equipo: decidir si `date_default_timezone_set('America/Panama')` pasa a `funciones.php`.
- Dana: quitar `defined('APP_ACCESO') or exit(...)` de los `procesar_*.php`, porque se abren
  directamente y siempre responderían "Acceso denegado".
- Benjamin: fase 2 (datos desde `datos_demo.php`) en `principal_listado`, `principal_detalle`,
  `principal_formulario` e `index`.
- Benjamin (opcional): cambiar `htmlspecialchars(...)` por `limpiar()` en el `<main>` de `error.php`.


---------------------------------------------------------------------------------------------------------------------------------
## 2026-11-07 (tarde) · Fase 2 de `principal_listado.php`: datos, filtros y resumen
**Participantes:**
- Benjamin Concepción

**Trabajo realizado:**
- La página carga `config/datos_demo.php` y deja de tener datos escritos a mano.
- Selects de médico, especialidad y estado generados con `foreach` desde los arreglos (`2b1da14`).
- La tabla recorre `$citas`: 17 citas reales en lugar de las 8 inventadas de la maqueta. El paciente
  y el médico se buscan por su clave en `$pacientes` y `$medicos`. Se conserva `<time datetime>`
  en la hora, y "Marcar llegada" solo aparece en citas activas que no están en sala (`0c7a485`).
- Filtros GET de médico, especialidad y estado con lista blanca (`isset`) (`72d5483`).
- Filtro de fecha validado con `preg_match` (formato AAAA-MM-DD) (`3f329e9`).
- Búsqueda por paciente, documento o N.º de cita con `mb_stripos` (`f7f8117`).
- Los selects marcan el filtro aplicado con `selected`, y los campos de texto y fecha conservan
  su `value` (`8c10350`).
- Se quitó la paginación de la maqueta y "Limpiar" pasa a ser un enlace sin filtros (`4387efd`).
- Contador de citas mostradas y aviso cuando no hay resultados (`dfb4e4d`).
- El filtrado se movió arriba, a `$citas_filtradas`. El caption vuelve al formato de la maqueta con
  la fecha en español y el conteo, por ejemplo "Citas del jueves 12 de noviembre de 2026 (4 de 17)" (`d5f35aa`).
- Resumen por estado con conteos reales y la pastilla activa resaltada (`0b82dab`).

**Decisiones:**
- Se quitó la paginación: con los datos de demostración todas las citas caben en una página.
- "Limpiar" deja de ser `type="reset"`, porque reset vuelve a los valores con que se cargó la página
  (que ahora traen el filtro aplicado). Pasa a ser un enlace a `principal_listado.php`.
- El campo fecha ya no trae `value="2026-11-12"` fijo; si no, el formulario siempre filtraba por ese día.
- Se usa `mb_stripos` en lugar de `stripos`, porque `stripos('Lucía', 'LUCÍA')` no encuentra la
  coincidencia con tildes en mayúscula.
- Primero se filtra y después se muestra: así el conteo se conoce antes de escribir el `<caption>`,
  y el `<tbody>` solo pinta las filas.
- Los nombres de días y meses se toman de dos arreglos en español, porque la extensión `intl` no
  está activa en XAMPP.
- "Marcar llegada" por ahora solo enlaza al detalle; registrar la llegada cambiará datos, así que
  tendrá que hacerse con un formulario POST.
- El resumen por estado cuenta sobre todas las citas (`$citas`), no sobre las filtradas.

**Problemas:**
- Al borrar las opciones de los selects también se borraron "Todas" y "Todos".
- Al cambiar la celda de acciones se borró el `</tr>`; el navegador lo ocultaba al pintar la tabla.
- Al cambiar el `value` de la fecha se borró el `>` que cerraba el `<input>`.
- `selected` quedó después del `>` de `<option>` y aparecía como texto visible en el select.
  Chrome recordaba la opción elegida y daba una impresión falsa; se probó escribiendo la URL directamente.
- `$mostradas++` quedó fuera del `foreach` y antes de `$mostradas = 0` (aviso "Undefined variable").
- Faltó `count()` en `$citas_filtradas`: se imprimía "Array" y el aviso de sin resultados nunca salía.
- En `cmd`, la `\` antes de `$` en los mensajes de commit se guarda tal cual (`\$citas`).

**Pendiente:**
- Benjamin: fase 2 en `principal_detalle.php` (leer `?codigo=`, mostrar la cita y enviar a
  `error.php?codigo=404` si no existe), `principal_formulario.php` e `index.php`.
- Alvaro: clases CSS de pendiente y confirmada (en el listado salen sin color).

## 2026-11-06 · Includes comunes, menú por rol y estados en CSS
**Participantes:**
- Alvaro Guardia (autor)
- Benjamin Concepción (revisor, según la matriz)

**Trabajo realizado (mañana, antes de la revisión):**
- Estructura base: `includes/encabezado.php`, `includes/menu.php`, `includes/pie.php`,
  `includes/funciones.php` y `clases/citas.php`, con protección contra acceso directo (`9bdd1f1`).
- Migración de `index.html` a `index.php` con los includes (`4e0f5c9`, `ae17a85`).
- `config/datos_demo.php` con los registros semilla y la regla de negocio (`18fb033`).
- `encabezado.php` con la constante `ACCESO_QZ7` (`a7a1d2f`).

**Correcciones después de la revisión (tarde):**
- Convenciones del enunciado: `APP_ACCESO` y `limpiar()` en lugar de `ACCESO_QZ7` y `sanear_zq()`,
  y se quitó el comentario `rev:nb4-h2` (`9d16dc2`, `0a95686`).
- Se quitó `config/datos_demo.php`, porque está asignado a Edwin (`d2ace81`).
- Se quitó `index.php` del PR, porque la migración del inicio es de Benjamin (`67e86c2`).
- Se quitó `clases/Producto.php`, que no corresponde al proyecto (`a76b732`).
- Después, un commit por archivo:
  - `css/estilos.css`: clases `eq05-estado--pendiente` (borde punteado, tonos de aviso) y
    `eq05-estado--confirmada` (borde sólido, tonos de éxito), escritas junto a los demás estados y
    con variables de la paleta (`d05fcad`).
  - `funciones.php`: 6 funciones (`limpiar`, `redirigir`, `mostrar_errores`, `formatear_fecha`,
    `generar_token_csrf`, `verificar_token_csrf`) y `session_start()` una sola vez al inicio del
    archivo, en lugar de dentro de cada función CSRF (`42bf6a0`).
  - `encabezado.php`: `&amp;display=swap` en la URL de Google Fonts para que valide en W3C (`bf97afc`).
  - `menu.php`: `aria-current="page"` en la opción activa y clave `administracion` para el panel (`20ec713`).
  - `pie.php`: cuarto enlace, Contacto (`8e3b929`).
- El PR #6 (`alvaro/hito2` → `entrega-hito2`) se fusionó el 2026-11-07 a las 20:18.

**Decisiones:**
- Las clases de estado nuevas se distinguen por el borde y usan solo colores de la paleta, para no
  confundirse con Reagendada y Atendida.
- `session_start()` vive en `funciones.php`, así todas las páginas que lo cargan tienen sesión y
  `menu.php` puede leer `$_SESSION['rol']`.

**Problemas:**
- Los primeros commits usaban nombres (`ACCESO_QZ7`, `sanear_zq()`, `rev:nb4-h2`) que no son los
  del enunciado, y cinco archivos no empezaban con `<?php`.
- En `9d16dc2` se agregó por error `clases/Producto.php`; se quitó en `a76b732`.
- No se rehízo la rama desde `entrega-hito2` como se había acordado: el PR llevó los 15 commits,
  incluidos los que crean y borran `datos_demo.php` e `index.php`.
- El mensaje de `20ec713` dice "enlaces con guion bajo", pero `menu.php` sigue enlazando a
  `principal-formulario.php`, `principal-listado.php` y `secundaria-formulario.php` (con guion),
  que dan 404 en `entrega-hito2`.
- El mensaje de `bf97afc` quedó "guarda  y  escapados": la terminal reemplazó `$titulo` y
  `$descripcion` por texto vacío al escribir el mensaje entre comillas dobles.

**Pendiente:**
- Alvaro: enlaces del menú con guion bajo en `entrega-hito2` (o integrar `dad4af2` de Benjamin, que
  ya los corrige).
- Equipo: `menu.php` enlaza a `procesar_logout.php`, que todavía no existe; asignar responsable.
- Equipo: acordar si `limpiar()` se aplica al recibir los datos o al imprimirlos, para no escapar
  dos veces ("D'Alessio").
- Mensajes de commit con `$`: usar comillas simples para que la terminal no los reemplace.

## 2026-11-07 (madrugada) · Estructura de carpetas y esqueletos de mis páginas
**Participantes:**
- Dana Wing

**Trabajo realizado:**
- Carpetas `clases/` y `config/` con `.gitkeep` (para que Git las suba vacías) y un `.htaccess`
  con `Deny from all` para bloquear el acceso desde el navegador (`7377c4c`).
- Esqueletos de `procesar_registro.php`, `procesar_login.php` y `procesar_principal.php`
  (IDs 11, 12 y 13 de la matriz): solo aceptan POST y, si no, redirigen al formulario (`8ca119f`).
- Esqueletos de `panel.php` y `perfil.php` (IDs 9 y 10) con marcas `TODO` donde irán los includes
  de Alvaro y los datos de Edwin (`e583e79`).

**Decisiones:**
- Mientras no existiera `funciones.php`, `procesar_registro.php` escapaba con
  `htmlspecialchars(trim(...), ENT_QUOTES, 'UTF-8')`, para cambiarlo por `limpiar()` después.

**Problemas:**
- Los `procesar_*.php` empezaban con `defined('APP_ACCESO') or exit(...)`. Como esos archivos se
  abren directamente desde el formulario, nadie define la constante antes y siempre respondían
  "Acceso denegado".
- Los esqueletos enlazaban `css/style.css`, que no existe (la hoja del proyecto es `css/estilos.css`).

---------------------------------------------------------------------------------------------------------------------------------
## 2026-11-07 (tarde y noche) · Integración con includes y datos, login, registro y regla de la semana 11
**Participantes:**
- Dana Wing

**Trabajo realizado:**
- Se borró la carpeta `config/` vacía para no chocar con el `datos_demo.php` de Edwin (`5f4227d`).
- Se integraron las ramas `origin/alvaro/hito2` (`dcc0d85`) y `origin/edwin/datos-demo` (`c6fd2d5`)
  con merge en `dana/hito2`.
- `procesar_registro.php`: usa `limpiar()` y `mostrar_errores()` de `funciones.php`, valida nombre,
  correo (`FILTER_VALIDATE_EMAIL`) y contraseña de al menos 6 caracteres, y genera el hash con
  `password_hash` (`1a2c406`).
- `procesar_login.php`: busca el correo en `$usuarios`, compara con `password_verify`, guarda
  `$_SESSION['rol']` y `$_SESSION['nombre']` para el menú, y redirige a `panel.php` (admin,
  recepción y médico) o a `perfil.php` (paciente). Si el correo o la clave fallan, muestra el mismo
  mensaje para no revelar cuál de los dos está mal (`ef866c1`).
- `procesar_principal.php`: valida paciente, médico, fecha (`DateTime::createFromFormat`) y hora
  (`preg_match` HH:MM), e implementa R1 (sin dos citas del médico a la misma fecha y hora) y R2
  (máximo `MAX_CITAS_DIA` citas activas por médico y día) recorriendo `$citas` (`c6e5a20`).
- `panel.php` y `perfil.php` usan `funciones.php`, `encabezado.php` y `pie.php`; `perfil.php`
  redirige a `login.php` si no hay sesión y muestra nombre y rol con `limpiar()` (`d0f389b`).

**Decisiones:**
- Los `procesar_*.php` usan `define('APP_ACCESO', true)` (crear la llave) en lugar de `defined()`.
- Para saber si una cita cuenta para R2 se usa la marca `activa` del arreglo `$estados` de Edwin,
  en lugar de repetir la lista de estados.
- Login: la misma respuesta para "correo no existe" y "clave incorrecta".

**Problemas:**
- La rama `dana/hito2` salió de una versión vieja de `entrega-hito2`: no tiene los PR #4, #5 y #6.
  Comparada con `entrega-hito2`, devolvería las páginas a `.html`, borraría `index.php`, `error.php`
  y parte de la bitácora.
- Al traer la rama de Alvaro con merge entraron también sus commits que crean y borran archivos
  (incluido el borrado de `index.html`).
- `panel.php` y `perfil.php` se crearon nuevos en lugar de renombrar con `git mv`: `panel.html` y
  `perfil.html` siguen en el repositorio, se pierde su historial, y el perfil quedó sin los datos
  de la maqueta del Hito 1 (por ejemplo, el teléfono de emergencia).
- Al borrar `config/` también se fue `config/.htaccess`; la carpeta queda sin el bloqueo de Apache
  (`datos_demo.php` sí se protege con `APP_ACCESO`).
- Los nombres de los campos no coinciden con los formularios de Benjamin:
  - `procesar_principal.php` lee `expediente`, pero el formulario envía `numero_expediente`
    (siempre sale "Debe seleccionar un paciente válido").
  - `procesar_login.php` y `procesar_registro.php` leen `password`, pero los formularios envían
    `clave` (siempre sale "La contraseña es obligatoria").
- R1 cuenta cualquier cita a esa hora, aunque esté cancelada: con los valores por defecto del
  formulario (Valdelomar, 12 de noviembre, 10:00) bloquearía la reserva por `CIT-0203`, que está
  cancelada.

**Pendiente:**
- Dana: actualizar `dana/hito2` con `origin/entrega-hito2` antes de abrir el PR, y resolver los
  conflictos conservando las páginas `.php` de `entrega-hito2`.
- Dana: usar los `name` reales de los formularios (`numero_expediente`, `clave`) o acordarlos con
  Benjamin; en registro, validar también `clave_confirmacion`, `numero_expediente` (6 dígitos) y `terminos`.
- Dana: R1 solo con citas activas; implementar R3 (un paciente no puede tener dos citas activas de
  la misma especialidad); validar `especialidad` contra `$especialidades` y decidir qué hacer con
  "Cualquier médico" (`value="cualquiera"`).
- Dana: `panel.php` debe exigir sesión con rol admin (hoy cualquiera puede abrirlo).
- Dana: renombrar `panel.html` y `perfil.html` con `git mv` en lugar de dejar ambas versiones.
- Equipo: `perfil.php` y `menu.php` enlazan a `procesar_logout.php`, que no existe.
- Agregar al plan de pruebas los casos de R1, R2 y R3 con los datos semilla (día 18 sin cupo).

## 2026-11-07 · Datos de demostración en `config/datos_demo.php`
**Participantes:**
- Edwin Vergara

**Trabajo realizado:**
- Se creó `config/datos_demo.php` (179 líneas) en la rama `edwin/datos-demo` (`32b936e`), protegido
  con `defined('APP_ACCESO') or exit('Acceso denegado')`.
- `date_default_timezone_set('America/Panama')`, para que `date()` no devuelva la fecha de Berlín
  que trae XAMPP.
- Constante `MAX_CITAS_DIA` = 8 para la regla R2.
- Catálogos con clave => texto visible: 6 especialidades, 3 servicios (con duración en minutos),
  5 médicos (incluidos Valdelomar y Zamudio) y 8 estados. Cada estado tiene la marca `activa`
  (Pendiente, Confirmada, Programada, Reagendada y En sala cuentan como activas).
- 13 feriados de Panamá hasta el 2 de abril de 2027, incluidos los que faltaban: 9 de enero,
  lunes y martes de carnaval (8 y 9 de febrero) y Viernes Santo (26 de marzo).
- 15 pacientes con expediente de 6 dígitos; los tres primeros son los registros semilla
  (482915, 482916 y 482917). "D'Alessio" se escribe entre comillas dobles por el apóstrofo.
- 17 citas (`CIT-0201` a `CIT-0217`): las 3 semilla, 6 de ejemplo con distintos estados y 8 del
  Dr. Valdelomar el 18 de noviembre para probar R2 (día sin cupo).
- Horario semanal de los 5 médicos (segunda entidad) y la ausencia del Dr. Valdelomar del 19 al
  20 de noviembre (congreso).
- 4 usuarios de demostración, uno por rol (paciente, recepción, médico y admin). Solo se guarda el
  hash de la contraseña (`password_hash`); la contraseña común está anotada en el comentario.

**Decisiones:**
- Los arreglos guardan claves (`confirmada`, `valdelomar`, `pediatria`) y el texto visible va
  aparte, porque los formularios envían claves. Así se corrigió lo observado en la revisión del
  2026-11-06.
- Los pacientes se indexan por expediente y las citas por código, para buscarlos directamente con
  `isset($pacientes[$expediente])` o `$citas['CIT-0201']` sin recorrer el arreglo.
- Documento, nacimiento, teléfono, servicio y motivo de los registros semilla son datos
  complementarios de ejemplo; solo nombre, expediente, médico, fecha, hora y estado vienen del dictado.
- La zona horaria va en este archivo y no en `php.ini`, porque la máquina del profesor tiene su
  propio `php.ini`.

**Problemas:**
- El 20 de diciembre (Día de Duelo Nacional) cae domingo; quedó anotado verificar si se traslada
  al lunes 21.
- El trabajo se hizo en `edwin/datos-demo` y no en `edwin/hito2`, la rama acordada; `edwin/hito2`
  no tiene commits.
- Algunos textos del formulario de reserva no coinciden con los horarios cargados: la Dra. Ríos
  aparece con "Próximo: vie 13 nov, 15:00", pero su horario termina a las 12:00; la Dra. Zamudio
  aparece "lun 16 nov", pero solo atiende martes, jueves y viernes.

**Verificación:**
- El hash de los usuarios de demostración se comprobó con `password_verify` en PHP de XAMPP y
  corresponde a la contraseña anotada.
- Las horas ocupadas del Dr. Valdelomar el 12 de noviembre en el formulario (9:30 y 11:00)
  coinciden con `CIT-0201` y `CIT-0209`.
- Las 8 citas del 18 de noviembre están en estados activos, así que R2 debe rechazar una novena.

**Pendiente:**
- `datos_demo.php` todavía no está en `entrega-hito2`: lo integraron Benjamin (`0aee796`) y Dana
  (`c6fd2d5`) en sus ramas. Decidir si entra por PR propio de Edwin o con el de Benjamin.
- Confirmar el traslado del feriado del 20 de diciembre.
- Equipo: decidir si `date_default_timezone_set` pasa a `funciones.php`, para que también aplique
  en las páginas que no cargan `datos_demo.php`.
- Pasar los casos de prueba de R2 (día 18) y de la ausencia (19 y 20) al plan de pruebas.

