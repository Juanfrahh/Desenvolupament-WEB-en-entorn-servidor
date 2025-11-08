<?php
function formularioDisco(){ // Función que imprime un formulario para registrar un nuevo disco
    echo '<button onclick=location.href="./index.php">Volver</button>'; // Botón de regreso
    echo '<h1>Crear nuevo disco</h1>'; // Título del formulario
    echo '<form action="disconuevo.php" method="post">'; // Formulario que envía los datos a disconuevo.php
    echo '<input type="text" required name="titulo" placeholder="Título"/>'; // Campo título del disco
    echo '<input type="text" required name="discografia" placeholder="Discografía"/>'; // Campo discografía
    echo '<label>formato: </label>';
    echo '<select name="formato">
        <option>vinilo</option>
        <option>cd</option>
        <option>dvd</option>
        <option>mp3</option>
        </select>'; // Selección de formato
    echo '<label>fechaLanzamiento: </label>';
    echo '<input type="date" name="fechaLanzamiento"/>'; // Fecha de lanzamiento
    echo '<label>fechaCompra: </label>';
    echo '<input type="date" name="fechaCompra"/>'; // Fecha de compra
    echo '<input type="number" step=" " min=0 value=0 name="precio" placeholder="precio"/>'; // Precio
    echo '<input id="reg-mod" type="submit" value="Registrar"/>'; // Botón de enviar formulario
    echo '</form>';

    // Procesa el formulario si se envió
    if(isset($_POST["titulo"])){
        $conectar = new Conexion('localhost','user','user','discografia'); // Conexión a la base de datos: cambiar nombre de BD si es otro tema
        $conexion = $conectar->conectionPDO();
        $album = new Album('', $_POST['titulo'], $_POST['discografia'], $_POST['formato'], $_POST['fechaLanzamiento'], $_POST['fechaCompra'], $_POST['precio']); // Crear objeto Album
        $album->registrarDisco($conexion); // Llama al método para registrar el disco en la BD
    }
}

function formularioCancion($cancion){ // Función que imprime un formulario para registrar una canción nueva
    echo '<button onclick=location.href="./index.php">Volver</button>'; // Botón de regreso
    echo '<h1>Crear nueva canción</h1>'; // Título del formulario
    echo '<form action="cancionnueva.php?cod='.$cancion->getAlbum().'&titulo='.$cancion->getTitulo().'" method="post">'; // Formulario con referencia al álbum
    echo '<input type="text" required name="titulo" placeholder="Título" />'; // Título de la canción
    echo '<label>Album: </label>';
    echo '<input type="text" required name="album" value="'.$cancion->getTitulo().'" readonly/>'; // Nombre del álbum (solo lectura)
    echo '<label>Posición: </label>';
    echo '<input type="number" min=0 name="posicion" value=0 />'; // Posición de la canción en el álbum
    echo '<label>Duración: </label>';
    echo '<input type="time" name="duracion" step="1"/>'; // Duración de la canción
    echo '<label>Género: </label>';
    echo '<select name="genero">
        <option>Acustica</option>
        <option>BSO</option>
        <option>Blues</option>
        <option>Folk</option>
        <option>Jazz</option>
        <option>New age</option>
        <option>Pop</option>
        <option>Rock</option>
        <option>Electronica</option>
        </select>'; // Selección de género musical
    echo '<input id="reg-mod" type="submit" value="Registrar"/>';
    echo '</form>';

    // Procesa el formulario si se envió
    if(isset($_POST["titulo"])){
        $conectar = new Conexion('localhost','user','user','discografia'); // Cambiar BD si es otro tema
        $conexion = $conectar->conectionPDO();
        $cancion = new Cancion($_POST['titulo'], $cancion->getAlbum(), $_POST['posicion'], $_POST['duracion'], $_POST['genero']); // Crear objeto Cancion
        $cancion->registrarCancion($conexion); // Registrar en la BD
    }
}

