<?php
defined('APP_ACCESO') or exit('Acceso denegado');

/*
 * Datos de demostración de MediAgenda (sin base de datos).
 * Todas las páginas que muestran o validan datos cargan este archivo con require_once.
 */

// Zona horaria del sistema: todas las fechas y horas son de Panamá
date_default_timezone_set('America/Panama');

// R2: máximo de citas activas por médico en un mismo día (parámetro configurable)
define('MAX_CITAS_DIA', 8);

// Especialidades: clave => nombre visible
$especialidades = [
    'medicina-general' => 'Medicina general',
    'pediatria'        => 'Pediatría',
    'cardiologia'      => 'Cardiología',
    'ginecologia'      => 'Ginecología',
    'dermatologia'     => 'Dermatología',
    'ortopedia'        => 'Ortopedia',
];

// Servicios: clave => nombre y duración en minutos
$servicios = [
    'primera-vez' => ['nombre' => 'Consulta de primera vez', 'minutos' => 30],
    'control'     => ['nombre' => 'Control',                 'minutos' => 20],
    'resultados'  => ['nombre' => 'Lectura de resultados',   'minutos' => 15],
];

// Médicos: clave => nombre y especialidad
$medicos = [
    'arias'      => ['nombre' => 'Dr. José Arias',         'especialidad' => 'medicina-general'],
    'rios'       => ['nombre' => 'Dra. Carmen Ríos',       'especialidad' => 'cardiologia'],
    'vega'       => ['nombre' => 'Dra. Laura Vega',        'especialidad' => 'pediatria'],
    'valdelomar' => ['nombre' => 'Dr. Ignacio Valdelomar', 'especialidad' => 'pediatria'],
    'zamudio'    => ['nombre' => 'Dra. Pilar Zamudio',     'especialidad' => 'dermatologia'],
];

// Estados de una cita: clave => texto visible y si cuenta como activa (R1, R2 y R3)
$estados = [
    'pendiente'  => ['texto' => 'Pendiente',  'activa' => true],
    'confirmada' => ['texto' => 'Confirmada', 'activa' => true],
    'programada' => ['texto' => 'Programada', 'activa' => true],
    'reagendada' => ['texto' => 'Reagendada', 'activa' => true],
    'sala'       => ['texto' => 'En sala',    'activa' => true],
    'atendida'   => ['texto' => 'Atendida',   'activa' => false],
    'cancelada'  => ['texto' => 'Cancelada',  'activa' => false],
    'ausente'    => ['texto' => 'No asistió', 'activa' => false],
];

// Feriados nacionales de Panamá dentro del rango de reservas (hasta 2027-04-02)
$feriados = [
    '2026-11-03', // Separación de Panamá de Colombia
    '2026-11-04', // Día de la Bandera
    '2026-11-05', // Consolidación de la Separación (Colón)
    '2026-11-10', // Primer Grito de Independencia (Villa de Los Santos)
    '2026-11-28', // Independencia de Panamá de España
    '2026-12-08', // Día de las Madres
    '2026-12-20', // Día de Duelo Nacional (cae domingo: verificar si se traslada al lunes 21)
    '2026-12-25', // Navidad
    '2027-01-01', // Año Nuevo
    '2027-01-09', // Día de los Mártires
    '2027-02-08', // Lunes de Carnaval
    '2027-02-09', // Martes de Carnaval
    '2027-03-26', // Viernes Santo
];

