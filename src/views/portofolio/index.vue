<script setup>
    // Import ref dan onMounted
    import { ref, onMounted } from 'vue';

    // Import api
    import api from '../../api';

    // Define state
    const portofolio = ref([]);

    // Method fetchDataPortofolio
    const fetchDataPortofolio = async () => {
        try {
            const response = await api.get('/api/portofolios');
            portofolio.value = response.data;
        } catch (error) {
            console.error("Error saat mengambil data:", error);
        }
    };

    // Method deletePortofolio
    const deletePortofolio = async (id) => {
        if (confirm("Apakah Anda yakin ingin menghapus portofolio ini?")) {
            try {
                // Memanggil API untuk delete
                await api.delete(`/api/portofolios/${id}`);
                
                // Hapus item dari state "portofolio"
                portofolio.value = portofolio.value.filter(item => item.id !== id);

                alert("Portofolio berhasil dihapus!");
            } catch (error) {
                console.error("Error saat menghapus portofolio:", error);
                alert("Terjadi kesalahan saat menghapus portofolio.");
            }
        }
    };

    // run hook "onMounted"
    onMounted(() => {
        fetchDataPortofolio();
    });
</script>

<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <router-link 
                    :to="{ name: 'portofolios.create' }" 
                    class="btn btn-md btn-success rounded shadow border-0 mb-3"
                >
                    ADD NEW POST
                </router-link>
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="portofolio.length === 0">
                                    <td colspan="5" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            Data Belum Tersedia!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(item, index) in portofolio" :key="index">
                                    <td class="text-center">{{ item.id }}</td>
                                    <td>{{ item.judul }}</td>
                                    <td>{{ item.deskripsi }}</td>
                                    <td class="text-center">
                                        <img :src="item.gambar" alt="Gambar" width="100" class="rounded">
                                    </td>
                                    <td class="text-center">
                                        <router-link 
                                            :to="{ name: 'portofolios.edit', params:{id: item.id} }" 
                                            class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2"
                                        >
                                            EDIT
                                        </router-link>
                                        <button 
                                            class="btn btn-sm btn-danger rounded-sm shadow border-0"
                                            @click="deletePortofolio(item.id)"
                                        >
                                            DELETE
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
