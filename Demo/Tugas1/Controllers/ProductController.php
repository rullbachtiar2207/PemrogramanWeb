<?php

namespace Controllers;

require_once __DIR__ . '/../Traits/ResponseFormatter.php';
require_once 'Controller.php';

use Traits\ResponseFormatter;

class ProductController extends Controller
{
    use ResponseFormatter;

    public function __construct()
    {
        $this->controllerName = "Product Controller";
        $this->controllerMethod = "GET";
    }

    // Implementasi abstract method dari Controller
    public function getAllProducts()
    {
        $dummyProducts = [
            [
                "name" => "Vape Pen",
                "price" => 300000,
                "flavor" => "Strawberry",
                "stock" => 20
            ],
            [
                "name" => "E-Liquid Mango",
                "price" => 120000,
                "flavor" => "Mango",
                "stock" => 15
            ],
            [
                "name" => "Vape Mod Kit",
                "price" => 500000,
                "flavor" => "Blueberry",
                "stock" => 10
            ]
        ];

        $response = [
            "controller_info" => $this->getControllerInfo(),
            "products" => $dummyProducts
        ];

        return $this->responseFormatter(200, "Success", $response);
    }
}
