<?php
require_once 'config.php';
require_once 'Tarea.php';

protegerPagina();
$tarea = new Tarea();
$tareas = $tarea->listarTareas();

include 'header.php';
?>
<h2>Lista de Tareas</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Creada por</th>
            <th>Modificada por</th>
            <th>Completada por</th>
            <th>Creación</th>
            <th>Modificación</th>
            <th>Finalización</th>
            <th>Completada</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tareas as $t): ?>
        <tr>
            <td><?php echo $t['id']; ?></td>
            <td><?php echo $t['nombre']; ?></td>
            <td><?php echo $t['descripcion']; ?></td>
            <td><?php echo $t['creador']; ?></td>
            <td><?php echo $t['modificador']; ?></td>
            <td><?php echo $t['completador']; ?></td>
            <td><?php echo $t['fecha_creacion']; ?></td>
            <td><?php echo $t['fecha_modificacion']; ?></td>
            <td><?php echo $t['fecha_finalizacion']; ?></td>
            <td><?php echo $t['completada'] ? 'Sí' : 'No'; ?></td>
            <td>
                <?php if(!$t['completada']): ?>
                    <a href="editartarea.php?id=<?php echo $t['id']; ?>">Editar</a> |
                    <a href="delete_tarea.php?id=<?php echo $t['id']; ?>" onclick="return confirm('¿Seguro que quieres eliminar esta tarea?');">Eliminar</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
