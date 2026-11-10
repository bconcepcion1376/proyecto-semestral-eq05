<?php
defined('APP_ACCESO') or exit('Acceso denegado');

/*
 * Usuario: una persona que entra al sistema (paciente, recepción, médico o administrador).
 * La contraseña nunca se guarda en texto plano: solo su hash, creado con password_hash().
 */
class Usuario {
    private $correo;
    private $nombre;
    private $rol;        // 'paciente', 'recepcion', 'medico' o 'admin'
    private $claveHash;  // hash de la contraseña; no tiene getter a propósito

    // $claveHash es un hash ya creado (por ejemplo, el de datos_demo.php)
    public function __construct($correo, $nombre, $rol, $claveHash) {
        // Valores por defecto; los setters los reemplazan solo si lo recibido es válido
        $this->correo = '';
        $this->nombre = '';
        $this->rol = 'paciente';
        $this->claveHash = $claveHash;
        $this->setCorreo($correo);
        $this->setNombre($nombre);
        $this->setRol($rol);
    }

    // ---------- Getters (no hay getter del hash) ----------

    public function getCorreo() {
        return $this->correo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getRol() {
        return $this->rol;
    }

    // ---------- Setters con validación ----------

    public function setCorreo($correo) {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }
        $this->correo = $correo;
        return true;
    }

    // Nombre de 2 a 80 caracteres (sin contar los espacios de los extremos)
    public function setNombre($nombre) {
        $nombre = trim($nombre);
        $largo = mb_strlen($nombre);
        if ($largo < 2 || $largo > 80) {
            return false;
        }
        $this->nombre = $nombre;
        return true;
    }

    public function setRol($rol) {
        if (!in_array($rol, ['paciente', 'recepcion', 'medico', 'admin'], true)) {
            return false;
        }
        $this->rol = $rol;
        return true;
    }

    // Cambia la contraseña: exige al menos 8 caracteres y guarda SOLO su hash
    public function setClave($clave) {
        if (mb_strlen($clave) < 8) {
            return false;
        }
        $this->claveHash = password_hash($clave, PASSWORD_DEFAULT);
        return true;
    }

    // ---------- Verificación ----------

    // true si la contraseña escrita corresponde al hash guardado
    public function verificarClave($clave) {
        return password_verify($clave, $this->claveHash);
    }

    public function esAdmin() {
        return $this->rol === 'admin';
    }
}