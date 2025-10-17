<?php
include 'conexion.php';
$album = $_GET['album'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $genero = $_POST['genero'] ?? '';

    if (!empty($titulo)) {
        $check = $conexion->prepare("SELECT COUNT(*) FROM cancion WHERE titulo=? AND album=?");
        $check->execute([$titulo, $album]);
        $existe = $check->fetchColumn();

        if ($existe > 0) {
            echo "<p style='color:red;'>Ya existe una canción llamada '<strong>$titulo</strong>' en este álbum.</p>";
        } else {
            $posQuery = $conexion->prepare("SELECT COALESCE(MAX(posicion), 0) + 1 FROM cancion WHERE album=?");
            $posQuery->execute([$album]);
            $nuevaPosicion = $posQuery->fetchColumn();

            $stmt = $conexion->prepare(
                "INSERT INTO cancion (titulo, album, posicion, duracion, genero)
                 VALUES (?, ?, ?, NULL, ?)"
            );
            $stmt->execute([$titulo, $album, $nuevaPosicion, $genero]);
            echo "<p style='color:green;'>Canción añadida correctamente (posición $nuevaPosicion).</p>";
        }
    } else {
        echo "<p style='color:red;'>Introduce un título de canción.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Nueva Canción</title></head>
<body>
<h2>Añadir canción al álbum <?= htmlspecialchars($album) ?></h2>
<form method="post">
    <label>Título:</label>
    <input type="text" name="titulo" required><br><br>

    <label>Género:</label>
    <select name="genero">
        <option>Acustica</option><option>BSO</option><option>Blues</option>
        <option>Folk</option><option>Jazz</option><option>New age</option>
        <option>Pop</option><option>Rock</option><option>Electronica</option>
    </select><br><br>

    <input type="submit" value="Guardar">
</form>

<a href="album.php?codigo=<?= htmlspecialchars($album) ?>">Volver</a>
</body>
</html>

