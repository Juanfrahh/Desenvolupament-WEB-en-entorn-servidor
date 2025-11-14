<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Tarea.php';

protegerPagina();

$tObj = new Tarea();
$tareas = $tObj->listarTareas();
include __DIR__ . '/header.php';
?>
<h2>Lista de tareas</h2>

<?php if($msg = flash('mensaje')): ?>
    <p style="color:green;"><?= $msg ?></p>
<?php endif; ?>

<table>
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
    <?php if(empty($tareas)): ?>
        <tr><td colspan="7">No hay tareas.</td></tr>
    <?php else: ?>
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
                    <a href="editartarea.php?id=<?= $t['id'] ?>">Editar</a> |
                    <a href="delete_tarea.php?id=<?= $t['id'] ?>" onclick="return confirm('Eliminar tarea?')">Eliminar</a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
