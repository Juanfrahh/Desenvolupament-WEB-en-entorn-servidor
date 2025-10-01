<?php
function sumar($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        throw new Exception("Ambos parámetros deben ser números.");
    }
    return $a + $b;
}

// Programa principal
try {
    echo "Resultado de la suma: " . sumar(5, 10) . "<br>";
    echo "Resultado de la suma: " . sumar("hola", 10) . "<br>"; // provoca excepción
} catch (Exception $e) {
    echo "Error en la suma: " . $e->getMessage();
}
?>

