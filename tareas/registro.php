<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/usuario.php';

$usuario = new Usuario();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $apellidos = limpiarEntrada($_POST['apellidos'] ?? '');
    $correo = limpiarEntrada($_POST['correo'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $ruta_img = 'default.png';

    if (!is_dir(__DIR__ . '/img')) {
        mkdir(__DIR__ . '/uploads', 0755);
    }
    if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error'] === 0) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $ruta_img = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . '/uploads/' . $ruta_img);
    }

    if ($usuario->registrar($nombre, $apellidos, $correo, $contrasena, $ruta_img)) {
        flash('mensaje', 'Registro correcto. Puedes iniciar sesión.');
        header('Location: login.php');
        exit;
    } else {
        $mensaje = "Error al registrar (tal vez el correo ya existe).";
    }
}

include __DIR__ . '/header.php';
?>
<h2>Registro</h2>
<form method="post" enctype="multipart/form-data">
    <label>Nombre: <input type="text" name="nombre" required></label><br><br>
    <label>Apellidos: <input type="text" name="apellidos" required></label><br><br>
    <label>Correo: <input type="email" name="correo" required></label><br><br>
    <label>Contraseña: <input type="password" name="contrasena" required></label><br><br>
    <label>Foto de perfil: <input type="file" name="foto" accept="image/*"></label><br><br>
    <button type="submit">Registrar</button>
</form>
<?php if($mensaje): ?><p style="color:red;"><?= $mensaje ?></p><?php endif; ?>
