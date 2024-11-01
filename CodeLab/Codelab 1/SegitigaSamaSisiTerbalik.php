<?php
function segitigaSamaSisiTerbalik($n) {
    for ($i = $n; $i >= 1; $i--) {
        // Menambahkan spasi di awal setiap baris agar segitiga terbalik simetris
        for ($k = 0; $k < $n - $i; $k++) {
            echo "&nbsp;&nbsp;"; // Tambah dua spasi agar segitiga terbalik lebih seimbang
        }
        // Mencetak bintang dengan jumlah ganjil yang menurun
        for ($j = 1; $j <= (2 * $i - 1); $j++) {
            echo "*";
        }
        echo "<br>"; // Baris baru untuk setiap baris segitiga
    }
}

segitigaSamaSisiTerbalik(5);
?>
