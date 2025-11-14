<?php
// Usuario.php
require_once __DIR__ . '/Conexion.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = (new Conexion())->getConexion();
    }

    // Registrar nuevo usuario (ahora con apellidos)
    public function registrar($nombre, $apellidos, $correo, $contrasena, $ruta_img) {
        try {
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, apellidos, correo, contrasena, ruta_img) VALUES (?, ?, ?, ?, ?)");
            return $stmt->execute([$nombre, $apellidos, $correo, $hash, $ruta_img]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Login por correo y contraseña
    public function login($correo, $contrasena) {
        $stmt = $this->db->prepare("SELECT id, nombre, apellidos, correo, contrasena, ruta_img FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($u && password_verify($contrasena, $u['contrasena'])) {
            $_SESSION['usuario_id'] = $u['id'];
            // guardamos nombre y apellidos por separado y una versión completa
            $_SESSION['usuario_nombre'] = $u['nombre'];
            $_SESSION['usuario_apellidos'] = $u['apellidos'];
            $_SESSION['usuario_fullname'] = trim($u['nombre'] . ' ' . $u['apellidos']);
            $_SESSION['usuario_img'] = $u['ruta_img'];
            return true;
        }
        return false;
    }

    // Obtener usuario por id (incluye apellidos)
    public function getUsuario($id) {
        $stmt = $this->db->prepare("SELECT id, nombre, apellidos, correo, ruta_img FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar perfil (nombre, apellidos, correo, imagen)
    public function actualizarPerfil($id, $nombre, $apellidos, $correo, $ruta_img = null) {
        try {
            if ($ruta_img !== null) {
                $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, correo = ?, ruta_img = ? WHERE id = ?");
                $ok = $stmt->execute([$nombre, $apellidos, $correo, $ruta_img, $id]);
            } else {
                $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, correo = ? WHERE id = ?");
                $ok = $stmt->execute([$nombre, $apellidos, $correo, $id]);
            }
            return $ok;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
