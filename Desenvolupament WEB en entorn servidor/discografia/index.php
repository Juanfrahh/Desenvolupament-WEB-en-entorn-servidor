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