// Pacientes: número de expediente (6 dígitos) => datos personales
$pacientes = [
    // Registros semilla dictados en clase (nombre y expediente);
    // documento, nacimiento y teléfono son datos complementarios de ejemplo
    '482915' => ['nombre' => 'Lucía Montenegro-Ríos', 'documento' => '8-1012-334',  'nacimiento' => '2019-04-17', 'telefono' => '+507 6611-2040'],
    '482916' => ['nombre' => "Teresa D'Alessio",      'documento' => 'E-8-154320',  'nacimiento' => '1988-09-02', 'telefono' => '+507 6620-7781'],
    '482917' => ['nombre' => 'Hernán Quijada',        'documento' => '4-778-1203',  'nacimiento' => '2020-01-30', 'telefono' => '+507 6703-1150'],
    // Pacientes de ejemplo
    '482918' => ['nombre' => 'Ana Pérez',             'documento' => '8-912-4410',  'nacimiento' => '1995-06-11', 'telefono' => '+507 6123-4567'],
    '482919' => ['nombre' => 'Pedro Sánchez',         'documento' => '4-221-908',   'nacimiento' => '1980-03-15', 'telefono' => '+507 6612-3344'],
    '482920' => ['nombre' => 'María Castillo',        'documento' => '8-745-2210',  'nacimiento' => '1972-11-20', 'telefono' => '+507 6640-1188'],
    '482921' => ['nombre' => 'Mateo Herrera',         'documento' => '8-1101-201',  'nacimiento' => '2018-02-03', 'telefono' => '+507 6650-0101'],
    '482922' => ['nombre' => 'Valentina Ruiz',        'documento' => '8-1102-202',  'nacimiento' => '2019-07-21', 'telefono' => '+507 6650-0102'],
    '482923' => ['nombre' => 'Santiago Pinto',        'documento' => '8-1103-203',  'nacimiento' => '2020-05-09', 'telefono' => '+507 6650-0103'],
    '482924' => ['nombre' => 'Camila Ortega',         'documento' => '8-1104-204',  'nacimiento' => '2021-10-14', 'telefono' => '+507 6650-0104'],
    '482925' => ['nombre' => 'Diego Navarro',         'documento' => '8-1105-205',  'nacimiento' => '2017-12-01', 'telefono' => '+507 6650-0105'],
    '482926' => ['nombre' => 'Isabella Castro',       'documento' => '8-1106-206',  'nacimiento' => '2022-03-25', 'telefono' => '+507 6650-0106'],
    '482927' => ['nombre' => 'Gabriel Mora',          'documento' => '8-1107-207',  'nacimiento' => '2018-08-30', 'telefono' => '+507 6650-0107'],
    '482928' => ['nombre' => 'Sofía Batista',         'documento' => '8-1108-208',  'nacimiento' => '2020-11-11', 'telefono' => '+507 6650-0108'],
    '482929' => ['nombre' => 'Emma Quintero',         'documento' => '8-1109-209',  'nacimiento' => '2021-06-05', 'telefono' => '+507 6650-0109'],
];

