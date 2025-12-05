<?php
$name = strtolower($_GET["name"]);
$pokemon = json_decode(@file_get_contents("https://pokeapi.co/api/v2/pokemon/$name"), true);

if (!$pokemon) {
    die("<h1 style='color:white; text-align:center;'>Pokémon no encontrado</h1>");
}

$id = $pokemon["id"];
$altura_m = $pokemon["height"] / 10;
$peso_kg   = $pokemon["weight"] / 10;

$img = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/$id.png";

$traducirTipos = [
    "water" => "Agua","fire" => "Fuego","grass" => "Planta","electric" => "Eléctrico",
    "ice" => "Hielo","fighting" => "Lucha","poison" => "Veneno","ground" => "Tierra",
    "flying" => "Volador","psychic" => "Psíquico","bug" => "Bicho","rock" => "Roca",
    "ghost" => "Fantasma","dragon" => "Dragón","dark" => "Siniestro","steel" => "Acero",
    "fairy" => "Hada","normal" => "Normal"
];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo ucfirst($name); ?></title>
	<link rel="stylesheet" href="examen.css">
</head>
<body>

<header> Mi blog de <img src="img/logo.png"> </header>

<nav>
	<strong>
		<a href="index.php" style="color: orange;">Regiones</a> &nbsp;&nbsp;
		<a href="search.php" style="color: orange;">Búsqueda</a>
	</strong>
</nav>

<div id="iniciales" style="text-align:center; padding-top:40px;">
	<h1><?php echo ucfirst($name); ?></h1>

	<img src="<?php echo $img; ?>" style="width:250px; height:250px;">

	<h2>Detalles</h2>

	<p><strong>ID:</strong> <?php echo $id; ?></p>
	<p><strong>Altura:</strong> <?php echo $altura_m; ?> m</p>
	<p><strong>Peso:</strong> <?php echo $peso_kg; ?> kg</p>

	<h3>Tipos</h3>
	<?php foreach ($pokemon["types"] as $tipo): 
		$en = $tipo["type"]["name"];
		$es = $traducirTipos[$en] ?? $en;
	?>
		<p><?php echo $es; ?></p>
	<?php endforeach; ?>
</div>

<footer>Trabajo  Desarrollo Web en Entorno Servidor 2025/2026 IES Serra Perenxisa</footer>

</body>
</html>
