<?php
session_start(); 
// Inicia la sesión actual para poder eliminar sus datos

session_destroy(); 
// Destruye toda la sesión, eliminando todas las variables guardadas

setcookie('usuario_recordado', '', time() - 3600, '/'); 
// Si se había usado una cookie para "recordar usuario", se borra poniendo una fecha de expiración pasada

header('Location: login.php'); 
// Redirige automáticamente al login después de cerrar sesión

exit(); 
// Asegura que no se ejecute más código después de la redirección
?>
