<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include("cabecera.inc.php") ?>
    <main>
    <form method="post" action="registro.php">

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    <br>
    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <label for="confirmPassword">Confirmar Contraseña:</label>
    <input type="password" id="confirmPassword" name="confirmPassword" required>
    <br>
    <label for="nombreUsu">Nombre de Usuario:</label>
    <input type="text" id="nombreUsu" name="nombreUsu" required>
    <br>
    <label for="fechaNac">Fecha de Nacimiento:</label>
    <input type="date" id="fechaNac" name="fechaNac" required>
    <br>
    <label for="genero">Género:</label>
    <select id="genero" name="genero" required>
        <option value="">Seleccione</option>
        <option value="masculino">Masculino</option>
        <option value="femenino">Femenino</option>
        <option value="otro">Otro</option>
    <br>
    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono">
    <br>
    
    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion">
    <br>
    
    <label for="fecha">Fecha de recogida:</label>
    <input type="date" id="fecha" name="fecha">
    
    <br>
    <label>
    <input type="checkbox" name="suscripcion" value="Sí">
    Deseo suscribirme al boletín
    </label>
    <br>
    
    <button type="submit">Enviar</button>
    </form>
    <?php include("footer.inc.php") ?>
    </main>
</body>
</html>