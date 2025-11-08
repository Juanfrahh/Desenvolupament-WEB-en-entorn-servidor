<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- UTF-8 -->
    <?php
        include("datos.ini.php");     // Funciones de datos y formularios
        include("conexion.ini.php");  // Clase Conexion
        include("album.ini.php");     // Clase Album
        include("cancion.ini.php");   // Clase Cancion
    ?>
    <title>Document</title>
</head>
<body>
    <?php
        // Crea un objeto Album con el código pasado por GET
        $album = new Album($_GET['cod'],'','','','','',''); 
        datosDisco($album); // Muestra los datos del álbum y sus canciones
        // Para Pokémon: $pokemon = new Pokemon($_GET['id'], ...); datosPokemonIndividual($pokemon);
    ?>
</body>
</html>