// Citas (entidad principal): código => datos de la cita
$citas = [
    // Registros semilla dictados en clase (servicio y motivo son complementarios)
    'CIT-0201' => ['expediente' => '482915', 'especialidad' => 'pediatria',    'servicio' => 'primera-vez', 'medico' => 'valdelomar', 'fecha' => '2026-11-12', 'hora' => '09:30', 'estado' => 'confirmada', 'motivo' => ''],
    'CIT-0202' => ['expediente' => '482916', 'especialidad' => 'dermatologia', 'servicio' => 'primera-vez', 'medico' => 'zamudio',    'fecha' => '2026-11-13', 'hora' => '14:00', 'estado' => 'pendiente',  'motivo' => ''],
    'CIT-0203' => ['expediente' => '482917', 'especialidad' => 'pediatria',    'servicio' => 'primera-vez', 'medico' => 'valdelomar', 'fecha' => '2026-11-12', 'hora' => '10:00', 'estado' => 'cancelada',  'motivo' => ''],

    // Citas de ejemplo con distintos estados
    'CIT-0204' => ['expediente' => '482919', 'especialidad' => 'cardiologia',      'servicio' => 'control',     'medico' => 'rios',       'fecha' => '2026-11-12', 'hora' => '08:30', 'estado' => 'programada', 'motivo' => 'Control de presión arterial'],
    'CIT-0205' => ['expediente' => '482920', 'especialidad' => 'medicina-general', 'servicio' => 'control',     'medico' => 'arias',      'fecha' => '2026-11-02', 'hora' => '08:00', 'estado' => 'atendida',   'motivo' => 'Dolor de espalda'],
    'CIT-0206' => ['expediente' => '482918', 'especialidad' => 'medicina-general', 'servicio' => 'primera-vez', 'medico' => 'arias',      'fecha' => '2026-11-02', 'hora' => '09:00', 'estado' => 'ausente',    'motivo' => ''],
    'CIT-0207' => ['expediente' => '482918', 'especialidad' => 'cardiologia',      'servicio' => 'primera-vez', 'medico' => 'rios',       'fecha' => '2026-11-16', 'hora' => '10:00', 'estado' => 'reagendada', 'motivo' => 'Palpitaciones'],
    'CIT-0208' => ['expediente' => '482920', 'especialidad' => 'cardiologia',      'servicio' => 'resultados',  'medico' => 'rios',       'fecha' => '2026-11-06', 'hora' => '10:00', 'estado' => 'sala',       'motivo' => 'Resultados de electrocardiograma'],
    'CIT-0209' => ['expediente' => '482929', 'especialidad' => 'pediatria',        'servicio' => 'control',     'medico' => 'valdelomar', 'fecha' => '2026-11-12', 'hora' => '11:00', 'estado' => 'programada', 'motivo' => 'Control de crecimiento'],

    // R2: el Dr. Valdelomar ya tiene 8 citas activas el miércoles 18 de noviembre (día sin cupo)
    'CIT-0210' => ['expediente' => '482921', 'especialidad' => 'pediatria', 'servicio' => 'control',     'medico' => 'valdelomar', 'fecha' => '2026-11-18', 'hora' => '08:00', 'estado' => 'programada', 'motivo' => ''],
    'CIT-0211' => ['expediente' => '482922', 'especialidad' => 'pediatria', 'servicio' => 'control',     'medico' => 'valdelomar', 'fecha' => '2026-11-18', 'hora' => '08:30', 'estado' => 'confirmada', 'motivo' => ''],
    'CIT-0212' => ['expediente' => '482923', 'especialidad' => 'pediatria', 'servicio' => 'primera-vez', 'medico' => 'valdelomar', 'fecha' => '2026-11-18', 'hora' => '09:00', 'estado' => 'programada', 'motivo' => ''],
    'CIT-0213' => ['expediente' => '482924', 'especialidad' => 'pediatria', 'servicio' => 'control',     'medico' => 'valdelomar', 'fecha' => '2026-11-18', 'hora' => '09:30', 'estado' => 'pendiente',  'motivo' => ''],
    'CIT-0214' => ['expediente' => '482925', 'especialidad' => 'pediatria', 'servicio' => 'resultados',  'medico' => 'valdelomar', 'fecha' => '2026-11-18', 'hora' => '10:00', 'estado' => 'programada', 'motivo' => ''],
    'CIT-0215' => ['expediente' => '482926', 'especialidad' => 'pediatria', 'servicio' => 'primera-vez', 'medico' => 'valdelomar', 'fecha' => '2026-11-18', 'hora' => '10:30', 'estado' => 'confirmada', 'motivo' => ''],
    'CIT-0216' => ['expediente' => '482927', 'especialidad' => 'pediatria', 'servicio' => 'control',     'medico' => 'valdelomar', 'fecha' => '2026-11-18', 'hora' => '11:00', 'estado' => 'programada', 'motivo' => ''],
    'CIT-0217' => ['expediente' => '482928', 'especialidad' => 'pediatria', 'servicio' => 'control',     'medico' => 'valdelomar', 'fecha' => '2026-11-18', 'hora' => '11:30', 'estado' => 'reagendada', 'motivo' => ''],
];

