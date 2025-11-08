<?php
// Función que imprime un formulario para crear un nuevo disco y registra el disco si se envía el formulario
function formularioDisco(){ 
    echo '<button  onclick=location.href="./index.php">Volver</button>'; // Botón para volver a la página principal
    echo '<h1>Crear nuevo disco</h1>'; // Título del formulario
    echo '<form action="disconuevo.php" method="post">'; // Formulario que envía los datos a disconuevo.php
    echo '<input type="text" required name="titulo" placeholder="Título"/>'; // Campo para el título del disco
    echo '<input type="text" required name="discografia" placeholder="Discografía"/>'; // Campo para el nombre de la discográfica
    echo '<label>formato: </label>';
    echo '<select name="formato">
        <option> vinilo</option>
        <option> cd</option>
        <option> dvd</option>
        <option> mp3</option>
        </select>'; // Selección de formato del disco
    echo '<label>fechaLanzamiento: </label>';
    echo '<input type="date" name="fechaLanzamiento"/>'; // Fecha de lanzamiento del disco
    echo '<label>fechaCompra: </label>';
    echo '<input type="date" name="fechaCompra"/>'; // Fecha de compra del disco
    echo '<input type="number" step="  " min=0 value=0 name="precio" placeholder="precio"/>'; // Precio del disco
    echo '<input id="reg-mod" type="submit" value="Registrar"/>'; // Botón para enviar el formulario
    echo '</form>';

    // Si se envió el formulario, se crea un objeto Album y se registra en la base de datos
    if(isset($_POST["titulo"])){
        $conectar = new Conexion('localhost','user','user','discografia'); // Conexión a la base de datos 'discografia'
        $conexion = $conectar->conectionPDO();
        $album = new Album(
            '', // Código vacío, lo genera la BD
            $_POST['titulo'], 
            $_POST['discografia'], 
            $_POST['formato'], 
            $_POST['fechaLanzamiento'], 
            $_POST['fechaCompra'], 
            $_POST['precio']
        );

        $album->registrarDisco($conexion); // Método para registrar el disco en la BD
    }
}

// Función que imprime un formulario para crear una nueva canción y la registra
function formularioCancion($cancion){ 
    echo '<button  onclick=location.href="./index.php">Volver</button>'; // Botón de regreso
    echo '<h1>Crear nueva canción</h1>'; // Título del formulario
    // Formulario que envía datos a cancionnueva.php, pasando cod y título del álbum
    echo '<form action="cancionnueva.php?cod='.$cancion->getAlbum().'&titulo='.$cancion->getTitulo().'" method="post">';
    echo '<input type="text" required name="titulo" placeholder="Título" />'; // Nombre de la canción
    echo '<label>Album: </label>';
    echo '<input type="text" required name="album" value="'.$cancion->getTitulo().'" readonly/>'; // Nombre del álbum (solo lectura)
    echo '<label>Posición: </label>';
    echo '<input type="number" min=0 name="posicion" value=0 />'; // Posición de la canción en el álbum
    echo '<label>Duración: </label>';
    echo '<input type="time" name="duracion" step="1"/>'; // Duración de la canción
    echo '<label>Género: </label>';
    echo '<select name="genero">
        <option> Acustica</option>
        <option> BSO</option>
        <option> Blues</option>
        <option> Folk</option>
        <option> Jazz</option>
        <option> New age</option>
        <option> Pop</option>
        <option> Rock</option>
        <option> Electronica</option>
        </select>'; // Género de la canción
    echo '<input id="reg-mod" type="submit" value="Registrar"/>'; // Botón para enviar
    echo '</form>';

    // Si se envió el formulario, crea un objeto Cancion y lo registra
    if(isset($_POST["titulo"])){
        $conectar = new Conexion('localhost','user','user','discografia'); // BD
        $conexion = $conectar->conectionPDO();
        $cancion = new Cancion($_POST['titulo'], $cancion->getAlbum(), $_POST['posicion'], $_POST['duracion'], $_POST['genero']);
        $cancion->registrarCancion($conexion); // Registrar canción en la BD
    }
}

