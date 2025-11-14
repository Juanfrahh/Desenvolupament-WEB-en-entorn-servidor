<?php
require_once 'config.php';
require_once '../classes/Usuario.php';

protegerPagina();

$usuario = new Usuario();
$datos = $usuario->getUsuario($_SESSION['usuario_id']);
$mensaje = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = limpiarEntrada($_POST['nombre']);
    $correo = limpiarEntrada($_POST['correo']);
    $ruta_img = $datos['ruta_img'];

    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
        $ruta_img = time() . '_' . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/' . $ruta_img);
    }

    if($usuario->actualizarPerfil($_SESSION['usuario_id'], $nombre, $correo, $ruta_img)){
        $_SESSION['usuario_nombre'] = $nombre;
        $_SESSION['usuario_img'] = $ruta_img;
        $mensaje = "Perfil actualizado correctamente.";
    } else {
        $mensaje = "Error al actualizar perfil.";
    }
}

include '../includes/header.php';
?>

<h2>Perfil de Usuario</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($datos['nombre']) ?>" required></label><br>
    <label>Correo: <input type="email" name="correo" value="<?= htmlspecialchars($datos['correo']) ?>" required></label><br>
    <label>Foto de perfil: <input type="file" name="foto"></label><br>
    <img src="../assets/img/<?= $datos['ruta_img'] ?>" width="100"><br>
    <button type="submit">Actualizar</button>
</form>
<p style="color:green;"><?= $mensaje ?></p>
