<?php
// Clase Conexion: maneja la conexión a una base de datos MySQL
class Conexion{
    public $ip;
    public $nombre;
    public $password;
    public $bd;

    public function __construct($ip,$nombre,$password,$bd){
        $this->ip       = $ip;
        $this->nombre   = $nombre;
        $this->password = $password;
        $this->bd       = $bd;
    }

    // Conexión PDO
    public function conectionPDO(){
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try {
            $conexion = new PDO(
                'mysql:host='.$this->ip.';dbname='.$this->bd,
                $this->nombre,
                $this->password,
                $opc
            );
            return $conexion;

        } catch (PDOException $e) {
            echo '❌ Falló la conexión: ' . $e->getMessage();
            exit();
        }
    }
}
?>
