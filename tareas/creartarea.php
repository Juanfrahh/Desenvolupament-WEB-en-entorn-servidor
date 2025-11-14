<?php
require_once 'config.php';
require_once 'Tarea.php';
protegerPagina();

$tarea = new Tarea();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $descripcion = limpiarEntrada($_POST['descripcion'] ?? '');
    if ($nombre && $descripcion) {
        if ($tarea->agregarTarea($nombre, $descripcion, $_SESSION['usuario_id'])) {
            $mensaje = "Tarea agregada correctamente.";
        } else {
            $mensaje = "Error al agregar tarea.";
        }
    } else {
        $mensaje = "Nombre y descripción son obligatorios.";
    }
}

include 'header.php';
?>
<h2>Añadir Tarea</h2>
<form method="post">
    <label>Nombre: <input type="text" name="nombre" required></label><br><br>
    <label>Descripción: <textarea name="descripcion" required></textarea></label><br><br>
    <button type="submit">Agregar</button>
</form>
<?php if($mensaje): ?><p style="color:green;"><?php echo $mensaje; ?></p><?php endif; ?>
