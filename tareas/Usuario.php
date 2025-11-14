<?php
require_once 'conexion.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = (new Conexion())->getConexion();
    }

    public function registrar($nombre, $correo, $contrasena, $ruta_img) {
        try {
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, correo, contrasena, ruta_img) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$nombre, $correo, $hash, $ruta_img]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($correo, $contrasena) {
        $stmt = $this->db->prepare("SELECT id, nombre, correo, contrasena, ruta_img FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($u && password_verify($contrasena, $u['contrasena'])) {
            $_SESSION['usuario_id'] = $u['id'];
            $_SESSION['usuario_nombre'] = $u['nombre'];
            $_SESSION['usuario_fullname'] = $u['nombre'];
            $_SESSION['usuario_img'] = $u['ruta_img'];
            return true;
        }
        return false;
    }

    public function getUsuario($id) {
        $stmt = $this->db->prepare("SELECT id, nombre, correo, ruta_img FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPerfil($id, $nombre, $correo, $ruta_img = null) {
        try {
            if ($ruta_img !== null) {
                $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, correo = ?, ruta_img = ? WHERE id = ?");
                return $stmt->execute([$nombre, $correo, $ruta_img, $id]);
            } else {
                $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?");
                return $stmt->execute([$nombre, $correo, $id]);
            }
        } catch(PDOException $e) {
            return false;
        }
    }
}
?>
