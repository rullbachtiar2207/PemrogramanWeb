<?php

namespace App\Traits;

// Trait untuk memformat respons API menjadi format JSON dengan pretty-print
trait ApiJsonFormatter
{
    /**
     * Format respons API yang konsisten dengan pretty-print JSON
     *
     * @param int $code Status kode HTTP (default: 200)
     * @param string $message Pesan yang akan dikirim dalam response (default: "success")
     * @param array|null $data Data yang akan dikirim dalam response (default: null)
     * @return void
     */
    public function apiJsonResponse(int $code = 200, string $message = "success", ?array $data = null): void
    {
        // Mengatur header untuk memastikan respons dalam format JSON
        header('Content-Type: application/json');
        
        // Menambahkan header CORS untuk mendukung API lintas domain
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        // Memastikan tidak ada output lain yang dikirim sebelum respons
        http_response_code($code); // Mengatur kode status HTTP yang sesuai

        // Memformat respons JSON
        $response = [
            "code" => $code,
            "message" => $message,
            "data" => $data,
        ];

        // Menampilkan respons dalam format JSON dengan pretty-print
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        exit(); // Menghentikan script setelah mengirimkan respons
    }
}
