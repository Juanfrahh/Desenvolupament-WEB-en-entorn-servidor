<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Paso 1: Inicio<br>";

session_start();
echo "Paso 2: Sesión iniciada<br>";

if (!isset($_SESSION['usuario'])) {
    echo "Paso 3: No hay sesión. Redirigiendo...<br>";
    header('Location: login.php');
    exit();
}

echo "Paso 4: Usuario logueado como: ".$_SESSION['usuario']."<br>";

include 'conexion.ini.php';
echo "Paso 5: conexion.ini.php cargado<br>";

// Crear conexión usando la clase
$cn = new Conexion('localhost', 'root', '', 'discografia');
echo "Paso 6: Objeto Conexion creado<br>";

$conexion = $cn->conectionPDO();
echo "Paso 7: Conexión PDO creada<br>";

// Obtener datos del usuario
$stmt = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE usuario = ?");
echo "Paso 8: Consulta preparada<br>";

$stmt->execute([$_SESSION['usuario']]);
echo "Paso 9: Consulta ejecutada<br>";

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
echo "Paso 10: Usuario obtenido<br>";

var_dump($usuario); // Para verlo
exit();

?>