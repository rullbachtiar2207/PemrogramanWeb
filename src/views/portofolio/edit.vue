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
    const judul = ref("");
    const deskripsi = ref("");
    const gambar = ref("");
    const errors = ref([]);
 
    //onMounted
    onMounted( async () => {
 
        //fetch detail data portofolio by ID
        await api.get(`/api/portofolios/${route.params.id}`)
        .then(response => {
 
            //set response data to state
            judul.value = response.data.data.judul;
            deskripsi.value = response.data.data.deskripsi;
            gambar.value = response.data.data.gambar;
        });
    });
 
    //method "updatePortofolio"
    const updatePortofolio = async () => {
 
        //init formData
        let formData = new FormData();
 
        //assign state value to formData
        formData.append("judul", judul.value);
        formData.append("deskripsi", deskripsi.value);
        formData.append("gambar", gambar.value);
        formData.append("_method", "PATCH");
 
        //store data with API
        await api.post(`/api/portofolios/${route.params.id}`, formData)
        .then(() => {
            //redirect
            router.push({ path: "/portofolios" });
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
                        <form @submit.prevent="updatePortofolio">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul</label>
                                <input type="text" class="form-control" v-model="judul" placeholder="Judul Baru">
                                <div v-if="errors.judul" class="alert alert-danger mt-2">
                                    <span>{{ errors.judul[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control" v-model="deskripsi" rows="5" placeholder="Deskripsi Baru"></textarea>
                                <div v-if="errors.deskripsi" class="alert alert-danger mt-2">
                                    <span>{{ errors.deskripsi[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Gambar</label>
                                <input type="file" class="form-control" @change="e => gambar.value = e.target.files[0]">
                                <div v-if="errors.gambar" class="alert alert-danger mt-2">
                                    <span>{{ errors.gambar[0] }}</span>
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
