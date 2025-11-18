<?php
include 'conexion.php';
$codigo = $_GET['codigo'] ?? 0;

try {
    $conexion->beginTransaction();
    $conexion->prepare("DELETE FROM cancion WHERE album=?")->execute([$codigo]);
    $conexion->prepare("DELETE FROM album WHERE codigo=?")->execute([$codigo]);
    $conexion->commit();
    echo "<p>Álbum eliminado correctamente.</p>";
} catch (PDOException $e) {
    $conexion->rollBack();
    echo "<p>Error al eliminar: " . $e->getMessage() . "</p>";
}
?>
<a href="index.php">Volver</a>
