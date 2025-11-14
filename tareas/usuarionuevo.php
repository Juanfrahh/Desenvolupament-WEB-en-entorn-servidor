<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Codificación UTF-8 -->
    <?php
        include("datos.ini.php");   // Funciones de formularios y consultas
        include("conexion.ini.php"); // Conexión a BD
    ?>
    <title>Document</title>
</head>
<body>
    <?php
        formularioDisco(); // Muestra el formulario para registrar un disco nuevo
        // Para Pokémon: reemplazar por formularioPokemon()
    ?>
</body>
</html>
