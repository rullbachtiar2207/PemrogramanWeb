<?php

function cetakAngka($n) {
    for ($i = 1; $i <= $n; $i++) {
        // Memeriksa kelipatan 4 dan 6 untuk output 'Pemrograman Website 2024'
        if ($i % 4 == 0 && $i % 6 == 0) {
            echo "Pemrograman Website 2024<br>";
        } 
        // Memeriksa kelipatan 5 untuk output '2024'
        elseif ($i % 5 == 0) {
            echo "2024<br>";
        } 
        // Memeriksa kelipatan 4 untuk output 'Pemrograman'
        elseif ($i % 4 == 0) {
            echo "Pemrograman<br>";
        } 
        // Memeriksa kelipatan 6 untuk output 'Website'
        elseif ($i % 6 == 0) {
            echo "Website<br>";
        } 
        // Jika tidak memenuhi syarat di atas, cetak angka
        else {
            echo "$i<br>";
        }
    }

    // Menambahkan output '2024' di bawah setelah loop selesai
    echo "2024<br>";
}

// Contoh penggunaan fungsi
cetakAngka(24); // Menggunakan 24 untuk mendapatkan output yang diinginkan
?>
