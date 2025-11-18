<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contador y factorial</title>
</head>
<body>

<?php include("cabecera.inc.php"); ?>

<main>
    <h2>Lista de números del 1 al 30</h2>
    <ul>
        <?php
        for ($i = 1; $i <= 30; $i++) {
            echo "<li>$i</li>";
        }
        ?>
    </ul>

    <h2>Cálculo del factorial de 5</h2>
    <p>
        <?php
        $numero = 5;
        $factorial = 1;
        $cadena = "";

        for ($i = $numero; $i >= 1; $i--) {
            $factorial *= $i;
            $cadena .= $i;
            if ($i > 1) {
                $cadena .= " x ";
            }
        }

        echo $numero . "! = " . $cadena . " = " . $factorial;
        ?>
    </p>
</main>

<?php include("footer.inc.php"); ?>

</body>
</html>
