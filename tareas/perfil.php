<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Usuario.php';

protegerPagina();
$u = new Usuario();
$datos = $u->getUsuario($_SESSION['usuario_id']);
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $correo = limpiarEntrada($_POST['correo'] ?? '');
    $ruta_img = $datos['ruta_img'];

    if (!is_dir(__DIR__ . '/uploads')) {
        mkdir(__DIR__ . '/uploads', 0755);
    }
    if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error'] === 0) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $ruta_img = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . '/uploads/' . $ruta_img);
    }

    if ($u->actualizarPerfil($_SESSION['usuario_id'], $nombre, $correo, $ruta_img)) {
        $_SESSION['usuario_nombre'] = $nombre;
        $_SESSION['usuario_img'] = $ruta_img;
        $mensaje = "Perfil actualizado correctamente.";
    } else {
        $mensaje = "Error al actualizar perfil.";
    }
    // refrescar datos
    $datos = $u->getUsuario($_SESSION['usuario_id']);
}

include __DIR__ . '/header.php';
?>
<h2>Perfil</h2>

<form method="post" enctype="multipart/form-data">
    <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($datos['nombre']) ?>" required></label><br><br>
    <label>Correo: <input type="email" name="correo" value="<?= htmlspecialchars($datos['correo']) ?>" required></label><br><br>
    <label>Foto: <input type="file" name="foto" accept="image/*"></label><br><br>
    <?php if (!empty($datos['ruta_img'])): ?>
        <img src="uploads/<?= htmlspecialchars($datos['ruta_img']) ?>" width="100"><br><br>
    <?php endif; ?>
    <button type="submit">Actualizar</button>
</form>

<?php if($mensaje): ?><p style="color:green;"><?= $mensaje ?></p><?php endif; ?>
