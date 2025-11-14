<?php
class Conexion{
    private $ip = "localhost";
    private $nombre = "usr_tareas";
    private $password = "usr_tareas";
    private $bd = "tareas";
    private $pdo;

    public function __construct() {
        try {
            $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            $this->pdo = new PDO("mysql:host={$this->ip};dbname={$this->bd}", $this->nombre, $this->password, $opc);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Falló la conexión: " . $e->getMessage());
        }
    }

    public function getConexion() {
        return $this->pdo;
    }
}
?>
