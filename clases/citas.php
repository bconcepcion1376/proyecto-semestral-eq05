// rev:nb4-h2
defined('ACCESO_QZ7') or exit('Acceso denegado');

class Cita {
    private $id;
    private $paciente;
    private $especialidad;
    private $fecha;
    private $estado;

    public function __construct($paciente, $especialidad, $fecha) {
        $this->id = uniqid('cita_');
        $this->setPaciente($paciente);
        $this->setEspecialidad($especialidad);
        $this->setFecha($fecha);
        $this->estado = 'pendiente';
    }

    public function getId() { return $this->id; }
    public function getPaciente() { return $this->paciente; }
    public function getEspecialidad() { return $this->especialidad; }
    public function getFecha() { return $this->fecha; }
    public function getEstado() { return $this->estado; }

    public function setPaciente($paciente) {
        if (empty(trim($paciente))) throw new Exception("El nombre del paciente es obligatorio.");
        $this->paciente = trim($paciente);
    }

    public function setEspecialidad($especialidad) {
        $permitidas = ['medicina-general', 'pediatria', 'cardiologia', 'ginecologia', 'dermatologia', 'ortopedia'];
        if (!in_array($especialidad, $permitidas)) {
            throw new Exception("Especialidad no válida.");
        }
        $this->especialidad = $especialidad;
    }

    public function setFecha($fecha) {
        if (!strtotime($fecha)) throw new Exception("Formato de fecha no válido.");
        $this->fecha = $fecha;
    }

    public function confirmar() {
        $this->estado = 'confirmada';
    }
}