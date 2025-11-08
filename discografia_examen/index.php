<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres -->
    <title>Document</title> <!-- Título de la página: cambiar según el tema -->
    <link rel="stylesheet" href="css/estilo.css"/> <!-- CSS de la página: opcional cambiar por otro estilo -->
    <?php
        include("datos.ini.php");     // Archivo con funciones o datos generales: cambiar por ejemplo a datosPeliculas.ini.php
        include("conexion.ini.php");  // Conexión a la base de datos: normalmente no se cambia
        include("album.ini.php");     // Archivo con funciones específicas de la discografía: cambiar por ejemplo a peliculas.ini.php
    ?>
</head>
<body>
    <?php
        datosDiscografia(); // Función que muestra la discografía: cambiar por ejemplo a datosPeliculas()
    ?>
</body>
</html>
