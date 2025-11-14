<?php
require_once __DIR__ . 'config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Tareas</title>
</head>
<body>
<header>
    <nav>
        <a href="index.php">Inicio</a> |
        <a href="creartarea.php">Añadir Tarea</a> |
        <a href="buscar.php">Buscar Tareas</a> |
        <?php if(estaAutenticado()): ?>
            <span>Hola, <?= $_SESSION['usuario_nombre'] ?></span>
            <img src="img/<?= $_SESSION['usuario_img'] ?>" alt="Perfil" width="30">
            <a href="perfil.php">Perfil</a> |
            <a href="logout.php">Cerrar sesión</a>
        <?php else: ?>
            <a href="login.php">Login</a> |
            <a href="registro.php">Registro</a>
        <?php endif; ?>
    </nav>
</header>
<hr>
