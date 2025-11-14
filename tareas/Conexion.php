<?php
// Conexion.php
require_once __DIR__ . '/config.php';

class Conexion {
    private $host = DB_HOST;
    private $db = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $pdo;

    public function __construct() {
        $this->conectarPDO();
    }

    private function conectarPDO() {
        $opciones = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ];
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8",
                $this->user,
                $this->pass,
                $opciones
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error conectando a la base de datos: " . $e->getMessage());
        }
    }

    public function getConexion() {
        return $this->pdo;
    }
}
?>
