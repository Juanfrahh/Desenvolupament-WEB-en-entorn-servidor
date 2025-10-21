<?php
session_start();
include 'conexion.php';

$mensaje = '';

// Si ya ha iniciado sesión, lo mandamos a la página principal
if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

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
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 50px;
}
fieldset {
    width: 300px;
    padding: 20px;
    border: 2px solid #ccc;
    background: white;
}
legend {
    font-weight: bold;
}
input {
    width: 95%;
    padding: 5px;
    margin-bottom: 10px;
}
input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    border: none;
}
input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
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
