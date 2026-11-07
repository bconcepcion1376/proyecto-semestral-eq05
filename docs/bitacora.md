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
