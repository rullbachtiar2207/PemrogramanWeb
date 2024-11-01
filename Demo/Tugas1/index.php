<?php
require_once __DIR__ . '/Controllers/ProductController.php';

use Controllers\ProductController;

header('Content-Type: application/json');

// Inisialisasi ProductController
$productController = new ProductController();
echo json_encode($productController->getAllProducts(), JSON_PRETTY_PRINT);
