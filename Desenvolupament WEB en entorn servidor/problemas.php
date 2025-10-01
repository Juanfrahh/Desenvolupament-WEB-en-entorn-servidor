<?php
function sumar($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        throw new Exception("Ambos parámetros deben ser números.");
    }
    return $a + $b;
}

try {
    echo "Resultado de la suma: " . sumar(5, 10) . "<br>";
    echo "Resultado de la suma: " . sumar("hola", 10) . "<br>"; // provoca excepción
} catch (Exception $e) {
    echo "Error en la suma: " . $e->getMessage();
}

class MiExcepcion extends Exception {
    public function __toString() {
        return "⚠️ Error personalizado: " . $this->getMessage();
    }
}

function dividir($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        throw new MiExcepcion("Los parámetros deben ser números.");
    }
    if ($b == 0) {
        throw new MiExcepcion("No se puede dividir entre cero.");
    }
    return $a / $b;
}

// Programa principal
try {
    echo "Resultado de la división: " . dividir(20, 5) . "<br>";
    echo "Resultado de la división: " . dividir(20, 0) . "<br>"; // provoca excepción
} catch (MiExcepcion $e) {
    echo $e; // al tener __toString(), imprime el mensaje personalizado
}
?>
