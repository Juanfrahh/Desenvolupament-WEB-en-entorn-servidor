<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Tarea.php';

protegerPagina();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id) {
    $t = new Tarea();
    $ok = $t->eliminarTarea($id);
    if ($ok) {
        flash('mensaje', 'Tarea eliminada.');
    } else {
        flash('mensaje', 'No se pudo eliminar (quizás ya está completada).');
    }
}
header('Location: index.php'); exit;
