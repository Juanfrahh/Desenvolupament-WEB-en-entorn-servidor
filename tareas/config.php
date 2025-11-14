<?php
// config.php
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'tareas');
define('DB_USER', 'usr_tareas');
define('DB_PASS', 'usr_tareas');

function estaAutenticado() {
    return isset($_SESSION['usuario_id']);
}

function protegerPagina() {
    if (!estaAutenticado()) {
        header('Location: login.php');
        exit;
    }
}

function limpiarEntrada($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>
