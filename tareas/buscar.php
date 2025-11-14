<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/tarea.php';

protegerPagina();
$tObj = new Tarea();
$resultados = [];
$ultimas = $tObj->ultimasCincoAcciones();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $termino = limpiarEntrada($_POST['termino'] ?? '');
    if ($termino !== '') {
        $resultados = $tObj->buscarTareas($termino, 100);
    }
}

include __DIR__ . '/header.php';
?>
<h2>Buscar tareas</h2>
<form method="post">
    <input type="text" name="termino" required placeholder="Nombre o descripción">
    <button type="submit">Buscar</button>
</form>

<?php if(!empty($resultados)): ?>
    <h3>Resultados</h3>
    <table>
        <thead><tr><th>Nombre</th><th>Descripción</th><th>Estado</th><th>Usuario acción</th></tr></thead>
        <tbody>
            <?php foreach($resultados as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['nombre']) ?></td>
                    <td><?= htmlspecialchars($r['descripcion']) ?></td>
                    <td><?= $r['completada'] ? 'Completada' : 'Pendiente' ?></td>
                    <td>
                        <?= $r['completada'] ? htmlspecialchars($r['completador']) : ( $r['fecha_modificacion'] ? htmlspecialchars($r['modificador']) : htmlspecialchars($r['creador']) ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<h3>Últimas 5 acciones</h3>
<?php if(empty($ultimas)): ?>
    <p>No hay acciones todavía.</p>
<?php else: ?>
    <ul>
    <?php foreach($ultimas as $u): ?>
        <li>
            <?= htmlspecialchars($u['nombre']) ?> —
            <?php
                if ($u['fecha_finalizacion']) echo "completada por " . htmlspecialchars($u['completador']);
                else if ($u['fecha_modificacion']) echo "modificada por " . htmlspecialchars($u['modificador']);
                else echo "añadida por " . htmlspecialchars($u['creador']);
            ?>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
