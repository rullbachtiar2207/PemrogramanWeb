<?php
// Mengizinkan akses dari origin tertentu atau semua origin
header("Access-Control-Allow-Origin: *");  // Gunakan '*' untuk mengizinkan semua domain atau ganti dengan 'http://localhost'

// Mengizinkan metode HTTP tertentu yang digunakan oleh client (GET, POST, PUT, DELETE)
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// Mengizinkan header tertentu yang dikirim oleh client
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Jika ini adalah preflight request (OPTIONS), kirimkan respons langsung
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;  // Jika permintaan adalah OPTIONS, langsung keluar
}

// Pastikan jalur menuju DatabaseConfig.php benar dengan menggunakan __DIR__
require_once __DIR__ . '/../config/DatabaseConfig.php';

class ClientController {
    private $conn;

    // Konstruktor untuk inisialisasi koneksi database
    public function __construct() {
        $database = new DatabaseConfig();  // Membuat objek DatabaseConfig
        $this->conn = $database->getConnection();  // Mendapatkan koneksi database

        // Menambahkan pengelolaan kesalahan koneksi
        if (!$this->conn) {
            die("Connection failed: " . $this->conn->errorInfo());
        }
    }

    // Fungsi untuk mengambil semua klien
    public function getAllClients() {
        $query = "SELECT * FROM clients";
        $stmt = $this->conn->prepare($query);
        
        // Menangani kemungkinan kesalahan eksekusi query
        if (!$stmt->execute()) {
            return json_encode(["error" => "Failed to fetch clients", "details" => $stmt->errorInfo()]);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Mengembalikan hasil dalam bentuk array asosiatif
    }

    // Fungsi untuk mengambil data klien berdasarkan ID
    public function getClientById($id) {
        $query = "SELECT * FROM clients WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);  // Bind parameter dengan tipe data yang benar
        
        // Menangani kemungkinan kesalahan eksekusi query
        if (!$stmt->execute()) {
            return json_encode(["error" => "Failed to fetch client by ID", "details" => $stmt->errorInfo()]);
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);  // Mengembalikan data klien berdasarkan ID
    }

    // Fungsi untuk membuat klien baru
    public function createClient($name, $email, $message) {
        $query = "INSERT INTO clients (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);  // Bind parameter dengan tipe data yang benar
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":message", $message, PDO::PARAM_STR);

        // Menangani kemungkinan kesalahan eksekusi query
        if (!$stmt->execute()) {
            return json_encode(["error" => "Failed to create client", "details" => $stmt->errorInfo()]);
        }

        return json_encode(["success" => "Client created successfully"]);
    }

    // Fungsi untuk memperbarui data klien
    public function updateClient($id, $name, $email, $message) {
        $query = "UPDATE clients SET name = :name, email = :email, message = :message WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);  // Bind parameter dengan tipe data yang benar
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":message", $message, PDO::PARAM_STR);

        // Menangani kemungkinan kesalahan eksekusi query
        if (!$stmt->execute()) {
            return json_encode(["error" => "Failed to update client", "details" => $stmt->errorInfo()]);
        }

        return json_encode(["success" => "Client updated successfully"]);
    }

    // Fungsi untuk menghapus klien
    public function deleteClient($id) {
        $query = "DELETE FROM clients WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);  // Bind parameter dengan tipe data yang benar

        // Menangani kemungkinan kesalahan eksekusi query
        if (!$stmt->execute()) {
            return json_encode(["error" => "Failed to delete client", "details" => $stmt->errorInfo()]);
        }

        return json_encode(["success" => "Client deleted successfully"]);
    }
}
?>
