<?php
require_once '../config/config.php';
require_once 'Usuario.php';

$mensaje = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = limpiarEntrada($_POST['nombre']);
    $correo = limpiarEntrada($_POST['correo']);
    $contrasena = $_POST['contrasena'];
    $ruta_img = 'default.png';

    // Subir imagen
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
        $ruta_img = time() . '_' . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/' . $ruta_img);
    }

    $usuario = new Usuario();
    if($usuario->registrar($nombre, $correo, $contrasena, $ruta_img)){
        header('Location: login.php');
        exit;
    } else {
        $mensaje = "Error al registrar.";
    }
}

include 'header.php';
?>

<h2>Registro de Usuario</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Nombre: <input type="text" name="nombre" required></label><br>
    <label>Correo: <input type="email" name="correo" required></label><br>
    <label>Contraseña: <input type="password" name="contrasena" required></label><br>
    <label>Foto de perfil: <input type="file" name="foto"></label><br>
    <button type="submit">Registrar</button>
</form>
<p style="color:red;"><?= $mensaje ?></p>
