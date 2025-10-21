<?php
session_start();
include 'conexion.php';

$mensaje = '';

<?php
session_start();
session_destroy();
header('Location: login.php');
?>


// Si el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    // Buscar el usuario en la base de datos
    $stmt = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado && password_verify($password, $resultado['password'])) {
        // Login correcto
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php'); // redirige al listado de álbumes
        exit();
    } else {
        $mensaje = "<p style='color:red;'>❌ Usuario o contraseña incorrectos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar sesión</title>
</head>
<body>

<h2>🔒 Acceso a la Discografía</h2>

<form method="post" action="">
<fieldset>
    <legend>Inicio de sesión</legend>

    <label>Usuario:</label><br>
    <input type="text" name="usuario" required><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br>

    <input type="submit" value="Entrar">
</fieldset>
</form>

<?= $mensaje ?>

</body>
</html>
