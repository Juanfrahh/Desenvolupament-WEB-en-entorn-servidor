<?php

function sumar($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        throw new Exception("Ambos parámetros deben ser números.");
    }
    return $a + $b;
}

class MiExcepcion extends Exception {
    public function __toString() {
        return "⚠️ Error: " . $this->getMessage();
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


$resultado = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operacion = $_POST['operacion'];

    try {
        if ($operacion == "sumar") {
            $resultado = "Resultado de la suma: " . sumar($num1, $num2);
        } elseif ($operacion == "dividir") {
            $resultado = "Resultado de la división: " . dividir($num1, $num2);
        }
    } catch (Exception $e) {
        $resultado = $e->getMessage();
    } catch (MiExcepcion $e) {
        $resultado = $e;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Operaciones con Excepciones</title>
</head>
<body>
    <h2>Calculadora con validación y excepciones</h2>
    <form method="post" action="operaciones.php">
        <label>Número 1:</label>
        <input type="text" name="num1" required><br><br>

        <label>Número 2:</label>
        <input type="text" name="num2" required><br><br>

        <label>Operación:</label>
        <select name="operacion">
            <option value="sumar">Sumar</option>
            <option value="dividir">Dividir</option>
        </select><br><br>

        <input type="submit" value="Calcular">
    </form>

    <?php if ($resultado): ?>
        <h3>📌 <?php echo $resultado; ?></h3>
    <?php endif; ?>
</body>
</html>
