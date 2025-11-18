<?php
$dwes = @new mysqli('localhost', 'dwes', 'dwes', 'tienda');

if ($dwes->connect_errno) {
    echo "Error de conexión: " . $dwes->connect_error;
    exit();
}
?>

<?php

$consulta = "SELECT cod, nombre_corto, PVP FROM producto";
$resultado = $dwes->query($consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tienda DWES</title>
</head>
<body>
  <h1>Lista de productos</h1>
  <ul>
    <?php
    while ($producto = $resultado->fetch_object()) {
        echo "<li><a href='stock.php?cod=$producto->cod'>$producto->nombre_corto</a> - $producto->PVP €</li>";
    }
    ?>
  </ul>
</body>
</html>
