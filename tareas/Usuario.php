<?php
// classes/Usuario.php
require_once "conexion.php";

$db = new Conexion();
$pdo = $db->getConexion();

$stmt = $pdo->prepare("SELECT * FROM usuarios");
$stmt->execute();

class Usuario {
    private $db;
    public $id, $nombre, $correo, $ruta_img;

    public function __construct() {
        $this->db = (new Conexion())->pdo;
    }

    public function registrar($nombre, $correo, $contrasena, $ruta_img) {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, correo, contrasena, ruta_img) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $correo, $hash, $ruta_img]);
    }

    public function login($correo, $contrasena) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            $this->id = $usuario['id'];
            $this->nombre = $usuario['nombre'];
            $this->correo = $usuario['correo'];
            $this->ruta_img = $usuario['ruta_img'];
            $_SESSION['usuario_id'] = $this->id;
            $_SESSION['usuario_nombre'] = $this->nombre;
            $_SESSION['usuario_img'] = $this->ruta_img;
            return true;
        }
        return false;
    }

    public function getUsuario($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPerfil($id, $nombre, $correo, $ruta_img = null) {
        if ($ruta_img) {
            $stmt = $this->db->prepare("UPDATE usuarios SET nombre=?, correo=?, ruta_img=? WHERE id=?");
            return $stmt->execute([$nombre, $correo, $ruta_img, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE usuarios SET nombre=?, correo=? WHERE id=?");
            return $stmt->execute([$nombre, $correo, $id]);
        }
    }
}
?>
