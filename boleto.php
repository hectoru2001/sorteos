<?php
// Configuración de conexión a la base de datos
$servername = "108.179.194.19";
$username = "rysjuare_sss";
$password = "O,3jrH.WT_@K";
$dbname = "rysjuare_rifas_db";

// Encabezado para indicar que se devuelve HTML con codificación UTF-8
header('Content-Type: text/html; charset=UTF-8');

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el número de boleto desde la URL
$numeroBoleto = $_GET['id'] ?? null;

if (!$numeroBoleto) {
    $error = "Número de boleto no especificado.";
    $participante = null;
} else {
    // Consulta para obtener los datos del participante
    $stmt = $conn->prepare("SELECT * FROM participantes WHERE numero = ?");
    $stmt->bind_param("i", $numeroBoleto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $error = "Boleto no encontrado.";
        $participante = null;
    } else {
        $participante = $result->fetch_assoc();
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RyS Juárez</title>
  <link rel="stylesheet" href="_astro/index.D0LijpIM.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="icon" href="img/logo.png" type="image/x-icon" />
</head>

<body class="bg-gradient-to-r from-gray-900 to-blue-800 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg bg-gradient-to-br from-gray-900 via-gray-700 to-gray-600 rounded-xl shadow-2xl p-8">
        <div class="text-center mb-6">
            <h1 class="text-5xl font-bold text-white">🎫 RyS Juárez 🎉</h1>
            <p class="text-lg text-gray-200">Viaje a Colombia o $35,000 MXN</p>
        </div>

        <!-- Formulario de búsqueda de boleto -->
        <form method="get" action="" class="mb-6">
            <input type="number" name="id" placeholder="Ingresa tu número de boleto"
            class="w-full p-3 mb-4 text-gray-900 rounded-lg focus:outline-none" required>
            <button type="submit" class="w-full bg-yellow-500 text-white py-3 rounded-lg hover:bg-yellow-600 transition-all">Buscar Boleto</button>
        </form>

        <?php if (isset($error)) : ?>
            <div class="bg-red-500 text-white p-4 rounded-lg shadow-md mb-6">
                <p class="font-semibold">⚠️ <?= htmlspecialchars($error) ?> ⚠️</p>
            </div>
        <?php elseif (isset($participante)) : ?>
            <div class="bg-white text-gray-800 rounded-xl shadow-md p-6 mb-6">
                <div class="flex justify-between items-center border-b-2 border-gray-300 pb-4 mb-4">
                    <span class="text-3xl font-bold text-yellow-600">Boleto #<?= htmlspecialchars($participante['numero']) ?></span>
                    <span class="text-lg font-medium text-gray-600"><?= date("d-m-Y H:i:s", strtotime($participante['fecha_registro'])) ?></span>
                </div>
                <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-700">Nombre:</p>
                    <p class="text-xl"><?= htmlspecialchars($participante['nombre']) ?></p>
                </div>
                <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-700">Estado:</p>
                    <p class="text-xl"><?= htmlspecialchars($participante['estado']) ?></p>
                </div>
                <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-700">Celular:</p>
                    <p class="text-xl"><?= htmlspecialchars($participante['telefono']) ?></p>
                </div>
            </div>
            <div class="text-center mt-6">
                <p class="text-sm text-gray-300">¡Gracias por participar en nuestro sorteo! 🌟</p>
                <a href="/" class="text-blue-500 hover:text-blue-700 mt-2 inline-block text-lg">Regresar al inicio</a>
            </div>

        <?php endif; ?>
    </div>
</body>
</html>
