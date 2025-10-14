<?php
$dwes = @new mysqli('localhost', 'dwes', 'dwes', 'tienda');

if ($dwes->connect_errno) {
    echo "Error de conexión: " . $dwes->connect_error;
    exit();
}
?>