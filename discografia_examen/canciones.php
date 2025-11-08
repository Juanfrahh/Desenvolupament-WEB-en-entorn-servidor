<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
        // Incluimos los archivos necesarios para usar funciones y clases del proyecto
        include("datos.ini.php");      // Contiene funciones para formularios y listados de discos/canciones
        include("conexion.ini.php");   // Contiene la clase Conexion para conectarse a la base de datos
        include("cancion.ini.php");    // Contiene la clase Cancion con sus métodos
    ?>
    <title>Document</title> <!-- Título de la página -->
</head>
<body>
    <?php
        // Llamamos a la función que genera el formulario de búsqueda de canciones
        // Esta función imprime el formulario HTML y, si se envía, llama a datosBuscados() para mostrar resultados
        formularioBuscarCancion();
    ?>
</body>
</html>
