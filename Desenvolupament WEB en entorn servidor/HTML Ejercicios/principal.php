<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
    <h1>Hola, soy Carlos <h1>
  </header>
    <p>Desarrollador Web Fullstack</p>
  <section>
    <h3>Sobre mí</h3>
    <p>Me dedico a crear aplicaciones web.</p>
    <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="Foto de perfil" />
  </section>

  <a href="tecnologias.php"><button>tecnologias</button></a>
  <a href="rrss.php"><button>Redes Sociales</button></a>

  <footer>
    <h4>Contacto:</h4>
    <p><a href="carlostortosa2005@gmail.com">Email: carlostortosa2005@gmail.com</a></p>
  </footer>

  <form>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono">
    <br>
    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion">
    <br>
    <input type="submit" value="Enviar">
  </form>

  <?php include("cabecera.inc.php"); ?>
  
</body>
</html>