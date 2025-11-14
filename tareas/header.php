<?php
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Gestión de Tareas</title>
</head>
<body>
<header>
    <nav>
        <a href="index.php">Inicio</a>
        <?php if(estaAutenticado()): ?>
            | <a href="creartarea.php">Añadir tarea</a>
            | <a href="buscar.php">Buscar</a>
            | <a href="perfil.php">Perfil</a>
            | <a href="logout.php">Cerrar sesión</a>
            <span style="float:right">
                <?php if(!empty($_SESSION['usuario_img'])): ?>
                    <img src="img/<?= htmlspecialchars($_SESSION['usuario_img']) ?>" alt="img" width="36">
                <?php endif; ?>
                <?= htmlspecialchars($_SESSION['usuario_nombre'] ?? '') ?>
            </span>
        <?php else: ?>
            | <a href="login.php">Login</a> | <a href="registro.php">Registro</a>
        <?php endif; ?>
    </nav>
</header>
<hr>
