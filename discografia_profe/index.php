<?php
session_start();

// Si no existe la cookie de aceptación → cerrar sesión y redirigir
if (!isset($_COOKIE['aceptar_cookies'])) {
    session_unset();
    session_destroy();
    exit();
}

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

<div style="padding:10px; background:#eee;">
    Bienvenido <strong><?= $_SESSION['usuario'] ?></strong> |
    <a href="perfil.php">Mi perfil</a> |
    <a href="logout.php">Cerrar sesión</a>
</div>


	<?php datosDiscografia(); ?>

</body>
</html>
