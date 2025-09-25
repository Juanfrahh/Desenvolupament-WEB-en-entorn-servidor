<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<footer>
    <hr>
    <p>
        <?php

        echo "Carlos Tortosa <br>";

        $diaNumero = date("d");
        $mesNumero = date("n");
        $anio = date("Y");
        $diaSemanaNumero = date("w");

        $fechas = [
            "dias" => ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
            "meses" => ["", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"]
        ];

        $diaSemana = $fechas["dias"][$diaSemanaNumero];
        $mes = $fechas["meses"][$mesNumero];

        echo $diaSemana . ", " . $diaNumero . " de " . $mes . " de " . $anio;
        ?>
    </p>
</footer>    
</body>
</html>

