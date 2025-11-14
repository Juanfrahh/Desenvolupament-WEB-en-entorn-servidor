<?php
session_start();
include("conexion.ini.php");

// Si ya está logueado, redirigir
if (isset($_SESSION['usuario_id'])) {
    header("Location: perfil.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta usuario
    $sql = "SELECT id, usuario, password FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $user, $passHash);
        $stmt->fetch();

        if (password_verify($password, $passHash)) {
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario'] = $user;
            header("Location: perfil.php");
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
