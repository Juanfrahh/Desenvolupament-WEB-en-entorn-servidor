<?php
require_once '../config/config.php';
require_once '../classes/Tarea.php';

protegerPagina();

$mensaje = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = limpiarEntrada($_POST['nombre']);
    $descripcion = limpiarEntrada($_POST['descripcion']);
    $tarea = new Tarea();
    if($tarea->agregarTarea($nombre, $descripcion, $_SESSION['usuario_id'])){
        $mensaje = "Tarea añadida correctamente.";
    } else {
        $mensaje = "Error al añadir tarea.";
    }
}

include '../includes/header.php';
?>

<h2>Añadir Tarea</h2>
<form method="POST">
    <label>Nombre: <input type="text" name="nombre" required></label><br>
    <label>Descripción: <textarea name="descripcion" required></textarea></label><br>
    <button type="submit">Agregar</button>
</form>
<p style="color:green;"><?= $mensaje ?></p>
