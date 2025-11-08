<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres -->
    <?php
        include("datos.ini.php");     // Archivo con funciones o datos generales: cambiar por ejemplo a datosPeliculas.ini.php
        include("conexion.ini.php");  // Conexión a la base de datos: normalmente no se cambia
        include("album.ini.php");     // Archivo con funciones específicas de discos: cambiar por ejemplo a peliculas.ini.php
    ?>
    <title>Document</title> <!-- Título de la página: cambiar por ejemplo a "Formulario de Películas" -->
</head>
<body>
    <?php
        formularioDisco(); // Función que genera el formulario de discos: cambiar por ejemplo a formularioPeliculas()
    ?>
</body>
</html>