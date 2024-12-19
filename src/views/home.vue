<script setup>
</script>

<template>
  <!-- Page dengan latar belakang gradasi biru -->
  <div class="gradient-page d-flex flex-column vh-100">
    <!-- Teks Utama di Tengah -->
    <div class="d-flex flex-grow-1 justify-content-center align-items-center text-center">
      <div>
        <h1 class="display-4 fw-bold mb-3">Website Fotografi</h1>
        <p class="fs-5">Membingkai Kenangan dalam Setiap Jepretan</p>
      </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 text-white">
      <p class="fs-6 fst-italic mb-0">
        "Hal terbaik mengenai sebuah gambar adalah gambar itu tidak pernah berubah, bahkan ketika orang-orang yang ada di dalamnya sudah berubah."
      </p>
    </footer>
  </div>
</template>

<style scoped>
/* Latar belakang gradasi biru */
.gradient-page {
  background: linear-gradient(45deg, #004aad, #00aaff); /* Gradasi biru */
  color: white;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3); /* Bayangan teks agar lebih jelas */
  overflow: hidden; /* Menghilangkan scroll */
}

.vh-100 {
  height: 100vh; /* Tinggi penuh layar */
}

.flex-grow-1 {
  flex-grow: 1; /* Memperluas area tengah */
}

.text-center {
  text-align: center;
}

footer {
  background: rgba(0, 0, 0, 0.2); /* Latar belakang semi-transparan untuk footer */
}
</style>
