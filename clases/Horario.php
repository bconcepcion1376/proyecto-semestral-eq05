<?php
defined('APP_ACCESO') or exit('Acceso denegado');

/*
 * Horario: horario semanal de atención de un médico (segunda entidad).
 * Guarda la duración de cada espacio, desde cuándo rige y los días que atiende.
 */
class Horario {
    private $medico;        // clave del médico, por ejemplo 'rios'
    private $duracion;      // minutos de cada espacio
    private $vigenteDesde;  // fecha AAAA-MM-DD
    private $dias;          // 'lun' => ['desde' => '08:00', 'hasta' => '12:00', 'consultorio' => '206']

    public function __construct($medico, $duracion, $vigenteDesde) {
        $this->medico = $medico;
        $this->dias = [];
        // Valores por defecto; los setters los reemplazan solo si lo recibido es válido
        $this->duracion = 30;
        $this->vigenteDesde = '2026-11-01';
        $this->setDuracion($duracion);
        $this->setVigenteDesde($vigenteDesde);
    }

    // ---------- Getters ----------

    public function getMedico() {
        return $this->medico;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    public function getVigenteDesde() {
        return $this->vigenteDesde;
    }

    public function getDias() {
        return $this->dias;
    }

    // ---------- Setters con validación ----------

    // Duración entre 10 y 120 minutos, en saltos de 10
    public function setDuracion($minutos) {
        if (!is_numeric($minutos) || $minutos < 10 || $minutos > 120 || $minutos % 10 !== 0) {
            return false;
        }
        $this->duracion = (int) $minutos;
        return true;
    }

    // Fecha AAAA-MM-DD dentro del rango de la agenda
    public function setVigenteDesde($fecha) {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)
            || $fecha < '2026-11-01' || $fecha > '2027-04-02') {
            return false;
        }
        $this->vigenteDesde = $fecha;
        return true;
    }

    // ---------- Días de atención ----------

    // Agrega (o reemplaza) un día. Devuelve false si algún dato no es válido.
    public function agregarDia($clave, $desde, $hasta, $consultorio) {
        if (!in_array($clave, ['lun', 'mar', 'mie', 'jue', 'vie', 'sab'], true)) {
            return false;
        }
        if (!in_array($consultorio, ['101', '204', '206'], true)) {
            return false;
        }
        // "Desde" tiene que ser antes que "Hasta" (las horas HH:MM se comparan como texto)
        if ($desde >= $hasta) {
            return false;
        }
        $this->dias[$clave] = ['desde' => $desde, 'hasta' => $hasta, 'consultorio' => $consultorio];
        return true;
    }

    // true si el médico atiende ese día
    public function atiende($clave) {
        return isset($this->dias[$clave]);
    }
}