<?php

session_start();
session_destroy();
header('Location: login.php');
exit();

session_start();
include 'conexion.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$mensaje = '';
º
if (isset($_POST['accion']) && $_POST['accion'] === 'login') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado && password_verify($password, $resultado['password'])) {
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
        exit();
    } else {
        $mensaje = "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
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
<title>Login / Registro</title>
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
