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
