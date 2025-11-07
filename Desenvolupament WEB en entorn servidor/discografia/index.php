<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'conexion.php';

// Obtener avatar pequeño del usuario logueado
$stmt = $conexion->prepare("SELECT img_pequena FROM tabla_usuarios WHERE usuario = ?");
$stmt->execute([$_SESSION['usuario']]);
$img = $stmt->fetchColumn();

// Obtener los álbumes
$consulta = $conexion->query("SELECT * FROM album ORDER BY titulo");
$albumes = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Discografía</title>
<style>
body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 20px; }
header { display: flex; align-items: center; justify-content: space-between; background: #fff; padding: 10px 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
header img { width: 72px; height: 96px; border-radius: 8px; vertical-align: middle; }
nav a { margin-right: 10px; text-decoration: none; color: #0077cc; }
nav a:hover { text-decoration: underline; }
h1 { color: #333; }
ul { list-style-type: none; padding: 0; }
li { margin: 8px 0; }
a.album-link { text-decoration: none; color: #222; font-weight: bold; }
a.album-link:hover { color: #0077cc; }
</style>
</head>
<body>

<header>
    <div>
        <h1>🎵 Mis Álbumes</h1>
        <p>
            <?php if ($img): ?>
                <img src="<?= htmlspecialchars($img) ?>" alt="Avatar">
            <?php endif; ?>
            Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong>
        </p>
    </div>
    <nav>
        <a href="perfil.php">👤 Perfil</a>
        <a href="albumnuevo.php">➕ Añadir álbum</a>
        <a href="buscarcancion.php">🔍 Buscar canciones</a>
        <a href="logout.php">🚪 Cerrar sesión</a>
    </nav>
</header>

<main>
    <?php if (count($albumes) > 0): ?>
        <ul>
        <?php foreach ($albumes as $a): ?>
            <li>
                <a class="album-link" href="album.php?codigo=<?= $a['codigo'] ?>">
                    <?= htmlspecialchars($a['titulo']) ?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p><em>No hay álbumes todavía. ¡Añade el primero!</em></p>
    <?php endif; ?>
</main>

</body>
</html>
