<?php

function cetakAngka($n) {
    for ($i = 1; $i <= $n; $i++) {
        // Memeriksa kelipatan 4 dan 6 untuk output 'Pemrograman Website 2024'
        if ($i % 4 == 0 && $i % 6 == 0) {
            echo "Pemrograman Website 2024\n";
        } 
        // Memeriksa kelipatan 5 untuk output '2024'
        elseif ($i % 5 == 0) {
            echo "2024\n";
        } 
        // Memeriksa kelipatan 4 untuk output 'Pemrograman'
        elseif ($i % 4 == 0) {
            echo "Pemrograman\n";
        } 
        // Memeriksa kelipatan 6 untuk output 'Website'
        elseif ($i % 6 == 0) {
            echo "Website\n";
        } 
        // Jika tidak memenuhi syarat di atas, cetak angka
        else {
            echo "$i\n";
        }
    }

    // Menambahkan output '2024' di bawah setelah loop selesai
    echo "2024\n";
}

// Mengambil input dari pengguna
echo "Masukkan angka: ";
$inputNumber = trim(fgets(STDIN)); // Membaca input dari pengguna dan menghapus spasi

if (is_numeric($inputNumber) && $inputNumber > 0) {
    cetakAngka(intval($inputNumber)); // Memanggil fungsi dengan input dari pengguna
} else {
    echo "Silakan masukkan angka positif yang valid.\n";
}
?>
