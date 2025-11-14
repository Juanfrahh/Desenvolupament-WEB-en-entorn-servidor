<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/tarea.php';

protegerPagina();
$t = new Tarea();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $descripcion = limpiarEntrada($_POST['descripcion'] ?? '');

    if (empty($nombre) || empty($descripcion)) {
        $mensaje = "Nombre y descripción son obligatorios.";
    } else {
        if ($t->agregarTarea($nombre, $descripcion, $_SESSION['usuario_id'])) {
            flash('mensaje', 'Tarea añadida.');
            header('Location: index.php'); exit;
        } else {
            $mensaje = "Error al añadir tarea.";
        }
    }
}

include __DIR__ . '/header.php';
?>
<h2>Añadir tarea</h2>
<form method="post">
    <label>Nombre: <input type="text" name="nombre" required></label><br><br>
    <label>Descripción:<br><textarea name="descripcion" rows="5" cols="50" required></textarea></label><br><br>
    <button type="submit">Agregar</button>
</form>
<?php if($mensaje): ?><p style="color:red;"><?= $mensaje ?></p><?php endif; ?>
