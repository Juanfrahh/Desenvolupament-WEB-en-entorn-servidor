<?php
echo "<h2>Prueba de clases de herencia (UD3)</h2>";

// 1️⃣ Probamos la clase Soporte
include "Soporte.php";

$soporte1 = new Soporte("Tenet", 22, 3);
echo "<strong>" . $soporte1->titulo . "</strong><br>";
echo "Precio: " . $soporte1->getPrecio() . " euros<br>";
echo "Precio IVA incluido: " . $soporte1->getPrecioConIVA() . " euros<br>";
$soporte1->muestraResumen();

echo "<hr>";

// 2️⃣ Probamos la clase CintaVideo
include "CintaVideo.php";

$miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107);
echo "<strong>" . $miCinta->titulo . "</strong><br>";
echo "Precio: " . $miCinta->getPrecio() . " euros<br>";
echo "Precio IVA incluido: " . $miCinta->getPrecioConIVA() . " euros<br>";
$miCinta->muestraResumen();

echo "<hr>";

// clase Dvd
include "Dvd.php";

$miDvd = new Dvd("Origen", 24, 15, "es,en,fr", "16:9");
echo "<strong>" . $miDvd->titulo . "</strong><br>";
echo "Precio: " . $miDvd->getPrecio() . " euros<br>";
echo "Precio IVA incluido: " . $miDvd->getPrecioConIVA() . " euros<br>";
$miDvd->muestraResumen();

echo "<hr>";

// clase Juego
include "Juego.php";

$miJuego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
echo "<strong>" . $miJuego->titulo . "</strong><br>";
echo "Precio: " . $miJuego->getPrecio() . " euros<br>";
echo "Precio IVA incluido: " . $miJuego->getPrecioConIVA() . " euros<br>";
$miJuego->muestraResumen();
?>
