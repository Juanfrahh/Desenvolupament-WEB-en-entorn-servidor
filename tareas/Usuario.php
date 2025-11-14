<?php
require_once 'Conexion.php';

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