// Función que imprime un formulario de búsqueda de canciones
function formularioBuscarCancion(){ 
    echo '<button  onclick=location.href="./index.php">Volver</button>'; // Botón de regreso
    echo '<h1>Búsqueda de canciones</h1>'; // Título
    echo '<form action="canciones.php" method="post">';
    echo 'Texto a buscar: ';
    echo '<input type="text" required name="textoBuscar"/>'; // Texto que se va a buscar
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
        <option> Acustica</option>
        <option> BSO</option>
        <option> Blues</option>
        <option> Folk</option>
        <option> Jazz</option>
        <option> New age</option>
        <option> Pop</option>
        <option> Rock</option>
        <option> Electronica</option>
        </select>'; // Filtro por género
    echo '</div>';
    echo '<input id="reg-mod" type="submit" value="Buscar"/>'; // Botón buscar
    echo '</form>';

    // Llama a la función que devuelve los resultados si se envió el formulario
    if(isset($_POST["textoBuscar"])){
        datosBuscados($_POST['textoBuscar'], $_POST['select'], $_POST['genero']); 
    }
}
// Función que devuelve una lista de todos los discos (albums)
function datosDiscografia(){ 
    $conectar = new Conexion('localhost','user','user','discografia'); // Conexión a BD
    $conexion = $conectar->conectionPDO();
    $resultado = $conexion->query('SELECT cod,titulo,discografia,formato,fechaLanzamiento,fechaCompra,precio FROM discografia.album;'); // Consulta de discos
    echo '<button  onclick=location.href="./disconuevo.php">Nuevo disco</button>'; // Botón nuevo disco
    echo '<button  onclick=location.href="./canciones.php">Buscar canciones</button>'; // Botón buscar canciones
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
        $album = new Album($registro['cod'],$registro['titulo'],$registro['discografia'],$registro['formato'],$registro['fechaLanzamiento'],$registro['fechaCompra'],$registro['precio']); 
        echo '<tr>';
        echo '<td><a href="disco.php?cod='.$album->getCod().'">'.$album->getTitulo().'</a></td>'; // Enlace a detalle del disco
        echo '<td>'.$album->getDiscografia().'</td>';
        echo '<td>'.$album->getFormato().'</td>';
        echo '<td>'.$album->getFechaL().'</td>';
        echo '<td>'.$album->getFechaC().'</td>';
        echo '<td>'.$album->getPrecio().'</td>';
        echo '<th id="botonInsertar"><button onclick=location.href="./cancionnueva.php?cod='.$registro['cod'].'&titulo='.$registro['titulo'].'">Canción Nueva</button></th>'; // Botón agregar canción
        echo '</tr>';
    }
    echo '</table>';
}
// Función que devuelve los datos de un disco específico y sus canciones
function datosDisco($album){ 
    $conectar = new Conexion('localhost','user','user','discografia'); 
    $conexion = $conectar->conectionPDO();
    $resultado = $conexion->query('SELECT count(titulo) as totalCanciones FROM discografia.cancion WHERE cancion.album = '.$album->getCod().';'); 
    while ($registro = $resultado->fetch()) { 
        $TC = $registro['totalCanciones']; // Total de canciones del disco
    }
    $resultado = $conexion->query('SELECT cod,titulo,discografia,formato,fechaLanzamiento,fechaCompra,precio FROM discografia.album WHERE album.cod = '.$album->getCod().';');
    echo '<button  onclick=location.href="./index.php">Volver</button>'; // Botón volver
    echo '<h1>DATOS DEL DISCO</h1>'; // Título
    echo '<table>';
    echo '<tr>
        <th>Código</th>
        <th>título</th>
        <th>Discografía</th>
        <th>formato</th>
        <th>fechaLanzamiento</th>
        <th>fechaCompra</th>
        <th>Precio</th>			
    </tr>';
    while ($registro = $resultado->fetch()) { 
        $listaAlbum = new Album($registro['cod'],$registro['titulo'],$registro['discografia'],$registro['formato'],$registro['fechaLanzamiento'],$registro['fechaCompra'],$registro['precio']);
        echo '<tr>';
        echo '<td>'.$listaAlbum->getCod().'</td>';
        echo '<td>'.$listaAlbum->getTitulo().'</td>';
        echo '<td>'.$listaAlbum->getDiscografia().'</td>';
        echo '<td>'.$listaAlbum->getFormato().'</td>';
        echo '<td>'.$listaAlbum->getFechaL().'</td>';
        echo '<td>'.$listaAlbum->getFechaC().'</td>';
        echo '<td>'.$listaAlbum->getPrecio().'</td>';
        echo '<th id="botonBorrar"><button onclick=location.href="./borrardisco.php?cod='.$listaAlbum->getCod().'&TC='.$TC.'">Borrar disco</button></th>'; // Botón borrar disco
        echo '</tr>';
    }
    echo '</table>';

    datosCancion($album->getCod()); // Llama a función para mostrar las canciones del disco
}
// Función que devuelve los datos de todas las canciones de un disco
function datosCancion($cod){ 
    $conectar = new Conexion('localhost','user','user','discografia');
    $conexion = $conectar->conectionPDO();
    $resultado = $conexion->query('SELECT * FROM discografia.cancion WHERE album = '.$cod.';'); 
    echo '<h3>CANCIONES DEL DISCO</h3>'; 
    echo '<table>';
    echo '<tr>
        <th>título</th>
        <th>Album</th>
        <th>posicion</th>
        <th>duracion</th>
        <th>genero</th>			
    </tr>';
    while ($registro = $resultado->fetch()) { 
        $listaCanciones = new Cancion($registro['titulo'],$registro['album'],$registro['posicion'],$registro['duracion'],$registro['genero']);
        echo '<tr>';
        echo '<td>'.$listaCanciones->getTitulo().'</td>';
        echo '<td>'.$listaCanciones->getAlbum().'</td>';
        echo '<td>'.$listaCanciones->getPosicion().'</td>';
        echo '<td>'.$listaCanciones->getDuracion().'</td>';
        echo '<td>'.$listaCanciones->getGenero().'</td>';
        echo '</tr>';
    }
    echo '</table>';
}
// Función que busca canciones según los parámetros introducidos por el usuario
function datosBuscados($textoBuscar, $select, $genero){ 
    $conectar = new Conexion('localhost','user','user','discografia');
    $conexion = $conectar->conectionPDO();
    $resultado1 = $conexion->query('SELECT count(cancion.titulo) as cont FROM discografia.cancion,discografia.album WHERE album.cod = cancion.album and cancion.genero = "'.$genero.'" and '.$select.' LIKE "%'.$textoBuscar.'%";');
    
    $contar = $resultado1->fetch();
    if($contar['cont'] > 0) {
        $resultado2 = $conexion->query('SELECT cancion.titulo as titulo ,album.titulo as album, cancion.posicion, cancion.duracion, cancion.genero FROM discografia.cancion,discografia.album WHERE album.cod = cancion.album and cancion.genero = "'.$genero.'" and '.$select.' LIKE "%'.$textoBuscar.'%";');
        echo '<table>';
        echo '<tr>
            <th>título</th>
            <th>Album</th>
            <th>posicion</th>
            <th>duracion</th>
            <th>genero</th>			
        </tr>';
        while ($registro = $resultado2->fetch()) { 
            $Canciones = new Cancion($registro['titulo'],$registro['album'],$registro['posicion'],$registro['duracion'],$registro['genero']);
            echo '<tr>';
            echo '<td>'.$Canciones->getTitulo().'</td>';
            echo '<td>'.$Canciones->getAlbum().'</td>';
            echo '<td>'.$Canciones->getPosicion().'</td>';
            echo '<td>'.$Canciones->getDuracion().'</td>';
            echo '<td>'.$Canciones->getGenero().'</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<h1>NO SE ENCONTRARON RESULTADOS!</h1>'; // Mensaje si no se encuentran resultados
    }
}
?>
