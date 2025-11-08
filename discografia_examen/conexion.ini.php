<?php
// Clase Conexion: maneja la conexión a una base de datos MySQL.  
// Se puede usar para cualquier proyecto que necesite conectarse a una BD (discografía, Pokémon, libros, etc.)
class Conexion{
    public $ip;        // IP o nombre del servidor de base de datos
                        // Se usa para indicar dónde está alojada la BD (localhost si está en el mismo servidor)
    public $nombre;    // Usuario de la base de datos
                        // Se usa para autenticarse con la BD y poder ejecutar consultas
    public $password;  // Contraseña del usuario
                        // Se usa junto con el usuario para autenticar la conexión
    public $bd;        // Nombre de la base de datos
                        // Se usa para seleccionar cuál base de datos quieres manipular

    // Constructor: inicializa los datos de conexión al crear un objeto Conexion
    public function __construct($ip, $nombre, $password, $bd){
        $this->ip = $ip;            // Asigna la IP/host al objeto
        $this->nombre = $nombre;    // Asigna el usuario al objeto
        $this->password = $password;// Asigna la contraseña al objeto
        $this->bd = $bd;            // Asigna el nombre de la base de datos al objeto
        // Para otra base de datos (p.ej. Pokémon), cambiarías estos parámetros
        // Ejemplo: new Conexion('localhost','usuarioPokemon','clavePokemon','pokemon');
    }

    // Método __toString(): permite mostrar la info de conexión como texto
    public function __toString(){
        return 'Ip: ' . $this->ip .'<br>Nombre: ' . $this->nombre .'<br>Contraseña: ' . $this->password .'<br>Base de datos: ' . $this->bd .'<br>';
        // Se usa principalmente para debugging, para verificar que el objeto tiene los datos correctos
    }

    // Getters y setters: permiten obtener o cambiar los valores de las propiedades
    // Útiles si quieres modificar la conexión después de crear el objeto
    public function getIp(){ return $this->ip; }      // Devuelve la IP actual
    public function setIp($ip){ $this->ip = $ip; }   // Cambia la IP

    public function getNombre(){ return $this->nombre; }       // Devuelve el usuario actual
    public function setNombre($nombre){ $this->nombre = $nombre; } // Cambia el usuario

    public function getPassword(){ return $this->password; }   // Devuelve la contraseña
    public function setPassword($password){ $this->password = $password; } // Cambia la contraseña

    public function getBd(){ return $this->bd; }         // Devuelve el nombre de la BD
    public function setBd($bd){ $this->bd = $bd; }       // Cambia el nombre de la BD

    // Método conection(): conecta usando mysqli (procedimental/orientado a objetos)
    // Se usa cuando el proyecto emplea funciones mysqli para consultas
    public function conection(){
        $conexion = new mysqli($this->ip, $this->nombre, $this->password, $this->bd);
        // Crea la conexión con los parámetros del objeto

        if($conexion->connect_errno != null){ // Verifica si hubo un error
            echo 'Error conectando a la base de datos: ';
            echo $conexion->connect_error;    // Muestra el error real de mysqli
            exit();                           // Termina la ejecución si no hay conexión
        } else {
            return $conexion;                // Devuelve la conexión para usarla
        }
    }

    // Método conectionPDO(): conecta usando PDO
    // Ventajas: preparado para SQL injection, transacciones, más moderno
    // Se usa cuando quieres trabajar con consultas preparadas o necesitas más flexibilidad
    public function conectionPDO(){
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); // Asegura que los caracteres se manejen en UTF-8
        try {
            $conexion = new PDO('mysql:host='.$this->ip.';dbname='.$this->bd, $this->nombre, $this->password, $opc);
            // Crea la conexión PDO usando los datos del objeto
            return $conexion; // Devuelve el objeto PDO
        } catch (PDOException $e) { // Captura errores de conexión
            echo 'Falló la conexión: ' . $e->getMessage(); // Muestra el error
            // Se usa para debug y manejo de errores al conectar con la BD
        }
    }
}
?>
