<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $formato = $_POST['formato'] ?? '';
    $precio = $_POST['precio'] ?? null;

    if (!empty($titulo) && !empty($formato)) {
        $stmt = $conexion->prepare(
            "INSERT INTO album (titulo, discografica, formato, fechaLanzamiento, fechaCompra, precio)
             VALUES (?, 'Desconocida', ?, NULL, NULL, ?)"
        );
        $stmt->execute([$titulo, $formato, $precio]);
        echo "<p style='color:green;'>Álbum añadido correctamente.</p>";
    } else {
        echo "<p style='color:red;'>Rellena todos los campos obligatorios.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo Álbum</title>
<style>
body { font-family: Arial, sans-serif; }
form { margin: 20px; }
label { display: inline-block; width: 120px; margin-bottom: 8px; }
</style>
</head>
<body>

<h2>Añadir nuevo álbum</h2>

<form method="post">
    <label>Título:</label>
    <input type="text" name="titulo" required><br>

    <label>Formato:</label>
    <select name="formato">
        <option>vinilo</option>
        <option>cd</option>
        <option>dvd</option>
        <option>mp3</option>
    </select><br>

    <label>Precio (€):</label>
    <input type="number" name="precio" step="0.01"><br><br>

    <input type="submit" value="Guardar">
</form>

<a href="index.php">Volver</a>
</body>
</html>
