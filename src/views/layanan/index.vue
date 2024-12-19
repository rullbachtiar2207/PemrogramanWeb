<script setup>
 
    //import ref and onMounted
    import { ref, onMounted } from 'vue';
 
    //import api
    import api from '../../api';
 
    //define state
    const layanan = ref([]);
 
    //method fetchDataLayanan
    const fetchDataLayanan = async () => {
 
        //fetch data 
        await api.get('/api/layanans')
 
        .then(response => {
 
            //set response data to state "layanan"
            layanan.value = response.data;
            console.log(layanan);
 
        });
    }
 
    //method deleteLayanan
    const deleteLayanan = async (id) => {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            await api.delete(`/api/layanans/${id}`)
                .then(() => {
                    // Filter out the deleted item from the state
                    layanan.value = layanan.value.filter(item => item.id !== id);
                    alert('Data berhasil dihapus!');
                })
                .catch(error => {
                    console.error('Error deleting data:', error);
                    alert('Gagal menghapus data!');
                });
        }
    };
 
    //run hook "onMounted"
    onMounted(() => {
 
        //call method "fetchDataLayanan"
        fetchDataLayanan();
    });
 
</script>
 
<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'layanan.create' }" class="btn btn-md btn-success rounded shadow border-0 mb-3">ADD NEW POST</router-link>
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="layanan.length == 0">
                                    <td colspan="5" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            Data Belum Tersedia!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(item, index) in layanan" :key="index">
                                    <td class="text-center">{{ item.id }}</td>
                                    <td>{{ item.nama }}</td>
                                    <td>{{ item.deskripsi }}</td>
                                    <td>{{ item.harga }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'layanan.edit', params:{id: item.id} }" class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">EDIT</router-link>
                                        <button @click="deleteLayanan(item.id)" class="btn btn-sm btn-danger rounded-sm shadow border-0">DELETE</button>
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
