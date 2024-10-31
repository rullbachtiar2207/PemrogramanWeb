<?php
function segitigaSamaSisi($n) {
    for ($i = 1; $i <= $n; $i++) {
        // Menambahkan spasi di awal setiap baris agar segitiga simetris
        for ($k = $n - $i; $k > 0; $k--) {
            echo "&nbsp;&nbsp;"; // Tambah dua spasi agar segitiga lebih seimbang
        }
        // Mencetak bintang dengan jumlah ganjil
        for ($j = 1; $j <= (2 * $i - 1); $j++) {
            echo "*";
        }
        echo "<br>"; // Baris baru untuk setiap baris segitiga
    }
}

segitigaSamaSisi(5);
?>
