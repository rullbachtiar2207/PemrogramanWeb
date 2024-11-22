<?php
// Pastikan jalur ke ClientController.php benar
require_once __DIR__ . '/../controllers/ClientController.php';

class ClientRoutes {
    private $controller;

    public function __construct() {
        $this->controller = new ClientController();
    }

    public function handleRequest($method, $path, $data = null) {
        header('Content-Type: application/json');  // Menetapkan header JSON

        if ($path === "/clients") {
            if ($method === "GET") {
                echo json_encode($this->controller->getAllClients(), JSON_PRETTY_PRINT);
            } elseif ($method === "POST") {
                $this->controller->createClient($data['name'], $data['email'], $data['message']);
                echo json_encode(["message" => "Client created"], JSON_PRETTY_PRINT);
            }
        } elseif (preg_match('/\/clients\/(\d+)/', $path, $matches)) {
            $id = $matches[1];
            if ($method === "GET") {
                echo json_encode($this->controller->getClientById($id), JSON_PRETTY_PRINT);
            } elseif ($method === "PUT") {
                $this->controller->updateClient($id, $data['name'], $data['email'], $data['message']);
                echo json_encode(["message" => "Client updated"], JSON_PRETTY_PRINT);
            } elseif ($method === "DELETE") {
                $this->controller->deleteClient($id);
                echo json_encode(["message" => "Client deleted"], JSON_PRETTY_PRINT);
            }
        } else {
            echo json_encode(["error" => "Invalid endpoint"], JSON_PRETTY_PRINT);
        }
    }
}
?>
