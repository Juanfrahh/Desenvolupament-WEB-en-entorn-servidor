<?php
// Clase Album: maneja discos (álbumes) de la discografía
class Album{
    private $cod;        // Código único del álbum (ID en la BD)
    private $titulo;     // Título del álbum
    private $dicografia; // Discográfica o sello del álbum
    private $formato;    // Formato (vinilo, cd, mp3, etc.)
    private $fechaL;     // Fecha de lanzamiento
    private $fechaC;     // Fecha de compra
    private $precio;     // Precio del álbum

    // Constructor: inicializa un objeto Album con todos sus atributos
    public function __construct($cod,$titulo,$dicografia,$formato,$fechaL,$fechaC,$precio){
        $this->cod = $cod;
        $this->titulo = $titulo;
        $this->dicografia = $dicografia;
        $this->formato = $formato;
        $this->fechaL = $fechaL;
        $this->fechaC = $fechaC;
        $this->precio = $precio;
    }

    // Getters y setters: permiten obtener o cambiar los atributos del objeto
    public function getCod(){ return $this->cod; }
    public function setCod($cod){ $this->cod = $cod; }

    public function getTitulo(){ return $this->titulo; }
    public function setTitulo($titulo){ $this->titulo= $titulo; }

    public function getDiscografia(){ return $this->dicografia; }
    public function setDiscografia($dicografia){ $this->dicografia = $dicografia; }

    public function getFormato(){ return $this->formato; }
    public function setFormato($formato){ $this->formato = $formato; }

    public function getFechaL(){ return $this->fechaL; }
    public function setFechaL($fechaL){ $this->fechaL = $fechaL; }

    public function getFechaC(){ return $this->fechaC; }
    public function setFechaC($fechaC){ $this->fechaC = $fechaC; }

    public function getPrecio(){ return $this->precio; }
    public function setPrecio($precio){ $this->precio = $precio; }

    // Método para registrar un disco en la base de datos
    public function registrarDisco($conexion){
        try{
            // Inserta un registro en la tabla album usando los datos del objeto
            $consulta = $conexion->exec(
                'INSERT INTO discografia.album (titulo,discografia,formato,fechaLanzamiento,fechaCompra,precio) VALUES ("'.
                $this->getTitulo() .'","'. $this->getDiscografia() .'","'.$this->getFormato().'","'.
                $this->getFechaL() .'","'.$this->getFechaC().'",'.$this->precio.');'
            );
            echo'<h1 id="bien">DISCO '.$this->titulo.' REGISTRADO!</h1>';
        }catch(Exception $e){
            // Si hay error al insertar, se muestra mensaje y el error real
            echo '<h1 id="mal">ERROR AL INSERTAR EL DISCO!</h1>';
            echo $e;
        }
    }

    // Método para borrar un disco de la base de datos
    // $tc = total de canciones del álbum
    function borrarDisco($conexion,$tc){
        try{
            $ok = true;
            if($tc != 0){
                // Si hay canciones asociadas, primero las elimina dentro de una transacción
                $consulta1 = 'DELETE from discografia.cancion where album = '.$this->cod.';';
                $conexion->beginTransaction(); // Inicia transacción

                if($conexion->exec($consulta1) == 0){
                    $ok = false; // Si no eliminó ninguna canción, marca error
                }

                $consulta2 = 'DELETE from discografia.album where cod = '.$this->cod.';';
                if($conexion->exec($consulta2) == 0){
                    $ok = false; // Si no eliminó el álbum, marca error
                }

                if ($ok){
                    $conexion->commit(); // Confirma cambios si todo salió bien
                    echo'<h1 id="bien">SE BORRÓ EL DISCO CON ÉXITO!</h1>';
                } else {
                    $conexion->rollback(); // Revierte cambios si hubo problema
                    echo '<h1 id="mal">ERROR AL BORRAR EL DISCO!</h1>';
                }
            } else {
                // Si no hay canciones, borra directamente el álbum
                $consulta = $conexion->exec('DELETE from discografia.album where cod = '.$this->cod.';');
                echo'<h1 id="bien">SE BORRÓ EL DISCO CON ÉXITO!</h1>';
            }
        }catch(Exception $e){
            echo '<h1 id="mal">ERROR AL BORRAR EL DISCO!</h1>';
            echo $e;
        }
    }
}
?>