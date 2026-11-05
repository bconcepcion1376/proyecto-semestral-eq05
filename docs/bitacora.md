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
  - Benjamin,  Desarrollo (backend PHP), repositorio y documentación.
  - Dana, líder de proyecto.
  - Alvaro, Diseño y experiencia de usuario.
  - Calidad, seguridad.

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