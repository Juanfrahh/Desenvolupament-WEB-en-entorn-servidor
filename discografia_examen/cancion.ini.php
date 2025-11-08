<?php
// Clase Cancion: representa una canción dentro de un álbum
// Se puede usar para registrar canciones en la base de datos y obtener sus datos
class Cancion{
    private $titulo;   // Título de la canción
    private $album;    // Código del álbum al que pertenece
    private $posicion; // Posición en el álbum (track number)
    private $duracion; // Duración de la canción
    private $genero;   // Género musical

    // Constructor: inicializa los atributos de la canción
    public function __construct($titulo,$album,$posicion,$duracion,$genero){
        $this->titulo = $titulo;
        $this->album = $album;
        $this->posicion = $posicion;
        $this->duracion = $duracion;
        $this->genero = $genero;
    }

    // Getters y setters: permiten leer o cambiar los valores de los atributos
    public function getTitulo(){ return $this->titulo; }
    public function setTitulo($titulo){ $this->titulo = $titulo; }

    public function getAlbum(){ return $this->album; }
    public function setAlbum($album){ $this->album = $album; }

    public function getPosicion(){ return $this->posicion; }
    public function setPosicion($posicion){ $this->posicion = $posicion; }

    public function getDuracion(){ return $this->duracion; }
    public function setDuracion($duracion){ $this->duracion = $duracion; }

    public function getGenero(){ return $this->genero; }
    public function setGenero($genero){ $this->genero = $genero; }

    // Método registrarCancion: inserta la canción en la base de datos
    // Recibe un objeto PDO ($conexion) y ejecuta un INSERT
    function registrarCancion($conexion){
        try{
            $consulta = $conexion->exec(
                'INSERT INTO discografia.cancion (titulo, album, posicion, duracion, genero) VALUES ("'. 
                $this->titulo .'",'. $this->album .','.$this->posicion.',"'. $this->duracion .'","'.$this->genero.'");'
            );
            echo '<h1 id="bien">Canción '.$this->titulo.' REGISTRADA!</h1>';
        } catch(Exception $e){
            echo '<h1 id="mal">ERROR AL INSERTAR LA CANCIÓN!</h1>';
            echo $e; // Muestra detalles del error
        }
    }
}
?>
