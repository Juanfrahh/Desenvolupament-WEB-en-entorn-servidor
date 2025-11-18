<?php
class Soporte {
    public $titulo;
    private $numero;
    protected $precio;
    private const IVA = 0.21;

    public function __construct($titulo, $numero, $precio) {
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getPrecioConIVA() {
        return round($this->precio * (1 + self::IVA), 2);
    }

    public function muestraResumen() {
        echo "<br>" . $this->titulo . "<br>";
        echo $this->precio . " € (IVA no incluido)<br>";
    }
}
?>
