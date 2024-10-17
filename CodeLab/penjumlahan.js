// Fungsi untuk menjumlahkan dua bilangan
function jumlahkan() {
  let bilanganPertama = parseInt(document.getElementById("bilanganPertama").value);
  let bilanganKedua = parseInt(document.getElementById("bilanganKedua").value);
  document.getElementById("hasil").textContent = bilanganPertama + bilanganKedua;
}

// Fungsi untuk mengatur ulang input dan hasil
function reset() {
  document.getElementById("bilanganPertama").value = "";
  document.getElementById("bilanganKedua").value = "";
  document.getElementById("hasil").textContent = "";
}
