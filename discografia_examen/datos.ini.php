<?php
// Función que muestra el formulario para crear un disco nuevo y registra el disco en la base de datos
function formularioUser(){ 
    echo '<button  onclick=location.href="./index.php">Volver</button>'; // Botón para volver al listado de discos
    echo '<h1>Crear nuevo disco</h1>'; // Título del formulario
    echo '<form action="usuario.php" method="post">'; // Formulario HTML, método POST
    echo '<input type="text" required name="titulo" placeholder="Título"/>'; // Campo título
    echo '<input type="text" required name="tareas" placeholder="Tareas"/>'; // Campo discografía
    echo '<label>formato: </label>';
    echo '<select name="formato">
        <option> vinilo</option>
        <option> cd</option>
        <option> dvd</option>
        <option> mp3</option>
    </select>'; // Selector de formato del disco
    echo '<label>fechaLanzamiento: </label>';
    echo '<input type="date" name="fechaLanzamiento"/>'; // Campo fecha de lanzamiento
    echo '<label>fechaCompra: </label>';
    echo '<input type="date" name="fechaCompra"/>'; // Campo fecha de compra
    echo '<input type="number" step="  " min=0 value=0 name="precio" placeholder="precio"/>'; // Campo precio
    echo '<input id="reg-mod" type="submit" value="Registrar"/>'; // Botón de enviar formulario
    echo '</form>';

    // Si se envió el formulario, procesamos los datos
    if(isset($_POST["titulo"])){
        $conectar = new Conexion('localhost','root','', 'tareas');
        $conexion = $conectar->conectionPDO(); // Obtener conexión PDO
        $album = new Album('',$_POST['titulo'],$_POST['discografia'],$_POST['formato'],$_POST['fechaLanzamiento'],$_POST['fechaCompra'],$_POST['precio']);
        $album->registrarDisco($conexion); // Registrar disco en la base de datos
        // USO: Para otra base de datos (Pokémon), cambiar Album por Pokemon y los campos
    }
}

// Función que muestra un formulario para crear una canción nueva y la registra
function formularioCancion($cancion){ 
    echo '<button  onclick=location.href="./index.php">Volver</button>'; // Botón volver
    echo '<h1>Crear nueva canción</h1>'; // Título formulario
    echo '<form action="cancionnueva.php?cod='.$cancion->getAlbum().'&titulo='.$cancion->getTitulo().'" method="post">'; // Formulario POST con parámetros
    echo '<input type="text" required name="titulo" placeholder="Título" />'; // Campo título canción
    echo '<label>Album: </label>';
    echo '<input type="text" required name="album" value="'.$cancion->getTitulo().'" readonly/>'; // Campo album, solo lectura
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
    </select>'; // Selector de género musical
    echo '<input id="reg-mod" type="submit" value="Registrar"/>'; // Botón registrar
    echo '</form>';

    // Si se envió el formulario
    if(isset($_POST["titulo"])){
        $conectar = new Conexion('localhost','user','user','discografia'); // Conexión
        $conexion = $conectar->conectionPDO(); // Obtener PDO
        $cancion = new Cancion($_POST['titulo'],$cancion->getAlbum(),$_POST['posicion'],$_POST['duracion'],$_POST['genero']);
        $cancion->registrarCancion($conexion); // Registrar canción en BD
        // USO: Para Pokémon, cambiar Cancion por Habilidad o Movimiento
    }
}

// Función que muestra un formulario para buscar canciones
function formularioBuscarCancion(){ 
    echo '<button  onclick=location.href="./index.php">Volver</button>'; // Botón volver
    echo '<h1>Búsqueda de canciones</h1>'; // Título formulario
    echo '<form action="canciones.php" method="post">';
    echo 'Texto a buscar: <input type="text" required name="textoBuscar"/>'; // Campo texto a buscar
    echo '<div>Buscar en: ';
    echo '<input type="radio" id=tc name="select" checked value="cancion.titulo"/>';
    echo '<label for="tc">Títulos de canción </label>';
    echo '<input type="radio" id="na" name="select" value="album.titulo"/>';
    echo '<label for="na">Nombres álbum </label>';
    echo '<input type="radio" id="ca" name="select" value="album.titulo = cancion.titulo and cancion.titulo"/>';
    echo '<label for="ca">Ambos campos </label>';
    echo '</div>';
    echo '<div>Genero musical: ';
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
    </select></div>';
    echo '<input id="reg-mod" type="submit" value="Buscar"/>';
    echo '</form>';

    // Si se envió el formulario, mostrar resultados
    if(isset($_POST["textoBuscar"])){
        datosBuscados($_POST['textoBuscar'],$_POST['select'],$_POST['genero']);
        // USO: Para Pokémon, cambiar a datosBuscadosPokemon() y campos correspondientes
    }
}

