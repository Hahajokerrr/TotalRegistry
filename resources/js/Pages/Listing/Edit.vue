<template>
    <form @submit.prevent="update">
        <div class="grid gap-2 grid-cols-5">
            <Box class="col-start-1 col-end-3">
                <div>
                    <!-- multiselect input to choose registration_no of the car and error message -->
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
                <!-- date picker input to choose inspection date (can only choose at most one year ago from present) and error message -->
                <div>
                    <label class="label mb-0 mt-4">Ngày thực hiện đăng kiểm</label><br>
                    <input class="input" type="date" id="inspection_date" v-model="form.inspection_date"
                        :min="getOneYearAgo()">
                    <div v-if="form.errors.inspection_date" class="input-error">
                        {{ form.errors.inspection_date }}
                    </div>
                </div>
                <!-- date picker input to choose expiration date (can only choose at least one year away from registration date) and error message -->
                <div>
                    <label class="label mt-4 mb-0">Ngày hết hạn đăng kiểm</label><br>
                    <input class="input" type="date" id="expiration_date" v-model="form.expiration_date"
                        :min="new Date().toISOString().split('T')[0]">
                    <div v-if="form.errors.expiration_date" class="input-error">
                        {{ form.errors.expiration_date }}
                    </div>
                </div>
                <button type="submit" class="btn-primary mt-4">Chỉnh sửa đăng kiểm</button>
            </Box>

            <!-- Info of the chosen car -->
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
import { ref, watch, shallowRef } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3'
import Multiselect from 'vue-multiselect';

const props = defineProps({
    listing: Object,
  })

const selectedCar = ref(props.listing.car);
const matchingCars = ref([]);
const isLoading = ref(false);
const carInfo = ref(props.listing.car);
const ownerTypeComponent = shallowRef(null);
if (carInfo.value.owner_type == 'App\\Models\\Company') {
    ownerTypeComponent.value = CompanyInformation;
} else {
    ownerTypeComponent.value = PersonInformation;
}

// declare form
const form = useForm({
    car_id: props.listing.car_id,
    inspection_date: props.listing.inspection_date,
    expiration_date: props.listing.expiration_date,
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
        carInfo.value = props.listing.car;
        if (carInfo.value.owner_type == 'App\\Models\\Company') {
            ownerTypeComponent.value = CompanyInformation;
        } else {
            ownerTypeComponent.value = PersonInformation;
        }
        form.car_id = props.listing.car.id;
    }
});

// set up min date of inspection_date
const getOneYearAgo = () => {
    const today = new Date();
    const oneYearAgo = new Date(today.getFullYear() - 1, today.getMonth(), today.getDate());
    return oneYearAgo.toISOString().split('T')[0];
};


// post method, using custom error message
const update = async () => {
  try {
    await form.put(route('listing.update', {listing: props.listing.id}));
  } catch ({ response }) {
      form.errors = response.data.errors;
  }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
