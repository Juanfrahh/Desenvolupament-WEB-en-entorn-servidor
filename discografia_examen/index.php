<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'conexion.ini.php';

// Usamos la clase para conectarnos
$cn = new Conexion('localhost', 'root', '', 'discografia');
$conexion = $cn->conectionPDO();

// Cargar datos del usuario
$stmt = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE usuario = ?");
$stmt->execute([$_SESSION['usuario']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

?