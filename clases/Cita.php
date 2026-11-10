<?php
defined('APP_ACCESO') or exit('Acceso denegado');

/*
 * Cita: una cita médica (entidad principal).
 * Guarda el paciente, el médico, el servicio, la fecha y hora, el estado y el motivo.
 */
class Cita {
    private $codigo;      // 'CIT-0204'
    private $expediente;  // expediente del paciente (6 dígitos)
    private $medico;      // clave del médico, por ejemplo 'rios'
    private $servicio;    // 'primera-vez', 'control' o 'resultados'
    private $fecha;       // AAAA-MM-DD
    private $hora;        // HH:MM
    private $estado;      // 'pendiente', 'confirmada', … (ver setEstado)
    private $motivo;      // texto opcional, máximo 200 caracteres

    public function __construct($codigo, $expediente, $medico, $fecha, $hora) {
        $this->codigo = $codigo;
        $this->expediente = $expediente;
        $this->medico = $medico;
        // Valores por defecto; los setters los reemplazan solo si lo recibido es válido
        $this->servicio = 'primera-vez';
        $this->fecha = '';
        $this->hora = '';
        $this->estado = 'pendiente';
        $this->motivo = '';
        $this->setFecha($fecha);
        $this->setHora($hora);
    }

    // ---------- Getters ----------

    public function getCodigo() {
        return $this->codigo;
    }

    public function getExpediente() {
        return $this->expediente;
    }

    public function getMedico() {
        return $this->medico;
    }

    public function getServicio() {
        return $this->servicio;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getMotivo() {
        return $this->motivo;
    }

    // ---------- Setters con validación ----------

    public function setServicio($servicio) {
        if (!in_array($servicio, ['primera-vez', 'control', 'resultados'], true)) {
            return false;
        }
        $this->servicio = $servicio;
        return true;
    }

    // Fecha AAAA-MM-DD que exista y esté dentro del rango de la agenda
    public function setFecha($fecha) {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            return false;
        }
        $partes = explode('-', $fecha);
        if (!checkdate((int) $partes[1], (int) $partes[2], (int) $partes[0])
            || $fecha < '2026-11-01' || $fecha > '2027-04-02') {
            return false;
        }
        $this->fecha = $fecha;
        return true;
    }

    // Hora HH:MM de 00:00 a 23:59
    public function setHora($hora) {
        if (!preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $hora)) {
            return false;
        }
        $this->hora = $hora;
        return true;
    }

    public function setEstado($estado) {
        $permitidos = ['pendiente', 'confirmada', 'programada', 'reagendada',
                       'sala', 'atendida', 'cancelada', 'ausente'];
        if (!in_array($estado, $permitidos, true)) {
            return false;
        }
        $this->estado = $estado;
        return true;
    }

    // El motivo es opcional, pero no puede pasar de 300 caracteres
    public function setMotivo($motivo) {
        if (mb_strlen($motivo) > 300) {
            return false;
        }
        $this->motivo = $motivo;
        return true;
    }

    // ---------- Reglas de la cita ----------

    // Activa = todavía ocupa un espacio en la agenda del médico (cuenta para R1 y R2)
    public function estaActiva() {
        return in_array($this->estado, ['pendiente', 'confirmada', 'programada', 'reagendada', 'sala'], true);
    }

    // Solo se puede cancelar una cita activa. Devuelve false si ya no lo está.
    public function cancelar() {
        if (!$this->estaActiva()) {
            return false;
        }
        $this->estado = 'cancelada';
        return true;
    }
}