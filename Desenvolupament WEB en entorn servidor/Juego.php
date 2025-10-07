<?php
require_once "Soporte.php";

class Juego extends Soporte {
    private $consola;
    private $minJugadores;
    private $maxJugadores;

    public function __construct($titulo, $numero, $precio, $consola, $minJugadores, $maxJugadores) {
        parent::__construct($titulo, $numero, $precio);
        $this->consola = $consola;
        $this->minJugadores = $minJugadores;
        $this->maxJugadores = $maxJugadores;
    }

    public function muestraJugadoresPosibles() {
        if ($this->minJugadores == 1 && $this->maxJugadores == 1) {
            echo "Para un jugador<br>";
        } elseif ($this->minJugadores == $this->maxJugadores) {
            echo "Para " . $this->minJugadores . " jugadores<br>";
        } else {
            echo "De " . $this->minJugadores . " a " . $this->maxJugadores . " jugadores<br>";
        }
    }

    public function muestraResumen() {
        echo "<br>Juego para: " . $this->consola . "<br>";
        echo $this->titulo . "<br>";
        echo $this->getPrecio() . " € (IVA no incluido)<br>";
        $this->muestraJugadoresPosibles();
    }
}
?>
