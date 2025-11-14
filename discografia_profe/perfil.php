<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include("conexion.ini.php");

$conectar = new Conexion('localhost','root','', 'discografia');
$conexion = $conectar->conectionPDO();

$id = $_SESSION['usuario_id'];

// Si el usuario sube una foto
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {

    $tmp = $_FILES['foto']['tmp_name'];
    $nombre = $_FILES['foto']['name'];

    $ext = pathinfo($nombre, PATHINFO_EXTENSION);
    $nuevoNombre = "user_" . $id . "." . $ext;

    move_uploaded_file($tmp, "img/" . $nuevoNombre);

    $ruta = "img/" . $nuevoNombre;

    $stmt = $conexion->prepare("UPDATE usuarios SET foto=? WHERE id=?");
    $stmt->execute([$ruta, $id]);
}

// Obtener datos del usuario
$stmt = $conexion->prepare("SELECT usuario, foto FROM usuarios WHERE id=?");
$stmt->execute([$id]);
$datos = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
</head>
<body>

<h2>Perfil del Usuario</h2>

<p><strong>Usuario:</strong> <?= $datos['usuario'] ?></p>

<?php if ($datos['foto']): ?>
    <img src="<?= $datos['foto'] ?>" width="150">
<?php else: ?>
    <p>No tienes foto de perfil.</p>
<?php endif; ?>


<form method="POST" enctype="multipart/form-data">
    <label>Subir nueva foto:</label><br>
    <input type="file" name="foto" required><br><br>
    <button type="submit">Guardar</button>
</form>

<br>
<a href="logout.php">Cerrar sesión</a>

</body>
</html>
