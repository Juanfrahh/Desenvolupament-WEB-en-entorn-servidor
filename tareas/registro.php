<?php
require_once 'config.php';
require_once 'usuario.php';

$usuario = new Usuario();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $correo = limpiarEntrada($_POST['correo'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $ruta_img = 'default.png';

    if (!is_dir('img')) mkdir('img', 0755);
    if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error'] === 0) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $ruta_img = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $ruta_img);
    }

    if ($usuario->registrar($nombre, $correo, $contrasena, $ruta_img)) {
        flash('mensaje', 'Registro correcto. Puedes iniciar sesión.');
        header('Location: login.php');
        exit;
    } else {
        $mensaje = "Error al registrar (tal vez el correo ya existe).";
    }
}

include 'header.php';
?>
<h2>Registro</h2>
<form method="post" enctype="multipart/form-data">
    <label>Nombre: <input type="text" name="nombre" required></label><br><br>
    <label>Correo: <input type="email" name="correo" required></label><br><br>
    <label>Contraseña: <input type="password" name="contrasena" required></label><br><br>
    <label>Foto de perfil: <input type="file" name="foto" accept="image/*"></label><br><br>
    <button type="submit">Registrar</button>
</form>
<?php if($mensaje): ?><p style="color:red;"><?php echo $mensaje; ?></p><?php endif; ?>
