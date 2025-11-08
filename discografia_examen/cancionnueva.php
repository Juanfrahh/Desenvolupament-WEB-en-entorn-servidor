<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
        // Incluimos los archivos necesarios para usar las funciones y clases del proyecto
        include("datos.ini.php");      // Contiene las funciones para mostrar formularios y listar discos/canciones
        include("conexion.ini.php");   // Contiene la clase Conexion para conectarse a la base de datos
        include("cancion.ini.php");    // Contiene la clase Cancion con sus métodos (como registrarCancion)
    ?>
    <title>Document</title> <!-- Título de la página -->
</head>
<body>
    <?php
        // Creamos un objeto Cancion con los datos que vienen por GET
        // $_GET['titulo'] -> el título del álbum o canción
        // $_GET['cod'] -> código del álbum
        // Los demás campos se dejan vacíos porque se completarán en el formulario
        $cancion = new Cancion($_GET['titulo'], $_GET['cod'], '', '', '');

        // Llamamos a la función que genera el formulario para registrar una nueva canción
        // Esta función imprime el formulario HTML y, si se envía, registra la canción en la BD
        formularioCancion($cancion);
    ?>
</body>
</html>
