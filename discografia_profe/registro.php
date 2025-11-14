<?php
session_start();
include("conexion.ini.php");

$conectar = new Conexion('localhost','root','','discografia');
$pdo = $conectar->conectionPDO();

$error = '';
$exito = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Validar contraseñas
    if ($password !== $password2) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Comprobar si el usuario ya existe
        $stmt = $pdo->prepare("SELECT id FROM tabla_usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        if ($stmt->fetch()) {
            $error = "El usuario ya existe.";
        } else {
            // Hashear la contraseña
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);

            // Subir foto si hay
            $foto_path = null;
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $nombre_foto = time() . '_' . $_FILES['foto']['name'];
                $ruta_destino = 'img/' . $nombre_foto;
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino)) {
                    $foto_path = $ruta_destino;
                }
            }

            // Insertar en DB
            $stmt = $pdo->prepare("INSERT INTO tabla_usuarios (usuario, password, foto) VALUES (?, ?, ?)");
            if ($stmt->execute([$usuario, $pass_hash, $foto_path])) {
                $exito = "Usuario registrado correctamente. <a href='login.php'>Iniciar sesión</a>";
            } else {
                $error = "Error al registrar usuario.";
            }
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
<h2>Registro de usuario</h2>

<?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
<?php if($exito) echo "<p style='color:green;'>$exito</p>"; ?>

<form method="POST" enctype="multipart/form-data">
    Usuario:<br>
    <input type="text" name="usuario" required><br><br>

    Contraseña:<br>
    <input type="password" name="password" required><br><br>

    Repetir contraseña:<br>
    <input type="password" name="password2" required><br><br>

    Foto (opcional):<br>
    <input type="file" name="foto" accept="image/*"><br><br>

    <button type="submit">Registrarse</button>
</form>

<p>Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
</body>
</html>