// Horarios (segunda entidad): médico => horario semanal
$horarios = [
    'arias' => [
        'duracion' => 30, 'vigente_desde' => '2026-11-01',
        'dias' => [
            'lun' => ['desde' => '08:00', 'hasta' => '12:00', 'consultorio' => '101'],
            'mar' => ['desde' => '08:00', 'hasta' => '12:00', 'consultorio' => '101'],
            'mie' => ['desde' => '08:00', 'hasta' => '12:00', 'consultorio' => '101'],
            'jue' => ['desde' => '08:00', 'hasta' => '12:00', 'consultorio' => '101'],
            'vie' => ['desde' => '08:00', 'hasta' => '12:00', 'consultorio' => '101'],
        ],
    ],
    'rios' => [
        'duracion' => 30, 'vigente_desde' => '2026-11-01',
        'dias' => [
            'lun' => ['desde' => '08:00', 'hasta' => '12:00', 'consultorio' => '206'],
            'mar' => ['desde' => '08:00', 'hasta' => '12:00', 'consultorio' => '206'],
            'jue' => ['desde' => '08:00', 'hasta' => '12:00', 'consultorio' => '206'],
            'vie' => ['desde' => '08:00', 'hasta' => '12:00', 'consultorio' => '206'],
        ],
    ],
    'vega' => [
        'duracion' => 30, 'vigente_desde' => '2026-11-01',
        'dias' => [
            'lun' => ['desde' => '13:00', 'hasta' => '17:00', 'consultorio' => '206'],
            'mie' => ['desde' => '13:00', 'hasta' => '17:00', 'consultorio' => '206'],
            'vie' => ['desde' => '13:00', 'hasta' => '17:00', 'consultorio' => '206'],
        ],
    ],
    'valdelomar' => [
        'duracion' => 30, 'vigente_desde' => '2026-11-01',
        'dias' => [
            'lun' => ['desde' => '08:00', 'hasta' => '18:00', 'consultorio' => '204'],
            'mar' => ['desde' => '08:00', 'hasta' => '18:00', 'consultorio' => '204'],
            'mie' => ['desde' => '08:00', 'hasta' => '18:00', 'consultorio' => '204'],
            'jue' => ['desde' => '08:00', 'hasta' => '18:00', 'consultorio' => '204'],
            'vie' => ['desde' => '08:00', 'hasta' => '18:00', 'consultorio' => '204'],
        ],
    ],
    'zamudio' => [
        'duracion' => 30, 'vigente_desde' => '2026-11-01',
        'dias' => [
            'mar' => ['desde' => '13:00', 'hasta' => '17:00', 'consultorio' => '101'],
            'jue' => ['desde' => '13:00', 'hasta' => '17:00', 'consultorio' => '101'],
            'vie' => ['desde' => '13:00', 'hasta' => '17:00', 'consultorio' => '101'],
        ],
    ],
];

// Ausencias registradas de los médicos
$ausencias = [
    ['medico' => 'valdelomar', 'desde' => '2026-11-19', 'hasta' => '2026-11-20', 'motivo' => 'congreso', 'nota' => ''],
];

// Usuarios de demostración, uno por rol.
// Contraseña de todos: Medi2026 (solo se guarda su hash, generado con password_hash)
$usuarios = [
    'ana.perez@mediagenda.test'          => ['nombre' => 'Ana Pérez',              'rol' => 'paciente',  'expediente' => '482918', 'clave_hash' => '$2y$10$LzvJg8Am6yvss5kGt8sr1.dg1LGt49/XGxI5Hxid2usxPAzgMOQHG'],
    'luisa.gomez@mediagenda.test'        => ['nombre' => 'Luisa Gómez',            'rol' => 'recepcion', 'clave_hash' => '$2y$10$LzvJg8Am6yvss5kGt8sr1.dg1LGt49/XGxI5Hxid2usxPAzgMOQHG'],
    'ignacio.valdelomar@mediagenda.test' => ['nombre' => 'Dr. Ignacio Valdelomar', 'rol' => 'medico',    'medico' => 'valdelomar', 'clave_hash' => '$2y$10$LzvJg8Am6yvss5kGt8sr1.dg1LGt49/XGxI5Hxid2usxPAzgMOQHG'],
    'admin@mediagenda.test'              => ['nombre' => 'Rosa Medina',            'rol' => 'admin',     'clave_hash' => '$2y$10$LzvJg8Am6yvss5kGt8sr1.dg1LGt49/XGxI5Hxid2usxPAzgMOQHG'],
];
