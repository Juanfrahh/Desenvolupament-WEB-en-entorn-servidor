<?php
require_once 'config.php';
require_once 'usuario.php';
protegerPagina();

$usuario = new Usuario();
$datos = $usuario->getUsuario($_SESSION['usuario_id']);
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $correo = limpiarEntrada($_POST['correo'] ?? '');
    $ruta_img = null;

    if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error'] === 0) {
        if (!is_dir('img')) mkdir('img', 0755);
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $ruta_img = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $ruta_img);
    }

    if ($usuario->actualizarPerfil($_SESSION['usuario_id'], $nombre, $correo, $ruta_img)) {
        $_SESSION['usuario_nombre'] = $nombre;
        $_SESSION['usuario_fullname'] = $nombre;
        if ($ruta_img) $_SESSION['usuario_img'] = $ruta_img;
        $mensaje = "Perfil actualizado.";
        $datos = $usuario->getUsuario($_SESSION['usuario_id']);
    } else {
        $mensaje = "Error al actualizar perfil.";
    }
}

include 'header.php';
?>
<h2>Perfil</h2>
<form method="post" enctype="multipart/form-data">
    <label>Nombre: <input type="text" name="nombre" value="<?php echo $datos['nombre']; ?>" required></label><br><br>
    <label>Correo: <input type="email" name="correo" value="<?php echo $datos['correo']; ?>" required></label><br><br>
    <label>Foto: <input type="file" name="foto" accept="image/*"></label><br><br>
    <?php if(!empty($datos['ruta_img'])): ?>
        <img src="img/<?php echo $datos['ruta_img']; ?>" width="100"><br><br>
    <?php endif; ?>
    <button type="submit">Actualizar</button>
</form>
<?php if($mensaje): ?><p style="color:green;"><?php echo $mensaje; ?></p><?php endif; ?>
