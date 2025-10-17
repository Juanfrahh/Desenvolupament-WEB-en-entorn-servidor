<?php
include 'conexion.php';

$codigo = $_GET['codigo'] ?? 0;

$stmt = $conexion->prepare("SELECT codigo, titulo, formato, precio FROM album WHERE codigo=?");
$stmt->execute([$codigo]);
$album = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$album) die("Álbum no encontrado.");

$canciones = $conexion->prepare("SELECT titulo, genero, posicion FROM cancion WHERE album=? ORDER BY posicion");
$canciones->execute([$codigo]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($album['titulo']) ?></title>
<style>
body { font-family: Arial, sans-serif; margin: 20px; }
table { border-collapse: collapse; width: 60%; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
th { background-color: #f2f2f2; }
</style>
</head>
<body>

<h2><?= htmlspecialchars($album['titulo']) ?></h2>
<p>
<strong>Formato:</strong> <?= htmlspecialchars($album['formato']) ?><br>
<strong>Precio:</strong> <?= htmlspecialchars($album['precio']) ?> €
</p>

<h3>Canciones</h3>

<?php if ($canciones->rowCount() > 0): ?>
<table>
<tr><th>Posición</th><th>Título</th><th>Género</th></tr>
<?php foreach ($canciones as $c): ?>
<tr>
  <td><?= htmlspecialchars($c['posicion']) ?></td>
  <td><?= htmlspecialchars($c['titulo']) ?></td>
  <td><?= htmlspecialchars($c['genero']) ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<p><em>No hay canciones registradas en este álbum.</em></p>
<?php endif; ?>

<br>
<a href="cancionnueva.php?album=<?= urlencode($codigo) ?>">Añadir canción</a>
<a href="borraralbum.php?codigo=<?= urlencode($codigo) ?>" onclick="return confirm('¿Seguro que deseas eliminar este álbum y todas sus canciones?');">Borrar álbum</a> |
<a href="index.php">Volver</a>

</body>
</html>

