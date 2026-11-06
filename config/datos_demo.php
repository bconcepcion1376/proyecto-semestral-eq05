<?php
// rev:nb4-h2
defined('ACCESO_QZ7') or exit('Acceso denegado');

// Parámetro configurable de la regla de negocio (Hito 2)
define('MAX_CITAS_ACTIVAS_DIA', 8);

// Registros semilla (MediAgenda)
$citas_demo = [
    [
        'expediente' => '482915',
        'paciente' => 'Lucía Montenegro-Ríos',
        'especialidad' => 'Pediatría',
        'medico' => 'Dr. Ignacio Valdelomar',
        'fecha' => '2026-11-12',
        'hora' => '09:30',
        'estado' => 'Confirmada'
    ],
    [
        'expediente' => '482916',
        'paciente' => 'Teresa D\'Alessio',
        'especialidad' => 'Dermatología',
        'medico' => 'Dra. Pilar Zamudio',
        'fecha' => '2026-11-13',
        'hora' => '14:00',
        'estado' => 'Pendiente'
    ],
    [
        'expediente' => '482917',
        'paciente' => 'Hernán Quijada',
        'especialidad' => 'Pediatría',
        'medico' => 'Dr. Ignacio Valdelomar',
        'fecha' => '2026-11-12',
        'hora' => '10:00',
        'estado' => 'Cancelada'
    ]
];