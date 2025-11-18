<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'conexion.ini.php';
$cn = new Conexion('localhost', 'root', '', 'discografia');
$conexion = $cn->conectionPDO();

// Obtener datos del usuario
$stmt = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE usuario = ?");
$stmt->execute([$_SESSION['usuario']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$usuario) die("Usuario no encontrado");

// Manejar subida de imagen
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $archivo = $_FILES['foto'];
    if ($archivo['error'] === 0) {
        $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $permitidas)) {
            $nombreArchivo = 'img/' . uniqid() . '.' . $ext;
            if (move_uploaded_file($archivo['tmp_name'], $nombreArchivo)) {
                // Guardar ruta en la base de datos
                $stmt = $conexion->prepare("UPDATE tabla_usuarios SET img_grande=? WHERE usuario=?");
                $stmt->execute([$nombreArchivo, $_SESSION['usuario']]);
                $usuario['img_grande'] = $nombreArchivo; // actualizar variable local
                $mensaje = "✅ Foto subida correctamente.";
            } else {
                $mensaje = "❌ Error al mover el archivo.";
            }
        } else {
            $mensaje = "❌ Tipo de archivo no permitido.";
        }
    } else {
        $mensaje = "❌ Error al subir el archivo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Perfil de <?= htmlspecialchars($usuario['usuario']) ?></title>
</head>
<body>
<h2>Perfil de <?= htmlspecialchars($usuario['usuario']) ?></h2>

<?php if ($mensaje) echo "<p>$mensaje</p>"; ?>

<?php if (!empty($usuario['img_grande'])): ?>
    <img src="<?= htmlspecialchars($usuario['img_grande']) ?>" alt="Imagen de perfil" width="150">
<?php else: ?>
    <p>Sin imagen de perfil</p>
<?php endif; ?>

<p><strong>Usuario:</strong> <?= htmlspecialchars($usuario['usuario']) ?></p>
<p><strong>Email:</strong> <?= !empty($usuario['email']) ? htmlspecialchars($usuario['email']) : 'No registrado' ?></p>

<h3>Cambiar foto de perfil</h3>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="foto" accept="image/*" required>
    <input type="submit" value="Subir foto">
</form>

<p>
<a href="index.php">Volver a inicio</a> | 
<a href="logout.php">Cerrar sesión</a>
</p>
</body>
</html>
