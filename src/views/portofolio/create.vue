<script setup>
    // Import ref
    import { ref } from "vue";
    
    // Import router
    import { useRouter } from "vue-router";
    
    // Import api
    import api from "../../api";
    
    // Init router
    const router = useRouter();
    
    // Define state
    const judul = ref("");
    const deskripsi = ref("");
    const gambar = ref(null); // Inisialisasi gambar dengan null
    const errors = ref({});
    
    // Method "storePortofolio"
    const storePortofolio = async () => {
        // Validasi untuk memastikan gambar tidak kosong
        if (!gambar.value) {
            errors.value.gambar = ['Gambar tidak boleh kosong']; // Validasi gambar kosong
            return; // Jika gambar kosong, hentikan eksekusi
        }

        // Init formData
        const formData = new FormData();
        
        // Append values to formData
        formData.append("judul", judul.value);
        formData.append("deskripsi", deskripsi.value);
        formData.append("gambar", gambar.value); // Menambahkan gambar ke formData
        
        // Store data with API
        try {
            await api.post("/api/portofolios", formData);  // Pastikan endpoint API benar
            router.push({ path: "/portofolios" }); // Arahkan ke halaman portofolios setelah sukses
        } catch (error) {
            // Tangani error jika terjadi masalah dengan API
            errors.value = error.response?.data || {};
        }
    };

    // Handle file change
    const handleFileChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            gambar.value = file;  // Set gambar ke file yang dipilih
            errors.value.gambar = null; // Reset error gambar jika valid
        } else {
            gambar.value = null; // Jika tidak ada file, set gambar ke null
        }
    };
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="storePortofolio">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    v-model="judul" 
                                    placeholder="Judul" 
                                />
                                <div v-if="errors.judul" class="alert alert-danger mt-2">
                                    <span>{{ errors.judul[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea 
                                    class="form-control" 
                                    v-model="deskripsi" 
                                    rows="5" 
                                    placeholder="Deskripsi"
                                ></textarea>
                                <div v-if="errors.deskripsi" class="alert alert-danger mt-2">
                                    <span>{{ errors.deskripsi[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Gambar</label>
                                <input 
                                    type="file" 
                                    class="form-control" 
                                    @change="handleFileChange" 
                                />
                                <div v-if="errors.gambar" class="alert alert-danger mt-2">
                                    <span>{{ errors.gambar[0] }}</span>
                                </div>
                            </div>
                            <button 
                                type="submit" 
                                class="btn btn-md btn-primary rounded-sm shadow border-0 mt-3"
                            >
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
