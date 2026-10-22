# Guía de presentación – MediAgenda (Hito 1)

**Archivo:** `docs/presentacion_mediagenda.pptx` (21 diapositivas)
**Duración:** unos 20 minutos de exposición, 3 de demo en vivo y el tiempo de preguntas.
**Orden:** Benjamin → Edwin → Dana → Alvaro → Benjamin (cierre).

Cada diapositiva indica arriba a la derecha quién la presenta, y el guion completo de cada una está en las **notas del orador** del PowerPoint. Para verlas al presentar, activen la *vista del moderador*: `Presentación con diapositivas → Usar vista del moderador`.

---

## 1. Reparto

| # | Integrante | Rol en el equipo | Diapositivas | Tema | Tiempo |
|---|---|---|---|---|---|
| 1 | **Benjamin Concepción** | Líder de proyecto y desarrollo HTML/CSS | 1 – 4 | Portada, equipo, problema y propuesta | 3,5 min |
| 2 | **Edwin** | Documentación | 5 – 10 | Alcance: roles, módulos, recorrido, reagendado, entidades, reglas | 5 min |
| 3 | **Dana Wing** | Calidad y validación W3C | 11 – 15 | Entrevista, hallazgos, wireframes, usabilidad y guía de estilo | 5 min |
| 4 | **Alvaro Guardia** | Calidad y validación W3C | 16 – 19 + demo | Maqueta, pantalla Reservar cita, técnica y validación W3C | 4 min + 3 de demo |
| 1 | **Benjamin Concepción** | — | 20 – 21 | Próximos pasos, cierre y preguntas | 1,5 min |

> Regla de oro: cerca de **1 minuto por diapositiva**. Si van atrasados, acorten las diapositivas 6, 9 y 14, no la demo.

---

## 2. Guion por integrante

### Benjamin: introducción (diapositivas 1 a 4)

| Diap. | Mensaje clave (una idea) | Qué decir |
|---|---|---|
| 1 · Portada | Quiénes somos y qué presentamos | Equipo 05, MediAgenda, citas médicas para Clínicas Minimed. Hoy cubrimos el Hito 1. |
| 2 · Equipo | Cómo nos repartimos | Presentar a cada integrante con su rol y quién presenta qué. |
| 3 · Problema | Hoy la cita depende del papel | Libretas, solo en horario de atención, reacomodo manual. Leer el **objetivo**. |
| 4 · Propuesta | Tres diferencias: 24/7, feriados y en bloque | Señalar en el calendario el 8 y 9 de febrero (carnaval) y mencionar el 1 de julio. |

**Pase a Edwin:** *"Ahora Edwin les explica qué abarca exactamente el sistema."*

### Edwin: alcance del sistema (diapositivas 5 a 10)

| Diap. | Mensaje clave | Qué decir |
|---|---|---|
| 5 · Roles | Cuatro roles, cada uno con una tarea | Paciente, Recepción, Médico, Administrador y sus pantallas. |
| 6 · Módulos | Cinco módulos cubren el ciclo | Recorrer los 5 y explicar qué pregunta responde cada reporte. |
| 7 · Recorrido | Reserva → Validación → Llegada → Consulta → Reporte | Recalcar que el paso 1 funciona 24/7. |
| 8 · Reagendado | Hoy son llamadas; con MediAgenda, un clic | Comparar las dos columnas y leer el aviso «Esta ausencia afecta 9 citas». |
| 9 · Entidades | Diez entidades; la Cita une todo | Las tres agrupaciones y el diagrama de la Cita. |
| 10 · Reglas | Lo propio del equipo y el límite del alcance | Prefijo `eq05-`, color `#0A62A0`, expediente de 6 dígitos y regla de 24 h. Qué queda fuera. |

**Pase a Dana:** *"Para definir esto no partimos de supuestos: Dana les cuenta lo que encontramos en campo."*

### Dana: investigación y diseño (diapositivas 11 a 15)

| Diap. | Mensaje clave | Qué decir |
|---|---|---|
| 11 · Entrevista | Escuchamos a una paciente real | Ficha de la entrevista y las cuatro molestias principales (P2, P5, P6, P8). |
| 12 · Hallazgos | Tres hallazgos cambiaron el diseño | Por cada fila: lo que encontramos, el cambio y la página donde se ve. |
| 13 · Wireframes | 11 pantallas de escritorio y 5 móviles | Explicar las anotaciones y el flujo de navegación por rol. |
| 14 · Usabilidad | Así vamos a probar el diseño | Objetivo, 5 participantes y meta SUS ≥ 68. Poner de ejemplo la tarea T2 (carnaval). |
| 15 · Guía de estilo | Un sistema visual coherente | La paleta parte del `#0A62A0`, la tipografía es Inter y hay cuatro principios. |

**Pase a Alvaro:** *"Alvaro les muestra cómo todo esto se convirtió en la maqueta."*

### Alvaro: maqueta y validación (diapositivas 16 a 19, más la demo)

