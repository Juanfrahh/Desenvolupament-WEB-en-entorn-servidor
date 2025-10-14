<?php
$dwes = @new mysqli('localhost', 'dwes', 'dwes', 'discografia');

if ($dwes->connect_errno) {
    echo "Error de conexión: " . $dwes->connect_error;
    exit();
}
?>