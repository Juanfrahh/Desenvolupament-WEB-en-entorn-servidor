<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?= htmlspecialchars($usuario['usuario']) ?></title>
</head>
<body>
    <h1>Perfil de <?= htmlspecialchars($usuario['usuario']) ?></h1>

    <?php if (!empty($usuario['img_grande'])): ?>
        <img src="<?= htmlspecialchars($usuario['img_grande']) ?>" alt="Imagen de perfil">
    <?php else: ?>
        <p>Sin imagen de perfil</p>
    <?php endif; ?>

    <p><strong>Usuario:</strong> <?= htmlspecialchars($usuario['usuario']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email'] ?? 'No registrado') ?></p>

    <p>
        <a href="index.php">Volver a inicio</a> | 
        <a href="logout.php">Cerrar sesión</a>
    </p>
</body>
</html>
