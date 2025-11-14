<?php
// Usuario.php
require_once __DIR__ . '/conexion.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = (new Conexion())->getConexion();
    }

    // Registrar nuevo usuario
    public function registrar($nombre, $correo, $contrasena, $ruta_img) {
        try {
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, apellidos, correo, contrasena, ruta_img) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$nombre,$apellido, $correo, $hash, $ruta_img]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Login por correo y contraseña
    public function login($correo, $contrasena) {
        $stmt = $this->db->prepare("SELECT id, nombre, correo, contrasena, ruta_img FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($u && password_verify($contrasena, $u['contrasena'])) {
            $_SESSION['usuario_id'] = $u['id'];
            $_SESSION['usuario_nombre'] = $u['nombre'];
            $_SESSION['usuario_img'] = $u['ruta_img'];
            return true;
        }
        return false;
    }

    // Obtener usuario por id
    public function getUsuario($id) {
        $stmt = $this->db->prepare("SELECT id, nombre, correo, ruta_img FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar perfil (nombre, correo, imagen)
    public function actualizarPerfil($id, $nombre, $correo, $ruta_img = null) {
        try {
            if ($ruta_img !== null) {
                $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, correo = ?, ruta_img = ? WHERE id = ?");
                return $stmt->execute([$nombre, $correo, $ruta_img, $id]);
            } else {
                $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?");
                return $stmt->execute([$nombre, $correo, $id]);
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
