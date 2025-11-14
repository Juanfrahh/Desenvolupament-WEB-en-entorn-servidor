<?php
require_once 'config.php';
require_once 'yarea.php';
protegerPagina();

$id = $_GET['id'] ?? null;
if ($id) {
    $tarea = new Tarea();
    $tarea->eliminarTarea($id);
}
header('Location: index.php');
exit;
