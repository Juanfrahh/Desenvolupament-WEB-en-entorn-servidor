<?php
session_start();
?>
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

	<!-- MENÚ SUPERIOR / LOGIN / PERFIL / LOGOUT -->
	<div style="padding: 10px; background: #eee; border-bottom: 1px solid #ccc;">
		<?php if (!isset($_SESSION['usuario_id'])): ?>

			<a href="login.php">Iniciar sesión</a>

		<?php else: ?>

			<span>Bienvenido, <strong><?= $_SESSION['usuario'] ?></strong></span> |
			<a href="perfil.php">Mi perfil</a> |
			<a href="logout.php">Cerrar sesión</a>

		<?php endif; ?>
	</div>

	<!-- CONTENIDO PRINCIPAL -->
	<?php datosDiscografia(); ?>

</body>
</html>
