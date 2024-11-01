<?php

require_once __DIR__ . '/../Controllers/ProductController.php';

use Controllers\ProductController;

$productController = new ProductController();
$data = $productController->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vapestore Products</title>
</head>
<body>
    <h1>Product List</h1>
    <?php if ($data['code'] === 200): ?>
        <ul>
            <?php foreach ($data['data']['products'] as $product): ?>
                <li>
                    <strong><?php echo $product['name']; ?></strong><br>
                    Price: <?php echo $product['price']; ?><br>
                    Flavor: <?php echo $product['flavor']; ?><br>
                    Stock: <?php echo $product['stock']; ?>
                </li>
                <br>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No products available.</p>
    <?php endif; ?>
</body>
</html>
