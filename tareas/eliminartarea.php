<?php
require_once 'config.php';
require_once 'tarea.php';

protegerPagina();

$id = $_GET['id'] ?? null;
if($id){
    $tareaObj = new Tarea();
    $tareaObj->eliminarTarea($id);
}
header('Location: index.php');
exit;
