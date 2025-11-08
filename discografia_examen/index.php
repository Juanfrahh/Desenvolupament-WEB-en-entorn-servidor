<?php
session_start();
include("conexion.ini.php"); // Conexión a la base de datos

// Verificar si usuario está logueado
if(!isset($_SESSION['usuario'])){
    header("Location: login.php"); // Redirige al login si no hay sesión
    exit();
}

// Opcional: si quieres usar usuario recordado por cookie
if(!isset($_SESSION['usuario']) && isset($_COOKIE['usuario_recordado'])){
    $_SESSION['usuario'] = $_COOKIE['usuario_recordado'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel principal</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>

    <!-- Botón de logout -->
    <a href="logout.php">Cerrar sesión</a>

    <hr>

    <!-- Enlaces a la gestión de discos y canciones -->
    <h2>Gestión de discografía</h2>
    <ul>
        <li><a href="disconuevo.php">Registrar nuevo disco</a></li>
        <li><a href="canciones.php">Buscar canciones</a></li>
        <li><a href="datosdiscografia.php">Ver todos los discos</a></li>
    </ul>

</body>
</html>
