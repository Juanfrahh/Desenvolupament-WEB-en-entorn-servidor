<?php
require_once 'config.php';
require_once '../classes/Tarea.php';

protegerPagina();

$tareaObj = new Tarea();
$resultados = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $termino = limpiarEntrada($_POST['termino']);
    $resultados = $tareaObj->buscarTareas($termino);
}

include 'header.php';
?>

<h2>Buscar Tareas</h2>
<form method="POST">
    <label>Buscar por nombre o descripción: <input type="text" name="termino" required></label>
    <button type="submit">Buscar</button>
</form>

<?php if($resultados): ?>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Creada por</th>
            <th>Modificada por</th>
            <th>Completada por</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultados as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t['nombre']) ?></td>
            <td><?= htmlspecialchars($t['descripcion']) ?></td>
            <td><?= htmlspecialchars($t['creador']) ?></td>
            <td><?= htmlspecialchars($t['modificador']) ?></td>
            <td><?= htmlspecialchars($t['completador']) ?></td>
            <td><?= $t['completada'] ? 'Completada' : 'Pendiente' ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
