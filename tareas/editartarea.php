<?php
require_once 'config.php';
require_once 'Tarea.php';

protegerPagina();
$tarea = new Tarea();
$mensaje = '';
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$t = $tarea->getTareaById($id);
if (!$t) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $descripcion = limpiarEntrada($_POST['descripcion'] ?? '');
    $completada = isset($_POST['completada']) ? 1 : 0;

    if ($tarea->editarTarea($id, $nombre, $descripcion, $_SESSION['usuario_id'], $completada)) {
        $mensaje = "Tarea actualizada correctamente.";
        $t = $tarea->getTareaById($id); // refrescar datos
    } else {
        $mensaje = "Error al actualizar tarea.";
    }
}

include 'header.php';
?>
<h2>Editar Tarea</h2>
<form method="post">
    <label>Nombre: <input type="text" name="nombre" value="<?php echo $t['nombre']; ?>" required></label><br><br>
    <label>Descripción: <textarea name="descripcion" required><?php echo $t['descripcion']; ?></textarea></label><br><br>
    <label>Completada: <input type="checkbox" name="completada" <?php echo $t['completada'] ? 'checked' : ''; ?>></label><br><br>
    <button type="submit">Guardar cambios</button>
</form>
<?php if($mensaje): ?><p style="color:green;"><?php echo $mensaje; ?></p><?php endif; ?>
