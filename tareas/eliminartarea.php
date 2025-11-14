<?php
require_once '../config/config.php';
require_once '../classes/Tarea.php';

protegerPagina();

$id = $_GET['id'] ?? null;
if($id){
    $tareaObj = new Tarea();
    $tareaObj->eliminarTarea($id);
}
header('Location: index.php');
exit;