function formularioBuscarCancion(){ // Función que imprime un formulario para buscar canciones
    echo '<button onclick=location.href="./index.php">Volver</button>';
    echo '<h1>Búsqueda de canciones</h1>';
    echo '<form action="canciones.php" method="post">';
    echo 'Texto a buscar: ';
    echo '<input type="text" required name="textoBuscar"/>'; // Campo de búsqueda
    echo '<div>';
    echo 'Buscar en: ';
    echo '<input type="radio" id=tc name="select" checked value="cancion.titulo"/>'; 
    echo '<label for="tc">Títulos de canción </label>';
    echo '<input type="radio" id="na" name="select" value="album.titulo"/>';
    echo '<label for="na">Nombres álbum </label>';
    echo '<input type="radio" id="ca" name="select" value="album.titulo = cancion.titulo and cancion.titulo"/>';
    echo '<label for="ca">Ambos campos </label>';
    echo '</div>';
    echo '<div>';
    echo 'Genero musical: ';
    echo '<select name="genero">
        <option>Acustica</option>
        <option>BSO</option>
        <option>Blues</option>
        <option>Folk</option>
        <option>Jazz</option>
        <option>New age</option>
        <option>Pop</option>
        <option>Rock</option>
        <option>Electronica</option>
        </select>';
    echo '</div>';
    echo '<input id="reg-mod" type="submit" value="Buscar"/>';
    echo '</form>';

    if(isset($_POST["textoBuscar"])){
        datosBuscados($_POST['textoBuscar'], $_POST['select'], $_POST['genero']); // Llama a la función que realiza la búsqueda
    }
}

function datosDiscografia(){ // Función que devuelve una lista de discos (albums)
    $conectar = new Conexion('localhost','user','user','discografia'); // Conexión a BD
    $conexion = $conectar->conectionPDO();
    $resultado = $conexion->query('SELECT cod,titulo,discografia,formato,fechaLanzamiento,fechaCompra,precio FROM discografia.album;'); // Consulta de discos
    echo '<button onclick=location.href="./disconuevo.php">Nuevo disco</button>'; 
    echo '<button onclick=location.href="./canciones.php">Buscar canciones</button>';
    echo '<table>';
    echo '<tr>
        <th>título</th>
        <th>Discografía</th>
        <th>formato</th>
        <th>fechaLanzamiento</th>
        <th>fechaCompra</th>
        <th>Precio</th>			
    </tr>';
    while ($registro = $resultado->fetch()) { // Recorre cada disco
        $album = new Album($registro['cod'], $registro['titulo'], $registro['discografia'], $registro['formato'], $registro['fechaLanzamiento'], $registro['fechaCompra'], $registro['precio']); 
        echo '<tr>';
        echo '<td><a href="disco.php?cod='.$album->getCod().'">'.$album->getTitulo().'</a></td>';
        echo '<td>'.$album->getDiscografia().'</td>';
        echo '<td>'.$album->getFormato().'</td>';
        echo '<td>'.$album->getFechaL().'</td>';
        echo '<td>'.$album->getFechaC().'</td>';
        echo '<td>'.$album->getPrecio().'</td>';
        echo '<th id="botonInsertar"><button onclick=location.href="./cancionnueva.php?cod='.$registro['cod'].'&titulo='.$registro['titulo'].'">Canción Nueva</button></th>';
        echo '</tr>';
    }
    echo '</table>';
}

// Las demás funciones como datosDisco(), datosCancion(), datosBuscados() siguen la misma lógica:
// - Conectarse a la BD
// - Ejecutar consultas
// - Crear objetos (Album, Cancion) para manejar los datos
// - Imprimir resultados en tablas HTML
// Para otro tema, cambiar:
//   - Clases (Album → Pelicula, Cancion → Escena)
//   - Tablas de la BD
//   - Campos en los formularios y en las consultas
?>
