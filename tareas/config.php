<?php
// config.php

// Iniciar sesión
session_start();

// Constantes de conexión a la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'tareas');
define('DB_USER', 'usr_tareas');
define('DB_PASS', 'usr_tareas');

// Función para comprobar si el usuario está autenticado
function estaAutenticado() {
    return isset($_SESSION['usuario_id']);
}

// Redirigir si no está autenticado
function protegerPagina() {
    if (!estaAutenticado()) {
        header('Location: login.php');
        exit;
    }
}

// Función para limpiar datos de entrada
function limpiarEntrada($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>
