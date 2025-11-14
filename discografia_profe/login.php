<?php
session_start();
include("conexion.ini.php");

$conectar = new Conexion('localhost','root','','discografia');
$pdo = $conectar->conectionPDO();

$errorLogin = '';
$exitoRegistro = '';
$errorRegistro = '';

// --- PROCESO LOGIN ---
if (isset($_POST['login'])) {
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];

    $sql = "SELECT id, usuario, password FROM tabla_usuarios WHERE usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario'] = $user['usuario'];
            header("Location: index.php");
            exit();
        } else {
            $errorLogin = "Contraseña incorrecta.";
        }
    } else {
        $errorLogin = "Usuario no encontrado.";
    }
}

// --- PROCESO REGISTRO ---
if (isset($_POST['registro'])) {
    $usuarioR = trim($_POST['usuarioR']);
    $passwordR = $_POST['passwordR'];
    $passwordR2 = $_POST['passwordR2'];

    if ($passwordR !== $passwordR2) {
        $errorRegistro = "Las contraseñas no coinciden.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM tabla_usuarios WHERE usuario = ?");
        $stmt->execute([$usuarioR]);
        if ($stmt->fetch()) {
            $errorRegistro = "El usuario ya existe.";
        } else {
            $pass_hash = password_hash($passwordR, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO tabla_usuarios (usuario, password) VALUES (?, ?)");
            if ($stmt->execute([$usuarioR, $pass_hash])) {
                $exitoRegistro = "Usuario registrado correctamente. Ahora puedes iniciar sesión.";
            } else {
                $errorRegistro = "Error al registrar usuario.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login y Registro</title>
    <style>
        body { font-family: Arial, sans-serif; display:flex; justify-content:center; align-items:flex-start; margin-top:50px; gap:50px;}
        .box { border:1px solid #ccc; padding:20px; border-radius:10px; width:300px;}
        h2 { text-align:center; }
        input { width:100%; padding:8px; margin:5px 0; }
        button { width:100%; padding:10px; margin-top:10px; }
        p.error { color:red; }
        p.exito { color:green; }
    </style>
</head>
<body>

<div class="box">
    <h2>Iniciar sesión</h2>
    <?php if($errorLogin) echo "<p class='error'>$errorLogin</p>"; ?>
    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" name="login">Entrar</button>
    </form>
</div>

<div class="box">
    <h2>Registrarse</h2>
    <?php if($errorRegistro) echo "<p class='error'>$errorRegistro</p>"; ?>
    <?php if($exitoRegistro) echo "<p class='exito'>$exitoRegistro</p>"; ?>
    <form method="POST">
        <input type="text" name="usuarioR" placeholder="Usuario" required>
        <input type="password" name="passwordR" placeholder="Contraseña" required>
        <input type="password" name="passwordR2" placeholder="Repetir contraseña" required>
        <button type="submit" name="registro">Registrarse</button>
    </form>
</div>

</body>
</html>
