<?php
session_start(); // Inicia la sesión para controlar qué usuario está logueado

// Si no hay un usuario en sesión, redirige al login
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Incluimos la conexión a la BD (usa el nuevo conexion.php)
include 'conexion.php';

// Obtenemos los datos del usuario actual desde la BD
$stmt = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE usuario = ?");
$stmt->execute([$_SESSION['usuario']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC); // Guardamos los datos del usuario
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - <?= htmlspecialchars($_SESSION['usuario']) ?></title>
</head>
<body>
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?> 👋</h1>

    <!-- Muestra la imagen de perfil si existe -->
    <?php if (!empty($usuario['img_pequena'])): ?>
        <img src="<?= htmlspecialchars($usuario['img_pequena']) ?>" alt="Imagen de perfil">
    <?php else: ?>
        <p>Sin imagen de perfil</p>
    <?php endif; ?>

    <!-- Enlaces a otras secciones -->
    <p>
        <a href="perfil.php">👤 Mi perfil</a> | 
        <a href="logout.php">🚪 Cerrar sesión</a>
    </p>

    <hr>

    <!-- Aquí podrías incluir las funciones de discografía o cualquier otro módulo -->
    <h2>🎵 Mis discos y canciones</h2>
    <p>Aquí podrías mostrar tus discos o canciones de la base de datos.</p>
</body>
</html>
