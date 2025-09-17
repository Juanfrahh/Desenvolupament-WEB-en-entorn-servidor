<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Información del servidor</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<?php include("cabecera.inc.php"); ?>

<main>
    <h2>Contenido de la variable $_SERVER</h2>

    <table>
        <tr>
            <th>Clave</th>
            <th>Valor</th>
        </tr>
        <?php
        foreach ($_SERVER as $clave => $valor) {
            echo "<tr>";
            echo "<td>$clave</td>";
            echo "<td>$valor</td>";
            echo "</tr>";
        }
        ?>
    </table>
</main>

<?php include("footer.inc.php"); ?>

</body>
</html>
