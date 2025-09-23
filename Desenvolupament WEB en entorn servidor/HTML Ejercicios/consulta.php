<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include("cabecera.inc.php") ?>
    <main>
        <h2>Datos recibidos: </h2>
        <br>
        <table border="1">
            <tr>
                <th>Campo</th>
                <th>Valor</th>
            </tr>
        <?php
            foreach ($_POST as $campo => $valor) {
                echo "<tr>";
                echo "<td>$campo</td>";
                if (is_array($valor)) {
                    echo "<td>" . implode(", ", $valor) . "</td>";
                } else {
                    echo "<td>$valor</td>";
                }
            }
        ?>
    </main>
    <?php include("footer.inc.php") ?>
</body>
</html>