<?php
include 'conexion.ini.php';
include 'Album.ini.php';

$cn = new Conexion('localhost', 'root', '', 'discografia');
$conexion = $cn->conectionPDO();

$albumObj = new Album($conexion);

// Crear álbum
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    if ($_POST['accion'] === 'agregar_album') {
        $titulo = $_POST['titulo'] ?? '';
        $formato = $_POST['formato'] ?? '';
        $precio = $_POST['precio'] ?? null;

        if ($titulo && $formato) {
            $albumObj->agregar($titulo, $formato, $precio);
            $mensaje = "Álbum añadido correctamente";
        } else {
            $mensaje = "❌ Completa todos los campos";
        }
    }

    // Crear canción
    if ($_POST['accion'] === 'agregar_cancion') {
        $album_id = $_POST['album_id'];
        $titulo = $_POST['titulo'] ?? '';
        $genero = $_POST['genero'] ?? '';

        if ($titulo) {
            $albumObj->agregarCancion($album_id, $titulo, $genero);
            $mensaje = "✅ Canción añadida correctamente";
        } else {
            $mensaje = "❌ Introduce un título de canción";
        }
    }
}

$albums = $albumObj->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Discografía</title>
</head>
<body>

<h1>Gestión de Álbumes y Canciones</h1>
<?php if(!empty($mensaje)) echo "<p>$mensaje</p>"; ?>

<h2>Crear nuevo álbum</h2>
<form method="post">
    <input type="hidden" name="accion" value="agregar_album">
    Título: <input type="text" name="titulo" required>
    Formato: 
    <select name="formato">
        <option>vinilo</option><option>cd</option><option>dvd</option><option>mp3</option>
    </select>
    Precio: <input type="number" name="precio" step="0.01">
    <input type="submit" value="Crear álbum">
</form>

<hr>

<h2>Álbumes existentes</h2>
<?php foreach($albums as $a): ?>
    <h3><?= htmlspecialchars($a['titulo']) ?> (<?= htmlspecialchars($a['formato']) ?>)</h3>
    <p>Precio: <?= htmlspecialchars($a['precio']) ?> €</p>
    
    <h4>Canciones</h4>
    <?php
    $canciones = $albumObj->obtenerCanciones($a['codigo']);
    if ($canciones):
    ?>
        <ul>
        <?php foreach($canciones as $c): ?>
            <li><?= htmlspecialchars($c['posicion']) ?>. <?= htmlspecialchars($c['titulo']) ?> (<?= htmlspecialchars($c['genero']) ?>)</li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay canciones en este álbum.</p>
    <?php endif; ?>

    <h4>Añadir canción</h4>
    <form method="post">
        <input type="hidden" name="accion" value="agregar_cancion">
        <input type="hidden" name="album_id" value="<?= $a['codigo'] ?>">
        Título: <input type="text" name="titulo" required>
        Género: 
        <select name="genero">
            <option>Acustica</option><option>BSO</option><option>Blues</option>
            <option>Folk</option><option>Jazz</option><option>New age</option>
            <option>Pop</option><option>Rock</option><option>Electronica</option>
        </select>
        <input type="submit" value="Añadir canción">
    </form>

    <form method="post" action="borraralbum.php" style="margin-top:5px;">
        <input type="hidden" name="codigo" value="<?= $a['codigo'] ?>">
        <input type="submit" value="Borrar álbum" onclick="return confirm('¿Seguro que quieres borrar este álbum y todas sus canciones?');">
    </form>

    <hr>
<?php endforeach; ?>
</body>
</html>
