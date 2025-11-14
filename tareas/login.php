<?php
session_start(); // Inicia sesión para guardar datos del usuario
include("conexion.ini.php"); // Incluye la clase de conexión

// Crear la conexión PDO
$conectar = new Conexion('localhost', 'root', '', 'tareas');
$conexion = $conectar->conectionPDO();

// Inicializar mensaje de error/éxito
$mensaje = '';

if (isset($_POST['accion']) && $_POST['accion'] === 'login') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($usuario) && !empty($password)) {
        // Consulta para obtener la contraseña hasheada del usuario
        $stmt = $conexion->prepare("SELECT password FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $hash = $stmt->fetchColumn();

        if ($hash && password_verify($password, $hash)) {
            // Login correcto
            $_SESSION['usuario'] = $usuario; // Guardamos el usuario en sesión
            header("Location: index.php"); // Redirige a index.php
            exit();
        } else {
            $mensaje = "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
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
    <title>Login</title>
</head>
<body>
    <h1>Iniciar sesión</h1>
    <?php echo $mensaje; ?>
    <form action="login.php" method="post">
        <input type="text" name="usuario" placeholder="Usuario" required><br>
        <input type
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <input type="hidden" name="accion" value="login">
        <input type="submit" value="Entrar">
    </form>
    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
</body>
</html>
