<?php
$dsn = "mysql:host=localhost;dbname=discografia;charset=utf8";
$usuario = "discografia";
$clave = "discografia";
$opciones = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $conexion = new PDO($dsn, $usuario, $clave, $opciones);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

