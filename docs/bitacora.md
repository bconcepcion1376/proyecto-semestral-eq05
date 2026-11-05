# Bitácora del equipo 05 · Hito 2

Registro de las sesiones de trabajo del Hito 2 (Integración frontend con PHP).
Cada entrada indica fecha, participantes, decisiones, problemas y pendientes.

---

## 2026-11-05 · Preparación del repositorio
**Participantes:** Benjamin Concepción [agregar a quien haya participado]

**Decisiones:**
- Se creó la rama de entrega `entrega-hito2` a partir de `main`, después de `git pull`.
- Se verificó que Issues está habilitado y que el workflow `control-entrega-hito2` corre en verde.
- Cada integrante trabaja en su rama personal `nombre/hito2`, creada desde `entrega-hito2`.
- Los cambios entran a `entrega-hito2` solo mediante Pull Request revisado por otro integrante.
- Roles del Hito 2: Benjamin, líder de proyecto. [completar los demás roles]

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