<?php
session_start();

include("conexion.ini.php");

// Crear conexión usando tu clase
$conectar = new Conexion('localhost','root','', 'discografia');
$conexion = $conectar->conectionPDO();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = "SELECT id, usuario, password FROM tabla_usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {

            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario'] = $user['usuario'];
            header("Location: index.php");
            exit();

        } else {
            $error = "Contraseña incorrecta.";
        }

    } else {
        $error = "Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>Iniciar sesión</h2>

<form method="POST">
    Usuario:<br>
    <input type="text" name="usuario" required><br><br>

    Contraseña:<br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Entrar</button>
</form>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

</body>
</html>
