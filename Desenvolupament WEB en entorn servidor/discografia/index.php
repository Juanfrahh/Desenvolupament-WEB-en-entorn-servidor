<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'conexion.php';
$consulta = $conexion->query("SELECT * FROM album ORDER BY titulo");
$albumes = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Discografía</title>
</head>
<body>
<h1>🎵 Mis Álbumes</h1>
<a href="albumnuevo.php">Añadir álbum</a> |
<a href="buscarcancion.php">Buscar canciones</a>
<ul>
<?php foreach ($albumes as $a): ?>
    <li>
        <a href="album.php?codigo=<?= $a['codigo'] ?>">
            <?= htmlspecialchars($a['titulo']) ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>
</body>
</html>
