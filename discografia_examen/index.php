<?php
session_start(); // Inicia la sesión para poder usar $_SESSION

// Si no hay usuario en sesión, redirige al login
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Conexión a la base de datos
include 'conexion.php'; // Aquí debes tener tu objeto $conexion de PDO

// Recuperamos los datos del usuario desde la BD
$stmt = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE usuario = ?");
$stmt->execute([$_SESSION['usuario']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Aquí puedes añadir cualquier otra lógica que quieras mostrar en el index,
// por ejemplo, lista de discos, últimas canciones, etc.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - <?= htmlspecialchars($_SESSION['usuario']) ?></title>
</head>
<body>
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?> 👋</h1>

    <!-- Imagen de perfil -->
    <?php if ($usuario['img_pequena']): ?>
        <img src="<?= htmlspecialchars($usuario['img_pequena']) ?>" alt="Imagen de perfil">
    <?php else: ?>
        <p>Sin imagen de perfil</p>
    <?php endif; ?>

    <!-- Enlaces importantes -->
    <p>
        <a href="perfil.php">Mi perfil</a> | 
        <a href="logout.php">Cerrar sesión</a>
    </p>

    <hr>

    <!-- Aquí podrías incluir la lista de discos/canciones -->
    <h2>Mis discos y canciones</h2>
    <p>Aquí podrías llamar a tus funciones de datosDiscografia() o similares.</p>

</body>
</html>
