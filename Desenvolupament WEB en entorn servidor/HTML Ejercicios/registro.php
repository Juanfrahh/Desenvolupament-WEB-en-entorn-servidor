<?php

$errores = [];
$nombre = $apellidos = $usuario = $email = $fecha = $genero = "";
$publicidad = false;

// Procesar el formulario solo si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Nombre
    if (empty($_POST['nombre'])) {
        $errores['nombre'] = "El nombre es obligatorio";
    } else {
        $nombre = htmlspecialchars($_POST['nombre']);
    }

    // Apellidos
    if (empty($_POST['apellidos'])) {
        $errores['apellidos'] = "Los apellidos son obligatorios";
    } else {
        $apellidos = htmlspecialchars($_POST['apellidos']);
    }

    // Usuario
    if (empty($_POST['usuario'])) {
        $errores['usuario'] = "El usuario es obligatorio";
    } else {
        $usuario = htmlspecialchars($_POST['usuario']);
    }

    // Passwords
    if (empty($_POST['password']) || empty($_POST['password2'])) {
        $errores['password'] = "Las contraseñas son obligatorias";
    } elseif ($_POST['password'] !== $_POST['password2']) {
        $errores['password'] = "Las contraseñas no coinciden";
    }

    // Email
    if (empty($_POST['email'])) {
        $errores['email'] = "El email es obligatorio";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = "Formato de email no válido";
    } else {
        $email = htmlspecialchars($_POST['email']);
    }

    // Fecha de nacimiento
    if (empty($_POST['fecha'])) {
        $errores['fecha'] = "La fecha de nacimiento es obligatoria";
    } else {
        $fecha = $_POST['fecha'];
    }

    // Género
    if (empty($_POST['genero'])) {
        $errores['genero'] = "Debe seleccionar un género";
    } else {
        $genero = $_POST['genero'];
    }

    // Condiciones
    if (!isset($_POST['condiciones'])) {
        $errores['condiciones'] = "Debe aceptar las condiciones";
    }

    // Publicidad (opcional)
    $publicidad = isset($_POST['publicidad']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>

<main>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errores)): ?>
    <h2>Registro completado</h2>
    <p>Bienvenido, <?php echo $nombre . " " . $apellidos; ?> (<?php echo $usuario; ?>)</p>
<?php else: ?>
    <h2>Formulario de Registro</h2>
    <form action="registro.php" method="post">

        Nombre: <input type="text" name="nombre" value="<?php echo $nombre; ?>">
        <span style="color:red"><?php echo $errores['nombre'] ?? ""; ?></span><br><br>

        Apellidos: <input type="text" name="apellidos" value="<?php echo $apellidos; ?>">
        <span style="color:red"><?php echo $errores['apellidos'] ?? ""; ?></span><br><br>

        Usuario: <input type="text" name="usuario" value="<?php echo $usuario; ?>">
        <span style="color:red"><?php echo $errores['usuario'] ?? ""; ?></span><br><br>

        Contraseña: <input type="password" name="password"><br><br>
        Repetir contraseña: <input type="password" name="password2">
        <span style="color:red"><?php echo $errores['password'] ?? ""; ?></span><br><br>

        Email: <input type="email" name="email" value="<?php echo $email; ?>">
        <span style="color:red"><?php echo $errores['email'] ?? ""; ?></span><br><br>

        Fecha de nacimiento: <input type="date" name="fecha" value="<?php echo $fecha; ?>">
        <span style="color:red"><?php echo $errores['fecha'] ?? ""; ?></span><br><br>

        Género:
        <input type="radio" name="genero" value="M" <?php if($genero=="M") echo "checked"; ?>> Masculino
        <input type="radio" name="genero" value="F" <?php if($genero=="F") echo "checked"; ?>> Femenino
        <input type="radio" name="genero" value="O" <?php if($genero=="O") echo "checked"; ?>> Otro
        <span style="color:red"><?php echo $errores['genero'] ?? ""; ?></span><br><br>

        <input type="checkbox" name="condiciones" <?php if(isset($_POST['condiciones'])) echo "checked"; ?>>
        Acepto las condiciones
        <span style="color:red"><?php echo $errores['condiciones'] ?? ""; ?></span><br><br>

        <input type="checkbox" name="publicidad" <?php if($publicidad) echo "checked"; ?>>
        Deseo recibir publicidad<br><br>

        <input type="submit" value="Registrarse">
    </form>
<?php endif; ?>
</main>
</body>
</html>
