<?php
// config.php
session_start();

// Configuración de la BD (ajusta si fuera necesario)
define('DB_HOST', 'localhost');
define('DB_NAME', 'tareas');
define('DB_USER', 'usr_tareas');
define('DB_PASS', 'usr_tareas');

// Funciones auxiliares
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

// Función para mostrar mensajes flash
function flash($key, $value = null) {
    if ($value === null) {
        if (isset($_SESSION['flash'][$key])) {
            $v = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $v;
        }
        return null;
    } else {
        $_SESSION['flash'][$key] = $value;
    }
}
?>
