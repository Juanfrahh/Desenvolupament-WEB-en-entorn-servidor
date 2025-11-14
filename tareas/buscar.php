<?php
require_once 'config.php';
require_once 'Tarea.php';

protegerPagina();
$tarea = new Tarea();
$termino = $_GET['q'] ?? '';
$resultados = $termino ? $tarea->buscarTareas($termino) : [];
$ultimas = $tarea->ultimasCincoAcciones();

include 'header.php';
?>
<h2>Buscar Tareas</h2>
<form method="get">
    <input type="text" name="q" value="<?php echo htmlspecialchars($termino); ?>" placeholder="Buscar por nombre o descripción">
    <button type="submit">Buscar</button>
</form>

<?php if($termino): ?>
<h3>Resultados</h3>
<?php if($resultados): ?>
<table>
    <thead>
        <tr>
            <th>ID</th><th>Nombre</th><th>Descripción</th><th>Creada por</th><th>Modificada por</th><th>Completada por</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultados as $t): ?>
        <tr>
            <td><?php echo $t['id']; ?></td>
            <td><?php echo $t['nombre']; ?></td>
            <td><?php echo $t['descripcion']; ?></td>
            <td><?php echo $t['creador']; ?></td>
            <td><?php echo $t['modificador']; ?></td>
            <td><?php echo $t['completador']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>No se encontraron tareas.</p>
<?php endif; ?>
<?php endif; ?>

<h3>Últimas 5 acciones</h3>
<table>
    <thead>
        <tr>
            <th>ID</th><th>Nombre</th><th>Acción más reciente</th><th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ultimas as $t): ?>
        <tr>
            <td><?php echo $t['id']; ?></td>
            <td><?php echo $t['nombre']; ?></td>
            <td>
                <?php
                if ($t['fecha_finalizacion']) echo "Completada: ".$t['fecha_finalizacion'];
                elseif ($t['fecha_modificacion']) echo "Modificada: ".$t['fecha_modificacion'];
                else echo "Creada: ".$t['fecha_creacion'];
                ?>
            </td>
            <td>
                <?php
                if ($t['fecha_finalizacion']) echo $t['completador'];
                elseif ($t['fecha_modificacion']) echo $t['modificador'];
                else echo $t['creador'];
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
