
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Define codificación UTF-8 para caracteres especiales -->
    <title>Document</title> <!-- Título de la pestaña del navegador -->
    <link rel="stylesheet" href="css/estilo.css"/> <!-- Vincula hoja de estilos CSS -->
    <?php
        include("datos.ini.php");   // Incluye funciones de datos (formularios, consultas)
        include("conexion.ini.php"); // Incluye clase de conexión a BD
        include("album.ini.php");    // Incluye la clase Album para manejar objetos álbum
    ?>
</head>
<body>
    <?php
        datosDiscografia(); // Llama a la función que muestra la lista de álbumes/discos
        // Para otra base de datos (Pokémon): reemplazar por datosPokemon()
    ?>
</body>
</html>
