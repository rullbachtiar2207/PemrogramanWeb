<script setup>
    //import ref
    import { ref } from "vue";
 
    //import router
    import { useRouter } from 'vue-router';
 
    //import api
    import api from "../../api";
 
    //init router
    const router = useRouter();
 
    //define state
    const nama = ref("");
    const deskripsi = ref("");
    const harga = ref("");
    const errors = ref([]);
 
    //method "storeLayanan"
    const storeLayanan = async () => {
 
        //init formData
        let formData = new FormData();
 
        //assign state value to formData
        formData.append("nama", nama.value);
        formData.append("deskripsi", deskripsi.value);
        formData.append("harga", harga.value);
 
        //store data with API
        await api.post('/api/layanans', formData)
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
                        <form @submit.prevent="storeLayanan()">
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
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
