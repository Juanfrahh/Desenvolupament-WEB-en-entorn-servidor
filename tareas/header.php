<?php
require_once __DIR__ . '/../config/config.php';
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
        <a href="add_tarea.php">Añadir Tarea</a> |
        <a href="search.php">Buscar Tareas</a> |
        <?php if(estaAutenticado()): ?>
            <span>Hola, <?= $_SESSION['usuario_nombre'] ?></span>
            <img src="img/<?= $_SESSION['usuario_img'] ?>" alt="Perfil" width="30">
            <a href="../public/perfil.php">Perfil</a> |
            <a href="../public/logout.php">Cerrar sesión</a>
        <?php else: ?>
            <a href="../public/login.php">Login</a> |
            <a href="../public/register.php">Registro</a>
        <?php endif; ?>
    </nav>
</header>
<hr>
