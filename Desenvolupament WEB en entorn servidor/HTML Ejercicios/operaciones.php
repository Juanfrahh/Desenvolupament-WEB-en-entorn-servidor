<?php
// ---------------- FUNCIONES -----------------

// Sumar
function sumar($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        throw new Exception("Ambos parámetros deben ser números.");
    }
    return $a + $b;
}

// Clase de excepción personalizada
class MiExcepcion extends Exception {
    public function __toString() {
        return "⚠️ Error: " . $this->getMessage();
    }
}

// Dividir
function dividir($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        throw new MiExcepcion("Los parámetros deben ser números.");
    }
    if ($b == 0) {
        throw new MiExcepcion("No se puede dividir entre cero.");
    }
    return $a / $b;
}

// ---------------- PROGRAMA PRINCIPAL -----------------
$resultado = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operacion = $_POST['operacion'];

    try {
        if ($operacion == "sumar") {
            $resultado = "Resultado: " . sumar($num1, $num2);
        } elseif ($operacion == "dividir") {
            $resultado = "Resultado: " . dividir($num1, $num2);
        }
    } 
    catch (MiExcepcion $e) {
        $resultado = $e;
    } 
    catch (Exception $e) {
        $resultado = "Error: " . $e->getMessage();
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
    <form method="post">
        <label>Número 1:</label>
        <input type="text" name="num1" value="<?php echo $_POST['num1'] ?? ''; ?>" required><br><br>

        <label>Número 2:</label>
        <input type="text" name="num2" value="<?php echo $_POST['num2'] ?? ''; ?>" required><br><br>

        <label>Operación:</label>
        <select name="operacion">
            <option value="sumar" <?php if(($_POST['operacion'] ?? '')=="sumar") echo "selected"; ?>>Sumar</option>
            <option value="dividir" <?php if(($_POST['operacion'] ?? '')=="dividir") echo "selected"; ?>>Dividir</option>
        </select><br><br>

        <input type="submit" value="Calcular">
        <span class="inline"><?php echo $resultado; ?></span>
    </form>
</body>
</html>
