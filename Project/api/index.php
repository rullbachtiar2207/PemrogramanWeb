<?php
// Memanggil routing
require_once __DIR__ . '/routes/ClientRoutes.php';

// Menangani metode request dan data
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$data = json_decode(file_get_contents("php://input"), true); // Mengambil data JSON dari body

// Membuat instance ClientRoutes dan menangani request
$routes = new ClientRoutes();
$response = $routes->handleRequest($method, $path, $data);

// Pastikan respons JSON menggunakan JSON_PRETTY_PRINT
if (is_array($response) || is_object($response)) {
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
} else {
    // Jika respons bukan JSON, kembalikan apa adanya
    echo $response;
}
?>
