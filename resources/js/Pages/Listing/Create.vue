<template>
    <form @submit.prevent="create">
        <div class="grid gap-2 grid-cols-5">
            <Box class="col-start-1 col-end-3">
                <div>
                    <label for="registration_no" class="label mb-3">Biển số xe:</label>
                    <multiselect v-model="selectedCar" label="registration_no" id="registration_no" :options="matchingCars"
                        :searchable="true" :loading="isLoading" :clear-on-select="true" :options-limit="20"
                        @search-change="searchCars" placeholder="Tìm biển số xe">
                        <template #noResult>Không tìm thấy biển số xe nào tương thích!</template>
                    </multiselect>
                    <div v-if="form.errors.car_id" class="input-error">
                        {{ form.errors.car_id }}
                    </div>
                </div>
                <div>
                    <label class="label mb-0 mt-4">Ngày thực hiện đăng kiểm</label><br>
                    <input class="input" type="date" id="inspection_date" v-model="form.inspection_date"
                        :min="getOneYearAgo()">
                    <div v-if="form.errors.inspection_date" class="input-error">
                        {{ form.errors.inspection_date }}
                    </div>
                </div>
                <div>
                    <label class="label mt-4 mb-0">Ngày hết hạn đăng kiểm</label><br>
                    <input class="input" type="date" id="expiration_date" v-model="form.expiration_date"
                        :min="new Date().toISOString().split('T')[0]">
                    <div v-if="form.errors.expiration_date" class="input-error">
                        {{ form.errors.expiration_date }}
                    </div>
                </div>
                <button type="submit" class="btn-primary mt-4">Tạo đăng kiểm mới</button>
            </Box>

            <div class="col-start-3 col-end-6">
                <Box class="mb-2">
                    <!--using slot named header-->
                    <template #header>
                        Thông tin về xe
                    </template>
                    <div v-if="carInfo">
                        <CarInformation :car="carInfo"></CarInformation>
                    </div>
                </Box>
                <Box>
                    <template #header>
                        <!-- use a ternary operator to determine the component to render -->
                        <div>Thông tin về chủ sở hữu</div>
                    </template>
                    <div v-if="carInfo">
                        <component :is="ownerTypeComponent" :car="carInfo"></component>
                    </div>
                </Box>
            </div>
        </div>
    </form>
</template>


<script setup>
import CarInformation from '@/Components/CarInformation.vue';
import PersonInformation from '@/Components/PersonInformation.vue';
import CompanyInformation from '@/Components/CompanyInformation.vue';
import Box from '@/Components/UI/Box.vue';
import axios from 'axios';
import { ref, watch, shallowRef, defineExpose } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3'
import Multiselect from 'vue-multiselect';

const selectedCar = ref(null);
const matchingCars = ref([]);
const isLoading = ref(false);
const carInfo = ref(null);
const ownerTypeComponent = shallowRef(null);

// declare form
const form = useForm({
    car_id: null,
    inspection_date: null,
    expiration_date: null,
})

// get method to query for car according to registration_no
const searchCars = async (query) => {
    if (query) {
        isLoading.value = true;
        try {
            const response = await axios.get(`/listing/create/${query}`);
            matchingCars.value = response.data;
        } catch (error) {
            console.error(error);
        } finally {
            isLoading.value = false;
        }
    } else {
        matchingCars.value = [];
    }
};

//watcher to update owner_info and car_info
watch(selectedCar, async (newValue) => {
    if (newValue) {
        try {
            const response = await axios.get(`/listing/create/show/${newValue.registration_no}`);
            carInfo.value = response.data;
            form.car_id = carInfo.value.id;
            if (carInfo.value.owner_type == 'App\\Models\\Company') {
                ownerTypeComponent.value = CompanyInformation;
            } else {
                ownerTypeComponent.value = PersonInformation;
            }
        } catch (error) {
            console.error(error);
        }
    } else {
        carInfo.value = null;
        ownerTypeComponent = null;
        form.car_id = null;
    }
});

// set up min date of inspection_date
const getOneYearAgo = () => {
    const today = new Date();
    const oneYearAgo = new Date(today.getFullYear() - 1, today.getMonth(), today.getDate());
    return oneYearAgo.toISOString().split('T')[0];
};


// const create = () => form.post(route('listing.store'));

// pot method, using custom error message
const create = async () => {
  try {
    await form.post(route('listing.store'));
  } catch ({ response }) {
      form.errors = response.data.errors;
  }
};
</script>

<!-- multiselect style -->
<style src="vue-multiselect/dist/vue-multiselect.css"></style>




