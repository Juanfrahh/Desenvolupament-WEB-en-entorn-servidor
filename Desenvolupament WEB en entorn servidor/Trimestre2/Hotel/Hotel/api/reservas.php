<?php
header("Content-Type: application/json");
require_once "auth.php";
verificarApiKey();

// Conexión PDO
$pdo = new PDO("mysql:host=localhost;dbname=nombre_de_tu_bd;charset=utf8", "root", "");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $datos = json_decode(file_get_contents("php://input"), true);

    $sql = "INSERT INTO reservas (nombre_cliente, habitacion_id, fecha_entrada, fecha_salida) 
            VALUES (:nombre, :hab_id, :entrada, :salida)";

    $stmt = $pdo->prepare($sql);

    $resultado = $stmt->execute([
        ':nombre'  => $datos['cliente'],
        ':hab_id'  => $datos['id_habitacion'],
        ':entrada' => $datos['entrada'],
        ':salida'  => $datos['salida']
    ]);

    if ($resultado) {
        echo json_encode(["mensaje" => "Reserva guardada en BD con éxito"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo guardar en la base de datos"]);
    }
}
