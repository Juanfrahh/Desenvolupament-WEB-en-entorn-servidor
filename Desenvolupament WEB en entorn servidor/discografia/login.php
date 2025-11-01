<?php
session_start();
include 'conexion.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$mensaje = '';

if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['accion']) && $_GET['accion'] === 'usar_cookie' && isset($_COOKIE['usuario_recordado'])) {
    $_SESSION['usuario'] = $_COOKIE['usuario_recordado'];
    $mensaje = "<p style='color:green;'>✅ Acceso exitoso como <strong>{$_SESSION['usuario']}</strong>.</p>";
    echo $mensaje;
    echo '<p><a href="index.php">Ir al inicio</a></p>';
    exit();
}

if (isset($_GET['accion']) && $_GET['accion'] === 'borrar_cookie') {
    setcookie('usuario_recordado', '', time() - 3600, '/');
    header('Location: login.php');
    exit();
}

if (isset($_COOKIE['usuario_recordado']) && !isset($_SESSION['usuario'])) {
    $usuario_cookie = htmlspecialchars($_COOKIE['usuario_recordado']);
    echo "<h3>¿Quieres iniciar sesión como <strong>$usuario_cookie</strong>?</h3>";
    echo '<a href="login.php?accion=usar_cookie">✅ Sí</a> | ';
    echo '<a href="login.php?accion=borrar_cookie">❌ No</a>';
    exit();
}

if (isset($_POST['accion']) && $_POST['accion'] === 'login') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado && password_verify($password, $resultado['password'])) {
        $_SESSION['usuario'] = $usuario;

        setcookie('usuario_recordado', $usuario, time() + 86400, '/');

        header('Location: index.php');
        exit();
    } else {
        $mensaje = "<p style='color:red;'>❌ Usuario o contraseña incorrectos.</p>";
    }
}

if (isset($_POST['accion']) && $_POST['accion'] === 'registro') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($usuario) && !empty($password)) {
        $check = $conexion->prepare("SELECT COUNT(*) FROM tabla_usuarios WHERE usuario = ?");
        $check->execute([$usuario]);
        $existe = $check->fetchColumn();

        if ($existe > 0) {
            $mensaje = "<p style='color:red;'>El usuario '<strong>$usuario</strong>' ya existe.</p>";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conexion->prepare("INSERT INTO tabla_usuarios (usuario, password) VALUES (?, ?)");
            $stmt->execute([$usuario, $passwordHash]);
            $mensaje = "<p style='color:green;'>Usuario registrado correctamente. Ahora puedes iniciar sesión.</p>";
        }
    } else {
        $mensaje = "<p style='color:red;'>Rellena todos los campos.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login / Registro con Cookies</title>
</head>
<body>

<h2>🎵 Acceso a la Discografía</h2>

<div class="container">
    <form method="post">
        <fieldset>
            <legend>Iniciar sesión</legend>
            <input type="hidden" name="accion" value="login">
            <label>Usuario:</label><br>
            <input type="text" name="usuario" required><br>
            <label>Contraseña:</label><br>
            <input type="password" name="password" required><br>
            <input type="submit" value="Entrar">
        </fieldset>
    </form>

    <form method="post">
        <fieldset>
            <legend>Registrarse</legend>
            <input type="hidden" name="accion" value="registro">
            <label>Usuario:</label><br>
            <input type="text" name="usuario" required><br>
            <label>Contraseña:</label><br>
            <input type="password" name="password" required><br>
            <input type="submit" value="Crear cuenta">
        </fieldset>
    </form>
</div>

<?= $mensaje ?>

</body>
</html>
