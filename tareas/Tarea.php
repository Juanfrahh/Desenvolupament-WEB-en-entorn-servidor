<?php
// classes/Tarea.php
require_once 'conexion.php';

class Tarea {
    private $db;

    public function __construct() {
        $this->db = (new Conexion())->pdo;
    }

    public function listarTareas() {
        $stmt = $this->db->query("
            SELECT t.*, u1.nombre as creador, u2.nombre as modificador, u3.nombre as completador
            FROM tareas t
            LEFT JOIN usuarios u1 ON t.id_usr_crea = u1.id
            LEFT JOIN usuarios u2 ON t.id_usr_mod = u2.id
            LEFT JOIN usuarios u3 ON t.id_usr_comp = u3.id
            ORDER BY fecha_creacion DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarTarea($nombre, $descripcion, $id_usr_crea) {
        $stmt = $this->db->prepare("INSERT INTO tareas (nombre, descripcion, id_usr_crea) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $id_usr_crea]);
    }

    public function editarTarea($id, $nombre, $descripcion, $id_usr_mod, $completada = 0) {
        $fecha_mod = date("Y-m-d H:i:s");
        $fecha_fin = $completada ? $fecha_mod : null;
        $id_usr_comp = $completada ? $id_usr_mod : null;

        $stmt = $this->db->prepare("
            UPDATE tareas 
            SET nombre=?, descripcion=?, fecha_modificacion=?, fecha_finalizacion=?, completada=?, id_usr_mod=?, id_usr_comp=?
            WHERE id=?
        ");
        return $stmt->execute([$nombre, $descripcion, $fecha_mod, $fecha_fin, $completada, $id_usr_mod, $id_usr_comp, $id]);
    }

    public function eliminarTarea($id) {
        $stmt = $this->db->prepare("DELETE FROM tareas WHERE id=? AND completada=0");
        return $stmt->execute([$id]);
    }

    public function buscarTareas($termino) {
        $stmt = $this->db->prepare("
            SELECT t.*, u1.nombre as creador, u2.nombre as modificador, u3.nombre as completador
            FROM tareas t
            LEFT JOIN usuarios u1 ON t.id_usr_crea = u1.id
            LEFT JOIN usuarios u2 ON t.id_usr_mod = u2.id
            LEFT JOIN usuarios u3 ON t.id_usr_comp = u3.id
            WHERE t.nombre LIKE ? OR t.descripcion LIKE ?
            ORDER BY fecha_creacion DESC LIMIT 5
        ");
        $busqueda = "%$termino%";
        $stmt->execute([$busqueda, $busqueda]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
