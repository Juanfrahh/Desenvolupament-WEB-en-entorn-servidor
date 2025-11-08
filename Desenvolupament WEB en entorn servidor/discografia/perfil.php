<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
include 'conexion.php';

$stmt = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE usuario = ?");
$stmt->execute([$_SESSION['usuario']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Perfil de <?= htmlspecialchars($_SESSION['usuario']) ?></title>
</head>
<body>
<h2>👤 Perfil de <?= htmlspecialchars($_SESSION['usuario']) ?></h2>

<?php if ($usuario['img_grande']): ?>
    <img src="<?= htmlspecialchars($usuario['img_grande']) ?>" alt="Imagen grande">
<?php else: ?>
    <p>Sin imagen de perfil</p>
<?php endif; ?>

<p><strong>Usuario:</strong> <?= htmlspecialchars($usuario['usuario']) ?></p>

<p><a href="index.php">Volver a inicio</a> | <a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
