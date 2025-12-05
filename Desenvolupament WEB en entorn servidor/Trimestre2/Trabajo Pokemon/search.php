<?php
function getPokemonCardHtml($name, $id = null) {
    if (!empty($id)) {
        $img = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/$id.png";
    } else {
        $data = @json_decode(@file_get_contents("https://pokeapi.co/api/v2/pokemon/" . urlencode($name)), true);
        if (!$data) return "";
        $img = $data["sprites"]["front_default"] ?? "img/default.png";
        $id = $data["id"] ?? null;
    }

    $safeName = htmlspecialchars($name, ENT_QUOTES);
    return "
    <div class='card'>
        <a href='pokemon.php?name={$safeName}' text-decoration:none;'>
            <img src='{$img}' loading='lazy'><br>" . ucfirst($safeName) . "
        </a>
    </div>";
}

$traducirTipos = [
    "agua" => "water","fuego" => "fire","planta" => "grass","eléctrico" => "electric","electrico" => "electric",
    "hielo" => "ice","lucha" => "fighting","veneno" => "poison","tierra" => "ground","volador" => "flying",
    "psíquico" => "psychic","psiquico" => "psychic","bicho" => "bug","roca" => "rock","fantasma" => "ghost",
    "dragón" => "dragon","dragon" => "dragon","siniestro" => "dark","acero" => "steel","hada" => "fairy","normal" => "normal"
];

$filterName = isset($_GET['name']) ? trim($_GET['name']) : '';
$filterType = isset($_GET['type']) ? trim($_GET['type']) : '';
$filterRegion = isset($_GET['region']) ? trim($_GET['region']) : '';

$type_list = [];
$region_list = [];

if ($filterType !== '') {
    $rawType = mb_strtolower($filterType);
    if (isset($traducirTipos[$rawType])) $type = $traducirTipos[$rawType];
    else $type = $rawType;

    $typeData = @json_decode(@file_get_contents("https://pokeapi.co/api/v2/type/" . urlencode($type)), true);

    if (!empty($typeData["pokemon"]) && is_array($typeData["pokemon"])) {
        foreach ($typeData["pokemon"] as $p) {
            $pname = $p["pokemon"]["name"];
            $pid = null;
            if (!empty($p["pokemon"]["url"]) && preg_match('/\/(\d+)\/$/', $p["pokemon"]["url"], $m)) {
                $pid = $m[1];
            }
            $type_list[strtolower($pname)] = ['name' => $pname, 'id' => $pid];
        }
    }
}

if ($filterRegion !== '') {
    $region = strtolower($filterRegion);
    $regionData = @json_decode(@file_get_contents("https://pokeapi.co/api/v2/region/" . urlencode($region)), true);

    if (!empty($regionData["pokedexes"][0]["url"])) {
        $pokedexUrl = $regionData["pokedexes"][0]["url"];
        $pokedex = @json_decode(@file_get_contents($pokedexUrl), true);

        if (!empty($pokedex["pokemon_entries"]) && is_array($pokedex["pokemon_entries"])) {
            foreach ($pokedex["pokemon_entries"] as $entry) {
                $pname = $entry["pokemon_species"]["name"];
                $speciesUrl = $entry["pokemon_species"]["url"] ?? '';
                $pid = null;
                if ($speciesUrl && preg_match('/\/(\d+)\/$/', $speciesUrl, $m)) {
                    $pid = $m[1];
                }
                $region_list[strtolower($pname)] = ['name' => $pname, 'id' => $pid];
            }
        }
    }
}

if (!empty($filterType) && !empty($filterRegion)) {
    foreach ($type_list as $k => $v) {
        if (isset($region_list[$k])) {
            $id = $region_list[$k]['id'] ?? $v['id'] ?? null;
            $final_list[$k] = ['name' => $v['name'], 'id' => $id];
        }
    }
} elseif (!empty($filterType)) {
    $final_list = $type_list;
} elseif (!empty($filterRegion)) {
    $final_list = $region_list;
}

if ($filterName !== '') {
    $lname = strtolower($filterName);

    if (!empty($final_list)) {
        if (isset($final_list[$lname])) {
            $final_list = [$lname => $final_list[$lname]];
        } else {
            $final_list = [];
        }
    } else {
        $poke = @json_decode(@file_get_contents("https://pokeapi.co/api/v2/pokemon/" . urlencode($lname)), true);
        if ($poke && isset($poke['id'])) {
            $final_list[$lname] = ['name' => $poke['name'], 'id' => $poke['id']];
        } else {
            $final_list = [];
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Buscar Pokémon</title>
    <link rel="stylesheet" href="examen.css">
</head>
<body>

<header>Mi blog de <img src="img/logo.png"></header>

<nav>
    <strong>
        <a href="index.php" style="color:Orange">Inicio</a>
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

<div id="iniciales" style="text-align:center;">

    <h1>Buscador Pokémon</h1>

    <form method="GET">
        <input type="text" name="name" placeholder="Nombre del Pokémon" value="<?php echo isset($_GET['name'])?htmlspecialchars($_GET['name'],ENT_QUOTES):''; ?>">

        <select name="type">
            <option value="">-- Seleccionar tipo --</option>
            <?php foreach ($traducirTipos as $es => $en): ?>
                <option value="<?= htmlspecialchars($es) ?>" <?php if(isset($_GET['type']) && $_GET['type']==$es) echo 'selected'; ?>><?= ucfirst($es) ?></option>
            <?php endforeach; ?>
        </select>

        <select name="region">
            <option value="">-- Seleccionar región --</option>
            <?php
            $regiones = ["kanto","johto","hoenn","sinnoh","unova","kalos","alola","galar","paldea"];
            foreach($regiones as $r){
                $sel = (isset($_GET['region']) && $_GET['region']==$r) ? 'selected' : '';
                echo "<option value=\"$r\" $sel>" . ucfirst($r) . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Buscar">
    </form>

    <hr>

    <div class="grid">
        <?php
        if (empty($final_list)) {
            echo "<p style='color:white;'>No se encontraron Pokémon para los filtros seleccionados.</p>";
        } else {
            foreach ($final_list as $k => $entry) {
                echo getPokemonCardHtml($entry['name'], $entry['id']);
            }
        }
        ?>
    </div>

</div>

<footer>Trabajo Desarrollo Web en Entorno Servidor 2025/2026 IES Serra Perenxisa</footer>

</body>
</html>