| Diap. | Mensaje clave | Qué decir |
|---|---|---|
| 16 · Maqueta | 12 páginas navegables | Recorrer las 8 capturas y nombrar las páginas restantes. |
| 17 · Reservar cita | La pantalla principal cumple las reglas | Explicar los 4 marcadores: calendario, expediente, 24 h y botón primario. |
| 18 · Técnica | HTML5 semántico y CSS3 adaptable | Las cifras, la semántica y el diseño adaptable a móvil. |
| 19 · Validación | 0 errores en HTML y CSS | Las capturas del W3C y la lista de accesibilidad. |

**Pase a Benjamin:** *"Benjamin cierra con los próximos pasos."*

### Benjamin: cierre (diapositivas 20 y 21)

| Diap. | Mensaje clave | Qué decir |
|---|---|---|
| 20 · Próximos pasos | 3 % hoy, 50 % en la parcial y 47 % en la final | Pendientes inmediatos y la declaración de uso de IA (Qwen). |
| 21 · Gracias | Abrir preguntas | Dar las preguntas a quien corresponda (ver sección 4). |

---

## 3. Demo en vivo (Alvaro, unos 3 minutos)

Háganla después de la diapositiva 17 o al final, antes de las preguntas. Dejen el navegador abierto en una pestaña aparte **antes** de empezar.

1. Abrir `index.html` y mostrar el encabezado, el buscador de especialidad y el aviso de feriados.
2. Ir a **Reservar cita** (`principal-formulario.html`):
   - Pasar el cursor sobre el **8 y 9 de febrero** para que aparezca el aviso «Carnaval, sin atención».
   - Escribir 3 dígitos en **Número de expediente** e intentar enviar para mostrar la validación de 6 dígitos.
   - Señalar la nota de las **24 horas** y el resumen con **Confirmar cita**.
3. Ir a **Citas** (`principal-listado.html`) y mostrar los filtros y los estados.
4. Ir a **Horarios** (`secundaria-formulario.html`) y mostrar la vista previa del reagendado.
5. Reducir el ancho del navegador (o abrir las herramientas de desarrollo en vista móvil) para mostrar el menú plegable y la tabla convertida en tarjetas.

**Plan B:** si falla la computadora o el proyector, las diapositivas 16 a 18 ya tienen capturas reales de cada pantalla.

---

## 4. Preguntas probables y quién responde

| Pregunta | Responde | Respuesta corta |
|---|---|---|
| ¿Por qué no incluyen pagos o WhatsApp? | Edwin | Están fuera del alcance de esta etapa; se pueden sumar después sin cambiar el núcleo. |
| ¿Qué pasa si el paciente quiere cambiar su cita con menos de 24 h? | Edwin | No puede hacerlo en línea; Recepción sí puede reagendar sin ese límite. |
| ¿Cómo sabe el sistema cuándo es carnaval? | Edwin | El administrador carga los feriados en el módulo de horarios y la agenda los bloquea. |
| ¿A quién entrevistaron y cómo se verifica? | Dana | A una paciente usuaria de clínicas, 25 minutos por audio de WhatsApp. Autorizó el uso académico y acepta que el docente la contacte. |
| ¿Ya aplicaron la prueba de usabilidad? | Dana | El plan está listo (8 tareas, 5 participantes) y se aplica en la siguiente etapa. |
| ¿Por qué Inter y esos colores? | Dana | El azul `#0A62A0` fue asignado por el docente; el resto de la paleta son tonos de ese azul con el coral como acento. Inter se lee muy bien en pantalla. |
| ¿Validaron todas las páginas? | Alvaro | Sí: las 12 páginas sin errores en el Nu Html Checker y `estilos.css` sin errores en CSS3. |
| El validador CSS muestra 25 advertencias, ¿no es un problema? | Alvaro | Son advertencias, no errores; el validador dice «No error encontrado». |
| ¿Por qué los formularios usan `action="#"`? | Alvaro | Es una maqueta estática; así lo pide la rúbrica del Hito 1. |
| ¿Usaron inteligencia artificial? | Benjamin | Sí, Qwen, solo como asistente para auditar la rúbrica y sugerir mejoras de accesibilidad. Así lo declara el README. |
| ¿Qué sigue? | Benjamin | La entrega parcial (50 %): avance del sistema según el kickoff. |

---

## 5. Lista de verificación antes de presentar

- [ ] Ensayar al menos una vez completo y con cronómetro (meta: menos de 23 minutos).
- [ ] Cada integrante conoce la frase de pase al siguiente.
- [ ] Probar el proyector con la *vista del moderador* activada.
- [ ] Tener abierto `index.html` en el navegador para la demo, con la ventana ya en tamaño escritorio.
- [ ] Llevar una copia del `.pptx` en una memoria USB o en la nube.
- [ ] **Revisar los PDF vacíos:** `docs/bitacora.pdf`, `docs/matriz_responsabilidad.pdf` y `docs/usabilidad.pdf` pesan 0 bytes en el repositorio. Si el docente los pide, deben subirse antes de la presentación.
- [ ] Confirmar el apellido de Edwin para la portada y la diapositiva 2 (en el README solo aparece «Edwin»).