// Función que muestra la lista completa de discos
function datosDiscografia(){ 
    $conectar = new Conexion('localhost','user','user','discografia'); // Conexión
    $conexion = $conectar->conectionPDO();
    $resultado = $conexion->query('SELECT cod,titulo,discografia,formato,fechaLanzamiento,fechaCompra,precio FROM discografia.album;'); // Consulta discos

    echo '<button  onclick=location.href="./disconuevo.php">Nuevo disco</button>'; // Botón crear disco
    echo '<button  onclick=location.href="./canciones.php">Buscar canciones</button>'; // Botón buscar canciones
    echo '<table><tr>
        <th>título</th><th>Discografía</th><th>formato</th><th>fechaLanzamiento</th><th>fechaCompra</th><th>Precio</th>
    </tr>';

    while ($registro = $resultado->fetch()) { // Iterar sobre los discos
        $album = new Album($registro['cod'],$registro['titulo'],$registro['discografia'],$registro['formato'],$registro['fechaLanzamiento'],$registro['fechaCompra'],$registro['precio']); 
        echo '<tr>';
        echo '<td><a href="disco.php?cod='.$album->getCod().'">'.$album->getTitulo().'</a></td>'; // Enlace a detalle disco
        echo '<td>'.$album->getDiscografia().'</td>';
        echo '<td>'.$album->getFormato().'</td>';
        echo '<td>'.$album->getFechaL().'</td>';
        echo '<td>'.$album->getFechaC().'</td>';
        echo '<td>'.$album->getPrecio().'</td>';
        echo '<th><button  onclick=location.href="./cancionnueva.php?cod='.$registro['cod'].'&titulo='.$registro['titulo'].'">Canción Nueva</button></th>'; // Botón añadir canción
        echo '</tr>';
    }
    echo '</table>';
    // USO: Para Pokémon, cambiar a datosPokemon() y crear tabla con los campos de Pokémon
}

// Función que muestra datos de un disco y sus canciones
function datosDisco($album){ 
    $conectar = new Conexion('localhost','user','user','discografia'); // Conexión
    $conexion = $conectar->conectionPDO();
    $resultado = $conexion->query('SELECT count(titulo) as totalCanciones FROM discografia.cancion WHERE cancion.album = '.$album->getCod().';'); // Contar canciones

    while ($registro = $resultado->fetch()) {
        $TC = $registro['totalCanciones']; // Guardar total canciones
    }

    $resultado = $conexion->query('SELECT cod,titulo,discografia,formato,fechaLanzamiento,fechaCompra,precio FROM discografia.album WHERE album.cod = '.$album->getCod().';'); // Info disco
    echo '<button  onclick=location.href="./index.php">Volver</button>'; // Botón volver
    echo '<h1>DATOS DEL DISCO</h1>';
    echo '<table><tr>
        <th>Código</th><th>título</th><th>Discografía</th><th>formato</th><th>fechaLanzamiento</th><th>fechaCompra</th><th>Precio</th>
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
        echo '<th><button  onclick=location.href="./borrardisco.php?cod='.$listaAlbum->getCod().'&TC='.$TC.'">Borrar disco</button></th>'; // Botón borrar disco
        echo '</tr>';
    }
    echo '</table>';

    datosCancion($album->getCod()); // Mostrar canciones del disco
    // USO: Para Pokémon, cambiar Album por Pokemon y mostrar movimientos/estadísticas
}

// Función que muestra todas las canciones de un disco
function datosCancion($cod){ 
    $conectar = new Conexion('localhost','user','user','discografia'); // Conexión
    $conexion = $conectar->conectionPDO();
    $resultado = $conexion->query('SELECT * FROM discografia.cancion WHERE album = '.$cod.';'); // Consulta canciones
    echo '<h3>CANCIONES DEL DISCO</h3>';
    echo '<table><tr>
        <th>título</th><th>Album</th><th>posicion</th><th>duracion</th><th>genero</th>
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

// Función que busca canciones según texto, campo y género
function datosBuscados($textoBuscar, $select, $genero){ 
    $conectar = new Conexion('localhost','user','user','discografia'); // Conexión
    $conexion = $conectar->conectionPDO();

    $resultado1 = $conexion->query('SELECT count(cancion.titulo) as cont FROM discografia.cancion,discografia.album WHERE album.cod = cancion.album and cancion.genero = "'.$genero.'" and '.$select.' LIKE "%'.$textoBuscar.'%";'); // Contar resultados

    $contar = $resultado1->fetch();
    if($contar['cont'] > 0) { // Si hay resultados
        $resultado2 = $conexion->query('SELECT cancion.titulo as titulo ,album.titulo as album, cancion.posicion, cancion.duracion, cancion.genero FROM discografia.cancion,discografia.album WHERE album.cod = cancion.album and cancion.genero = "'.$genero.'" and '.$select.' LIKE "%'.$textoBuscar.'%";'); // Consultar resultados
        echo '<table><tr>
            <th>título</th><th>Album</th><th>posicion</th><th>duracion</th><th>genero</th>
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
    }else{
        echo '<h1>NO SE ENCONTRARON RESULTADOS!</h1>'; // Mensaje si no hay resultados
    }
    // USO: Para Pokémon, cambiar Cancion por Habilidad o Movimiento y campos
}
?>
