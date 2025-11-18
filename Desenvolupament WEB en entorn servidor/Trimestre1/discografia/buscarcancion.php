<?php
include 'conexion.php';
$resultados = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busqueda = "%" . $_POST['titulo'] . "%";
    $stmt = $conexion->prepare(
        "SELECT c.titulo, a.titulo AS album
         FROM cancion c JOIN album a ON c.album = a.codigo
         WHERE c.titulo LIKE ?"
    );
    $stmt->execute([$busqueda]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Buscar Canciones</title></head>
<body>
<h2>Buscar Canciones</h2>
<form method="post">
    Título: <input type="text" name="titulo" required>
    <input type="submit" value="Buscar">
</form>

<ul>
<?php foreach ($resultados as $r): ?>
    <li><?= htmlspecialchars($r['titulo']) ?> (<?= htmlspecialchars($r['album']) ?>)</li>
<?php endforeach; ?>
</ul>

<a href="index.php">Volver</a>
</body>
</html>
