<?php
require_once 'config.php';
require_once 'usuario.php';

$usuario = new Usuario();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = limpiarEntrada($_POST['correo'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    if ($usuario->login($correo, $contrasena)) {
        header('Location: index.php');
        exit;
    } else {
        $mensaje = "Correo o contraseña incorrectos.";
    }
}

include 'header.php';
?>
<h2>Login</h2>
<form method="post">
    <label>Correo: <input type="email" name="correo" required></label><br><br>
    <label>Contraseña: <input type="password" name="contrasena" required></label><br><br>
    <button type="submit">Entrar</button>
</form>
<?php if($mensaje): ?><p style="color:red;"><?php echo $mensaje; ?></p><?php endif; ?>
