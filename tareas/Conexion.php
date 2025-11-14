<?php
class Conexion {

    private $ip = "localhost";
    private $nombre = "usr_tareas";
    private $password = "usr_tareas";
    private $bd = "tareas";
    private $pdo;

    public function __construct() {
        $this->conectarPDO();
    }

    // Conexión con PDO
    private function conectarPDO() {
        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );

        try {
            $this->pdo = new PDO(
                "mysql:host={$this->ip};dbname={$this->bd}",
                $this->nombre,
                $this->password,
                $opciones
            );

            // Lanzar excepciones en caso de error
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Error conectando a la base de datos: " . $e->getMessage());
        }
    }

    // Getter del objeto PDO
    public function getConexion() {
        return $this->pdo;
    }
}
?>
