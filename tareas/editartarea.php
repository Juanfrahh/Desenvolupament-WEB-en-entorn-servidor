<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/tarea.php';

protegerPagina();
$tObj = new Tarea();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
    header('Location: index.php'); exit;
}

$tarea = $tObj->getTareaById($id);
if (!$tarea) {
    header('Location: index.php'); exit;
}

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $descripcion = limpiarEntrada($_POST['descripcion'] ?? '');
    $completada = isset($_POST['completada']) ? 1 : 0;

    if ($tObj->editarTarea($id, $nombre, $descripcion, $_SESSION['usuario_id'], $completada)) {
        flash('mensaje', 'Tarea actualizada.');
        header('Location: index.php'); exit;
    } else {
        $mensaje = "Error al actualizar tarea.";
    }
}

include __DIR__ . '/header.php';
?>
<h2>Editar tarea</h2>
<form method="post">
    <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($tarea['nombre']) ?>" required></label><br><br>
    <label>Descripción:<br><textarea name="descripcion" rows="5" cols="50" required><?= htmlspecialchars($tarea['descripcion']) ?></textarea></label><br><br>
    <label><input type="checkbox" name="completada" <?= $tarea['completada'] ? 'checked' : '' ?>> Marcada como completada</label><br><br>
    <button type="submit">Guardar</button>
</form>
<?php if($mensaje): ?><p style="color:red;"><?= $mensaje ?></p><?php endif; ?>
