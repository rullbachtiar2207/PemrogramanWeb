<?php
class DatabaseConfig {
    private $host = "localhost";
    private $db_name = "jasa_fotografer";
    private $username = "root"; // Sesuaikan dengan konfigurasi Anda
    private $password = "";     // Sesuaikan dengan konfigurasi Anda
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
