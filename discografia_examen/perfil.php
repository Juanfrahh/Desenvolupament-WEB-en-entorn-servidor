<?php
session_start(); 
// Inicia la sesión PHP. Necesario para manejar login y mantener activo al usuario.
// Si quieres cambiar el sistema de autenticación o usar otra tabla, esta línea sigue igual.

if (!isset($_SESSION['usuario'])) {
    // Verifica si hay un usuario logueado
    header('Location: login.php'); // Si no hay sesión, redirige al login
    exit(); // Detiene la ejecución del script
}

include 'conexion.ini.php'; 
// Incluye el archivo de conexión a la base de datos.
// Si cambias a otra base de datos (ej. Pokémon), asegúrate de que 'conexion.php' apunte a la nueva BD.

$stmt = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE usuario = ?"); 
// Prepara una consulta segura para obtener los datos del usuario actual
// Si cambias la estructura de la tabla de usuarios, debes modificar los campos aquí

$stmt->execute([$_SESSION['usuario']]); 
// Ejecuta la consulta con el usuario de la sesión

$usuario = $stmt->fetch(PDO::FETCH_ASSOC); 
// Obtiene los datos como un array asociativo
// Aquí podrías agregar más información de la tabla según lo que quieras mostrar
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Perfil de <?= htmlspecialchars($_SESSION['usuario']) ?></title>
<!-- htmlspecialchars evita inyección de código HTML -->
</head>
<body>
<h2>👤 Perfil de <?= htmlspecialchars($_SESSION['usuario']) ?></h2>

<?php if ($usuario['img_grande']): ?>
    <!-- Si el usuario tiene imagen de perfil -->
    <img src="<?= htmlspecialchars($usuario['img_grande']) ?>" alt="Imagen grande">
<?php else: ?>
    <!-- Si no hay imagen, muestra un mensaje alternativo -->
    <p>Sin imagen de perfil</p>
<?php endif; ?>

<p><strong>Usuario:</strong> <?= htmlspecialchars($usuario['usuario']) ?></p>
<!-- Muestra el nombre de usuario de manera segura -->

<p>
    <a href="index.php">Volver a inicio</a> | <!-- Enlace al panel principal -->
    <a href="logout.php">Cerrar sesión</a> <!-- Enlace para cerrar la sesión -->
</p>
</body>
</html>
