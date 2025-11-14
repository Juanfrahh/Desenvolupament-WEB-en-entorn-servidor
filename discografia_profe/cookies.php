<?php
session_start();

// Si el usuario acepta las cookies
if (isset($_POST['aceptar'])) {
    // Crear cookie válida por 1 día
    setcookie("aceptar_cookies", "1", time() + (86400), "/");

    // Si venía de intentar iniciar sesión, lo mandamos al login
    header("Location: login.php");
    exit();
}

// Si rechaza cookies → cerrar completamente sesión
if (isset($_POST['rechazar'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Uso de Cookies</title>
</head>
<body>

<h2>Aviso de cookies</h2>
<p>Este sitio usa cookies necesarias para mantener tu sesión. Debes aceptarlas para continuar.</p>

<form method="POST">
    <button name="aceptar">Aceptar cookies</button>
    <button name="rechazar">Rechazar</button>
</form>

</body>
</html>
