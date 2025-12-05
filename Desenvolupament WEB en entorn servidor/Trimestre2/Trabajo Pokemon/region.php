<?php
if (empty($_GET["region"])) die("No se especificó la región.");

$regionName = strtolower($_GET["region"]);
$regionData = @json_decode(@file_get_contents("https://pokeapi.co/api/v2/region/$regionName"), true);

if (!$regionData || empty($regionData["pokedexes"])) die("No se encontró la región o su pokédex.");

$pokedexUrl = $regionData["pokedexes"][0]["url"];
$pokedex = json_decode(file_get_contents($pokedexUrl), true);
$pokemons = $pokedex["pokemon_entries"];

$baseImg = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/"; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pokémon de <?php echo ucfirst($regionName); ?></title>
    <link rel="stylesheet" href="examen.css">

</head>
<body>

<header>Mi blog de <img src="img/logo.png"></header>

<nav>
    <strong>
		<a href="index.php" style=" color:Orange">Inicio</a>
        <a href="region.php?region=kanto" style="color: Orange">G1 Kanto</a>
        <a href="region.php?region=johto" style="color: Orange">G2 Johto</a>
        <a href="region.php?region=hoenn" style="color: Orange">G3 Hoenn</a>
        <a href="region.php?region=sinnoh" style="color: Orange">G4 Sinnoh</a>
        <a href="region.php?region=unova" style="color: Orange">G5 Unova</a>
        <a href="region.php?region=kalos" style="color: Orange">G6 Kalos</a>
        <a href="region.php?region=alola" style="color: Orange">G7 Alola</a>
        <a href="region.php?region=galar" style="color: Orange">G8 Galar</a>
        <a href="region.php?region=paldea" style="color: Orange">G9 Paldea</a> 
        <a href="search.php" style="color: Orange">Búsqueda</a>
    </strong>
</nav>

<div id="iniciales">
    <h1 style="text-align:center;">Pokémon de <?php echo ucfirst($regionName); ?></h1>
    <div class="grid">

        <?php foreach ($pokemons as $pkm): ?>

            <?php
            preg_match('/\/(\d+)\/$/', $pkm["pokemon_species"]["url"], $matches);
            $id = $matches[1];

            $name = $pkm["pokemon_species"]["name"];
            $img = $baseImg . $id . ".png";
            ?>

            <div class="card">
                <a href="pokemon.php?name=<?php echo $name; ?>">
                    <img loading="lazy" src="<?php echo $img; ?>"><br>
                    <?php echo ucfirst($name); ?>
                </a>
            </div>

        <?php endforeach; ?>

    </div>
</div>

<footer>Trabajo  Desarrollo Web en Entorno Servidor 2025/2026 IES Serra Perenxisa</footer>

</body>
</html>
