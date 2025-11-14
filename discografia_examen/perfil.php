<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Verifica que haya usuario en sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'conexion.ini.php';

// Crear conexión PDO usando la clase
$cn = new Conexion('localhost', 'root', '', 'discografia');
$conexion = $cn->conectionPDO();

// Obtener datos del usuario
$stmt = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE usuario = ?");
$stmt->execute([$_SESSION['usuario']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Manejo de error si no se encuentra usuario
if (!$usuario) {
    die("❌ Usuario no encontrado en la base de datos.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?= htmlspecialchars($usuario['usuario']) ?></title>
</head>
<body>
    <h2>👤 Perfil de <?= htmlspecialchars($usuario['usuario']) ?></h2>

    <?php if (!empty($usuario['img_grande'])): ?>
        <img src="<?= htmlspecialchars($usuario['img_grande']) ?>" alt="Imagen grande">
    <?php else: ?>
        <p>Sin imagen de perfil</p>
    <?php endif; ?>

    <p><strong>Usuario:</strong> <?= htmlspecialchars($usuario['usuario']) ?></p>
    <p><strong>Email:</strong> <?= !empty($usuario['email']) ? htmlspecialchars($usuario['email']) : 'No registrado' ?></p>

    <p>
        <a href="index.php">Volver a inicio</a> | 
        <a href="logout.php">Cerrar sesión</a>
    </p>
</body>
</html>
