<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Gestión de Tareas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        header nav a { margin-right: 10px; }
        header img { vertical-align: middle; border-radius: 50%; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
    </style>
</head>
<body>
<header>
    <nav>
        <a href="index.php">Inicio</a>
        <?php if(estaAutenticado()): ?>
            | <a href="add_tarea.php">Añadir tarea</a>
            | <a href="search.php">Buscar</a>
            | <a href="perfil.php">Perfil</a>
            | <a href="logout.php">Cerrar sesión</a>
            <span style="float:right">
                <?php if(!empty($_SESSION['usuario_img'])): ?>
                    <img src="uploads/<?php echo $_SESSION['usuario_img']; ?>" alt="img" width="36">
                <?php endif; ?>
                <?php echo $_SESSION['usuario_fullname']; ?>
            </span>
        <?php else: ?>
            | <a href="login.php">Login</a> | <a href="register.php">Registro</a>
        <?php endif; ?>
    </nav>
</header>
<hr>
