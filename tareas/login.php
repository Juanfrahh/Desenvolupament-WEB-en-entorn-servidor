<?php
require_once '../config/config.php';
require_once '../classes/Usuario.php';

$mensaje = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $correo = limpiarEntrada($_POST['correo']);
    $contrasena = $_POST['contrasena'];
    $usuario = new Usuario();
    if($usuario->login($correo, $contrasena)){
        header('Location: index.php');
        exit;
    } else {
        $mensaje = "Correo o contraseña incorrectos.";
    }
}

include 'header.php';
?>

<h2>Login</h2>
<form method="POST">
    <label>Correo: <input type="email" name="correo" required></label><br>
    <label>Contraseña: <input type="password" name="contrasena" required></label><br>
    <button type="submit">Entrar</button>
</form>
<p style="color:red;"><?= $mensaje ?></p>
