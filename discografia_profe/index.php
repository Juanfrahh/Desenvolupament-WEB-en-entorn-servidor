<?php
session_start(); // iniciar sesión

// Si no hay usuario logueado, redirige automáticamente al login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
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



	<?php datosDiscografia(); ?>

</body>
</html>
