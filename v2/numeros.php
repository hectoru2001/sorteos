<?php
// Configuración de conexión a la base de datos
$servername = "108.179.194.19";
$username = "rysjuare_sss";
$password = "O,3jrH.WT_@K";
$dbname = "rysjuare_rifas_db";

// Encabezado para indicar que se devuelve JSON
header('Content-Type: application/json');

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    echo json_encode(["error" => "Conexión fallida: " . $conn->connect_error]);
    exit;
}

// Consulta SQL para obtener los números ocupados
$sql = "SELECT numero FROM participantes";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
    exit;
}

// Validar resultados
if ($result->num_rows == 0) {
    echo json_encode(["error" => "No se encontraron números ocupados."]);
    exit;
}

// Crear array de números ocupados
$numerosOcupados = [];
while ($row = $result->fetch_assoc()) {
    $numerosOcupados[] = $row["numero"];
}

// Enviar la respuesta como JSON
echo json_encode($numerosOcupados);

// Cerrar la conexión
$conn->close();
?>
