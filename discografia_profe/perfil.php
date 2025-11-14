<?php
session_start();
include("conexion.ini.php");

// Verificar sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['usuario_id'];

// Procesar subida de imagen
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {

    $nombreTmp = $_FILES['foto']['tmp_name'];
    $nombreOriginal = $_FILES['foto']['name'];

    $ext = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
    $nuevoNombre = "user_" . $id . "." . $ext;

    // Guardar en carpeta img/
    move_uploaded_file($nombreTmp, "img/" . $nuevoNombre);

    // Guardar ruta en la BD
    $sql = "UPDATE usuarios SET foto = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $rutaFoto = "img/" . $nuevoNombre;
    $stmt->bind_param("si", $rutaFoto, $id);
    $stmt->execute();
}

// Obtener datos del usuario
$sql = "SELECT usuario, foto FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($usuario, $foto);
$stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
</head>
<body>

<h2>Perfil del Usuario</h2>

<p><strong>Usuario:</strong> <?= $usuario ?></p>

<?php if (!empty($foto)) : ?>
    <img src="<?= $foto ?>" width="150" alt="Foto de perfil"><br><br>
<?php else : ?>
    <p>No tienes una foto de perfil.</p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Subir nueva foto de perfil:</label><br>
    <input type="file" name="foto" accept="image/*" required><br><br>
    <button type="submit">Actualizar foto</button>
</form>

<br>
<a href="logout.php">Cerrar sesión</a>

</body>
</html>
