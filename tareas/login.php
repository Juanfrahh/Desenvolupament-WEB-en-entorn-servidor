<?php
require_once '../config/config.php';
require_once '../classes/Tarea.php';

protegerPagina();

$tarea = new Tarea();
$tareas = $tarea->listarTareas();
include '../includes/header.php';
?>

<h2>Lista de Tareas</h2>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Creada por</th>
            <th>Modificada por</th>
            <th>Completada por</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tareas as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t['nombre']) ?></td>
            <td><?= htmlspecialchars($t['descripcion']) ?></td>
            <td><?= htmlspecialchars($t['creador']) ?></td>
            <td><?= htmlspecialchars($t['modificador']) ?></td>
            <td><?= htmlspecialchars($t['completador']) ?></td>
            <td><?= $t['completada'] ? 'Completada' : 'Pendiente' ?></td>
            <td>
                <?php if(!$t['completada']): ?>
                    <a href="edit_tarea.php?id=<?= $t['id'] ?>">Editar</a> |
                    <a href="delete_tarea.php?id=<?= $t['id'] ?>" onclick="return confirm('¿Eliminar tarea?')">Eliminar</a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
