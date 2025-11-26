<?php
// Archivo JSON con el listado de personajes
$jsonFile = "marvel_characters.json";

if (!file_exists($jsonFile)) {
    die("No se encuentra el archivo JSON.");
}

$jsonData = file_get_contents($jsonFile);
$data = json_decode($jsonData, true);

if ($data === null) {
    die("Error al leer el JSON.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Personajes y Cómics</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
            font-family: Arial;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            vertical-align: top;
        }
        th {
            background: #222;
            color: white;
        }
        tr:nth-child(even) {
            background: #eee;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th>Personaje</th>
        <th>Cómics</th>
    </tr>

    <?php foreach ($data as $character): ?>
        <tr>
            <td>
                <strong><?= htmlspecialchars($character["name"]) ?></strong><br>
                <img src="<?= htmlspecialchars($character["thumbnail"]["path"] . "." . $character["thumbnail"]["extension"]) ?>" 
                     alt="<?= htmlspecialchars($character["name"]) ?>"
                     width="120">
            </td>

            <td>
                <?php
                    if (isset($character["comics"]["items"])) {
                        foreach ($character["comics"]["items"] as $comic) {
                            echo "- " . htmlspecialchars($comic["name"]) . "<br>";
                        }
                    } else {
                        echo "No hay cómics disponibles.";
                    }
                ?>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
