<?php
require_once "Soporte.php";

class Dvd extends Soporte {
    private $idiomas;
    private $formatoPantalla;

    public function __construct($titulo, $numero, $precio, $idiomas, $formatoPantalla) {
        parent::__construct($titulo, $numero, $precio);
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
    }

    public function muestraResumen() {
        echo "<br>Película en DVD:<br>";
        echo $this->titulo . "<br>";
        echo $this->precio . " € (IVA no incluido)<br>";
        echo "Idiomas: " . $this->idiomas . "<br>";
        echo "Formato Pantalla: " . $this->formatoPantalla . "<br>";
    }
}
?>
