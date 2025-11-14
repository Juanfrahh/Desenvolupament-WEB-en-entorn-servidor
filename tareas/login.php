<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/usuario.php';

$usuario = new Usuario();
$mensaje = '';

if (!estaAutenticado() && !empty($_COOKIE['remember_user'])) {
    $id = (int)$_COOKIE['remember_user'];
    $datos = $usuario->getUsuario($id);
    if ($datos) {
        $_SESSION['usuario_id'] = $datos['id'];
        $_SESSION['usuario_nombre'] = $datos['nombre'];
        $_SESSION['usuario_img'] = $datos['ruta_img'];
        header('Location: index.php'); exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = limpiarEntrada($_POST['correo'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $recordar = isset($_POST['recordar']);

    if ($usuario->login($correo, $contrasena)) {
        if ($recordar) {
            setcookie('remember_user', $_SESSION['usuario_id'], time() + 30*24*3600, "/");
        }
        header('Location: index.php');
        exit;
    } else {
        $mensaje = "Correo o contraseña incorrectos.";
    }
}

include __DIR__ . '/header.php';
?>
<h2>Login</h2>
<form method="post">
    <label>Correo: <input type="email" name="correo" required></label><br><br>
    <label>Contraseña: <input type="password" name="contrasena" required></label><br><br>
    <label><input type="checkbox" name="recordar"> Recordarme</label><br><br>
    <button type="submit">Entrar</button>
</form>
<?php if($mensaje): ?><p style="color:red;"><?= $mensaje ?></p><?php endif; ?>
