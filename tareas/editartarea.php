<?php
require_once '../config/config.php';
require_once '../classes/Tarea.php';

protegerPagina();

$tareaObj = new Tarea();
$id = $_GET['id'] ?? null;

if(!$id) {
    header('Location: index.php');
    exit;
}

$tareas = $tareaObj->listarTareas();
$tarea = null;
foreach($tareas as $t) {
    if($t['id'] == $id) {
        $tarea = $t;
        break;
    }
}
if(!$tarea) {
    header('Location: index.php');
    exit;
}

$mensaje = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = limpiarEntrada($_POST['nombre']);
    $descripcion = limpiarEntrada($_POST['descripcion']);
    $completada = isset($_POST['completada']) ? 1 : 0;

    if($tareaObj->editarTarea($id, $nombre, $descripcion, $_SESSION['usuario_id'], $completada)){
        $mensaje = "Tarea actualizada correctamente.";
        $tarea['nombre'] = $nombre;
        $tarea['descripcion'] = $descripcion;
        $tarea['completada'] = $completada;
    } else {
        $mensaje = "Error al actualizar tarea.";
    }
}

include 'header.php';
?>

<h2>Editar Tarea</h2>
<form method="POST">
    <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($tarea['nombre']) ?>" required></label><br>
    <label>Descripción: <textarea name="descripcion" required><?= htmlspecialchars($tarea['descripcion']) ?></textarea></label><br>
    <label>Completada: <input type="checkbox" name="completada" <?= $tarea['completada'] ? 'checked' : '' ?>></label><br>
    <button type="submit">Actualizar</button>
</form>
<p style="color:green;"><?= $mensaje ?></p>
