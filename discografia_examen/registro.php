<?php
session_start();
include("conexion.ini.php");

// Crear conexión PDO
$conectar = new Conexion('localhost', 'root', '', 'discografia');
$conexion = $conectar->conectionPDO();

$mensaje = '';

if (isset($_POST['accion']) && $_POST['accion'] === 'registro') {

    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    // Validaciones
    if (empty($usuario) || empty($password) || empty($password2)) {
        $mensaje = "<p style='color:red;'>Rellena todos los campos.</p>";
    }
    elseif ($password !== $password2) {
        $mensaje = "<p style='color:red;'>Las contraseñas no coinciden.</p>";
    }
    else {
        // Verificar si ya existe el usuario
        $stmt = $conexion->prepare("SELECT COUNT(*) FROM tabla_usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);

        if ($stmt->fetchColumn() > 0) {
            $mensaje = "<p style='color:red;'>Ese usuario ya existe.</p>";
        }
        else {
            // Registrar usuario
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conexion->prepare("INSERT INTO tabla_usuarios (usuario, password) VALUES (?, ?)");
            $stmt->execute([$usuario, $hash]);

            $mensaje = "<p style='color:green;'>✔ Usuario registrado correctamente. Ahora puedes iniciar sesión.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>

<h1>Registro de usuario</h1>

<?php echo $mensaje; ?>

<form action="registro.php" method="post">
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br>
    <input type="password" name="password2" placeholder="Repetir contraseña" required><br>

    <input type="hidden" name="accion" value="registro">
    <input type="submit" value="Registrarme">
</form>

<p><a href="login.php">Ya tengo cuenta</a></p>

</body>
</html>
