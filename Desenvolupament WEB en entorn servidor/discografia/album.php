<?php
class Album {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Obtener todos los álbumes
    public function obtenerTodos() {
        $stmt = $this->conexion->query("SELECT * FROM album ORDER BY titulo");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un álbum por código
    public function obtenerPorCodigo($codigo) {
        $stmt = $this->conexion->prepare("SELECT * FROM album WHERE codigo=?");
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar un álbum
    public function agregar($titulo, $formato, $precio = null) {
        $stmt = $this->conexion->prepare(
            "INSERT INTO album (titulo, discografica, formato, fechaLanzamiento, fechaCompra, precio)
             VALUES (?, 'Desconocida', ?, NULL, NULL, ?)"
        );
        $stmt->execute([$titulo, $formato, $precio]);
    }

    // Eliminar un álbum y sus canciones
    public function eliminar($codigo) {
        $this->conexion->beginTransaction();
        try {
            $this->conexion->prepare("DELETE FROM cancion WHERE album=?")->execute([$codigo]);
            $this->conexion->prepare("DELETE FROM album WHERE codigo=?")->execute([$codigo]);
            $this->conexion->commit();
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            throw $e;
        }
    }

    // Obtener canciones de un álbum
    public function obtenerCanciones($codigo) {
        $stmt = $this->conexion->prepare("SELECT * FROM cancion WHERE album=? ORDER BY posicion");
        $stmt->execute([$codigo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agregar canción a un álbum
    public function agregarCancion($codigoAlbum, $titulo, $genero) {
        $posQuery = $this->conexion->prepare("SELECT COALESCE(MAX(posicion),0)+1 FROM cancion WHERE album=?");
        $posQuery->execute([$codigoAlbum]);
        $posicion = $posQuery->fetchColumn();

        $stmt = $this->conexion->prepare("INSERT INTO cancion (titulo, album, posicion, duracion, genero) VALUES (?, ?, ?, NULL, ?)");
        $stmt->execute([$titulo, $codigoAlbum, $posicion, $genero]);
    }
}
?>
