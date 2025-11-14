<?php

$DB_HOST = "localhost";
$DB_USER = "usr_tareas";
$DB_PASS = "usr_tareas";
$DB_NAME = "tareas";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function limpiarEntrada($dato) {
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}

function estaAutenticado() {
    return isset($_SESSION['usuario_id']);
}

function protegerPagina() {
    if (!estaAutenticado()) {
        header("Location: login.php");
        exit;
    }
}

function flash($clave, $mensaje) {
    $_SESSION[$clave] = $mensaje;
}

function getFlash($clave) {
    if(isset($_SESSION[$clave])){
        $m = $_SESSION[$clave];
        unset($_SESSION[$clave]);
        return $m;
    }
    return '';
}
?>
