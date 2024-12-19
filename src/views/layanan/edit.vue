<script setup>
    //import ref
    import { ref, onMounted } from "vue";
 
    //import router
    import { useRouter, useRoute } from 'vue-router';
 
    //import api
    import api from "../../api";
 
    //init router
    const router = useRouter();
 
    //init route
    const route = useRoute();
 
    //define state
    const nama = ref("");
    const deskripsi = ref("");
    const harga = ref("");
    const errors = ref([]);
 
    //onMounted
    onMounted( async () => {
 
        //fetch detail data layanan by ID
        await api.get(`/api/layanans/${route.params.id}`)
        .then(response => {
 
            //set response data to state
            nama.value = response.data.data.nama;
            deskripsi.value = response.data.data.deskripsi;
            harga.value = response.data.data.harga;
        });
    })
 
    //method "updateLayanan"
    const updateLayanan = async () => {
 
        //init formData
        let formData = new FormData();
 
        //assign state value to formData
        formData.append("nama", nama.value);
        formData.append("deskripsi", deskripsi.value);
        formData.append("harga", harga.value);
        formData.append("_method", "PATCH");
 
        //store data with API
        await api.post(`/api/layanans/${route.params.id}`, formData)
        .then(() => {
            //redirect
            router.push({ path: "/layanans" });
        })
        .catch((error) => {
            //assign response error data to state "errors"
            errors.value = error.response.data;
        });
    };
</script>
 
<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="updateLayanan()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama</label>
                                <input type="text" class="form-control" v-model="nama" placeholder="Nama">
                                <div v-if="errors.nama" class="alert alert-danger mt-2">
                                    <span>{{ errors.nama[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control" v-model="deskripsi" rows="5" placeholder="Deskripsi"></textarea>
                                <div v-if="errors.deskripsi" class="alert alert-danger mt-2">
                                    <span>{{ errors.deskripsi[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Harga</label>
                                <input type="text" class="form-control" v-model="harga" placeholder="Harga">
                                <div v-if="errors.harga" class="alert alert-danger mt-2">
                                    <span>{{ errors.harga[0] }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
