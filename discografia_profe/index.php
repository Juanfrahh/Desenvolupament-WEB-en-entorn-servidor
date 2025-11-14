<?php
session_start(); // Inicia la sesión para poder usar $_SESSION

// Si no hay usuario en sesión, redirige al login
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/estilo.css"/>
	<?php
		include("datos.ini.php");
		include("conexion.ini.php");
		include("album.ini.php");
	?>
</head>
<body>

	<div style="padding:10px; background:#eee;">
		<?php if (!isset($_SESSION['usuario_id'])): ?>
			<a href="login.php">Iniciar sesión</a>
		<?php else: ?>
			Bienvenido <strong><?= $_SESSION['usuario'] ?></strong> |
			<a href="perfil.php">Mi perfil</a> |
			<a href="logout.php">Cerrar sesión</a>
		<?php endif; ?>
	</div>

	<?php datosDiscografia(); ?>

</body>
</html>
