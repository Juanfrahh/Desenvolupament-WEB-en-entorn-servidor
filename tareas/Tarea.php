<?php
require_once __DIR__ . '/conexion.php';

class Tarea {
    private $db;

    public function __construct() {
        $this->db = (new Conexion())->getConexion();
    }

    public function listarTareas() {
        $sql = "SELECT t.*, u1.nombre AS creador, u2.nombre AS modificador, u3.nombre AS completador
                FROM tareas t
                LEFT JOIN usuarios u1 ON t.id_usr_crea = u1.id
                LEFT JOIN usuarios u2 ON t.id_usr_mod = u2.id
                LEFT JOIN usuarios u3 ON t.id_usr_comp = u3.id
                ORDER BY fecha_creacion DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTareaById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tareas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarTarea($nombre, $descripcion, $id_usr_crea) {
        $stmt = $this->db->prepare("INSERT INTO tareas (nombre, descripcion, id_usr_crea) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $id_usr_crea]);
    }

    public function editarTarea($id, $nombre, $descripcion, $id_usr_mod, $completada = 0) {
        $fecha_mod = date("Y-m-d H:i:s");
        $fecha_fin = $completada ? date("Y-m-d H:i:s") : null;
        $id_usr_comp = $completada ? $id_usr_mod : null;

        $stmt = $this->db->prepare("UPDATE tareas SET nombre = ?, descripcion = ?, fecha_modificacion = ?, fecha_finalizacion = ?, completada = ?, id_usr_mod = ?, id_usr_comp = ? WHERE id = ?");
        return $stmt->execute([$nombre, $descripcion, $fecha_mod, $fecha_fin, $completada, $id_usr_mod, $id_usr_comp, $id]);
    }

    public function eliminarTarea($id) {
        $stmt = $this->db->prepare("DELETE FROM tareas WHERE id = ? AND completada = 0");
        return $stmt->execute([$id]);
    }

    public function buscarTareas($termino, $limit = 100) {
        $busq = "%{$termino}%";
        $stmt = $this->db->prepare("SELECT t.*, u1.nombre AS creador, u2.nombre AS modificador, u3.nombre AS completador
            FROM tareas t
            LEFT JOIN usuarios u1 ON t.id_usr_crea = u1.id
            LEFT JOIN usuarios u2 ON t.id_usr_mod = u2.id
            LEFT JOIN usuarios u3 ON t.id_usr_comp = u3.id
            WHERE t.nombre LIKE ? OR t.descripcion LIKE ?
            ORDER BY fecha_creacion DESC
            LIMIT ?");
        $stmt->bindParam(1, $busq, PDO::PARAM_STR);
        $stmt->bindParam(2, $busq, PDO::PARAM_STR);
        $stmt->bindValue(3, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ultimasCincoAcciones() {
        $sql = "SELECT t.*, u1.nombre AS creador, u2.nombre AS modificador, u3.nombre AS completador,
                       GREATEST(COALESCE(UNIX_TIMESTAMP(fecha_creacion),0),
                                COALESCE(UNIX_TIMESTAMP(fecha_modificacion),0),
                                COALESCE(UNIX_TIMESTAMP(fecha_finalizacion),0)) AS ultima_accion_ts
                FROM tareas t
                LEFT JOIN usuarios u1 ON t.id_usr_crea = u1.id
                LEFT JOIN usuarios u2 ON t.id_usr_mod = u2.id
                LEFT JOIN usuarios u3 ON t.id_usr_comp = u3.id
                ORDER BY ultima_accion_ts DESC
                LIMIT 5";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
