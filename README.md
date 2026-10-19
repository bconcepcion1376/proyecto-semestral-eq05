# MediAgenda – Kickoff (Hito 1, Fase Inicial)

## Propuesta del sistema

**Nombre:** MediAgenda, sistema web de citas médicas.

## Alcance

### Contexto y problema

Se usaría en las clínicas privadas Minimed, en Ciudad de Panamá. Hoy las citas se agendan en papel o presencialmente, solo en horario de atención, y recepción las reacomoda a mano cuando un médico falta o cae un feriado nacional, carnaval o la toma de posesión.

### Usuarios

| Rol | Qué hace |
|---|---|
| **Paciente** | Solicita, reprograma o cancela sus citas en línea. |
| **Recepción** | Confirma la llegada del paciente y reagenda citas cuando falta el médico. |
| **Médico** | Consulta su agenda y registra una nota de cada consulta. |
| **Administrador** | Gestiona usuarios, roles, especialidades, servicios y feriados. |

### Módulos

1. **Usuarios y roles:** crear, modificar y asignar permisos a los usuarios.
2. **Horarios y disponibilidad:** configurar el horario de cada médico, sus ausencias y los feriados.
3. **Gestión de agenda:** reservar, reprogramar y cancelar citas según la disponibilidad real.
4. **Consulta médica:** registrar la nota e historial del paciente atendido.
5. **Reportes:** informes de citas por mes, médico y especialidad, cancelaciones y ausentismo.

### Entidades de datos

Usuario, Rol, Paciente, Médico, Especialidad, Servicio, Horario, Feriado, Cita y Nota de consulta.

### Fuera de alcance

- Pagos en línea.
- Mensajes por WhatsApp o SMS.
- Facturación a aseguradoras.

### Diferencia

A diferencia de agendar por teléfono o en la libreta de recepción, MediAgenda funciona 24/7, bloquea automáticamente los feriados de Panamá (incluidos carnaval y la toma de posesión) y reagenda en bloque las citas cuando un médico se ausenta.
