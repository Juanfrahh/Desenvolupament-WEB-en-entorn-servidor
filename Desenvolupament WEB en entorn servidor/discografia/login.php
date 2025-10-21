<?php
include 'conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conexion->prepare("SELECT password FROM tabla_usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado && password_verify($password, $resultado['password'])) {
        $mensaje = "<p style='color:green;'>Login correcto. Bienvenido, <strong>$usuario</strong>.</p>";
    } else {
        $mensaje = "<p style='color:red;'>Login incorrecto.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login</title>
<style>
body { font-family: Arial, sans-serif; margin: 30px; }
fieldset { width: 300px; padding: 15px; border: 2px solid #ccc; }
legend { font-weight: bold; }
input { margin-bottom: 10px; }
</style>
</head>
<body>

<h2>Acceso a la Discografía</h2>

<form method="post" action="">
<fieldset>
<legend>Iniciar sesión</legend>

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
