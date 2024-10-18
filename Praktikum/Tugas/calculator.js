function clearDisplay() {
  document.getElementById('display').innerText = '0'; // Reset tampilan ke 0
}

function appendToDisplay(value) {
  const display = document.getElementById('display');
  const lastChar = display.innerText.slice(-1); // Karakter terakhir di tampilan

  // Daftar operator
  const operators = ['+', '-', '*', '×', '/', '÷', '%', '^'];

  // Jika karakter terakhir adalah operator, ganti dengan operator baru
  if (operators.includes(lastChar) && operators.includes(value)) {
    display.innerText = display.innerText.slice(0, -1) + value;
    return;
  }

  // Jika input pertama adalah angka, ganti 0 dengan nilai input
  if (display.innerText === '0' && !operators.includes(value)) {
    display.innerText = value;
  } else {
    display.innerText += value; // Tambahkan nilai baru ke tampilan
  }
}

function calculate() {
  const display = document.getElementById('display');
  const lastChar = display.innerText.slice(-1); // Karakter terakhir

  // Daftar operator
  const operators = ['+', '-', '*', '×', '/', '÷', '%', '^'];

  // Jika ekspresi berakhir dengan operator, hindari kalkulasi
  if (operators.includes(lastChar)) {
    display.innerText = display.innerText.slice(0, -1); // Hilangkan operator terakhir
  }

  try {
    // Ganti simbol × dan ÷ untuk perhitungan
    let expression = display.innerText.replace('×', '*').replace('÷', '/');

    // Operasi pangkat (^) menjadi Math.pow()
    expression = expression.replace(/\^/g, '**');

    display.innerText = eval(expression); // Lakukan evaluasi perhitungan
  } catch (error) {
    display.innerText = 'Error'; // Tampilkan pesan kesalahan jika terjadi kesalahan
  }
}

function negate() {
  const display = document.getElementById('display');
  display.innerText = (parseFloat(display.innerText) * -1).toString(); // Ubah tanda angka
}

function percentage() {
  const display = document.getElementById('display');
  display.innerText = (parseFloat(display.innerText) / 100).toString(); // Hitung persentase
}
