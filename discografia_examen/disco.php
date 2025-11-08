<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres -->
    <?php
        include("datos.ini.php");     // Archivo con funciones o datos generales: cambiar por ejemplo a datosPeliculas.ini.php
        include("conexion.ini.php");  // Conexión a la base de datos: normalmente se mantiene igual
        include("album.ini.php");     // Archivo con funciones y clases para discos: cambiar por ejemplo a peliculas.ini.php
        include("cancion.ini.php");   // Archivo con funciones relacionadas con canciones: cambiar según el tema, ej. escenasPeliculas.ini.php
    ?>
    <title>Document</title> <!-- Título de la página: cambiar por ejemplo a "Detalles de Película" -->
</head>
<body>
    <?php
        $album = new Album($_GET['cod'],'','','','','',''); // Crea un objeto de tipo Album usando el código pasado por URL: cambiar clase y parámetros según el tema
        datosDisco($album); // Función que muestra los datos del disco: cambiar por ejemplo a datosPelicula($pelicula)
    ?>
</body>
</html>