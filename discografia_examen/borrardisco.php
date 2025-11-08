<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
        // Incluimos los archivos necesarios:
        // datos.ini.php -> contiene funciones para generar formularios y mostrar datos
        // conexion.ini.php -> clase de conexión a la base de datos
        // album.ini.php -> clase Album, que maneja discos (insertar, borrar, etc.)
		include("datos.ini.php");
        include("conexion.ini.php");
        include("album.ini.php");
	?>
    <title>Document</title>
</head>
<body>
    <?php
        // Botón para volver a la página principal
        echo '<button  onclick=location.href="./index.php">Volver</button>';

        // Crear objeto de conexión a la base de datos
        $conectar = new Conexion('localhost','user','user','discografia');
		$conexion = $conectar->conectionPDO(); // Conexión usando PDO

        // Crear objeto Album con el código pasado por URL (GET['cod'])
        // Los demás atributos se dejan vacíos porque solo necesitamos el código para borrar
        $album = new Album($_GET['cod'],'','','','','','');

        // Llamamos al método borrarDisco del objeto Album
        // $_GET['TC'] representa el total de canciones del disco
        $album->borrarDisco($conexion,$_GET['TC']);
        // Este método borra el disco de la base de datos, probablemente comprobando antes
        // si tiene canciones asociadas
    ?>
</body>
</html>
