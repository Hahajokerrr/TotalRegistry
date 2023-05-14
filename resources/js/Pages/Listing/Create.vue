<template>
    <div class="grid gap-2 grid-cols-5">
        <Box class="col-start-1 col-end-3">
            <div>
                <label for="registration_no" class="label mb-3">Biển số xe:</label>
                <multiselect v-model="selectedCar" label="registration_no" id="registration_no" :options="matchingCars"
                    :searchable="true" :loading="isLoading" :clear-on-select="true" :options-limit="20"
                    @search-change="searchCars" placeholder="Tìm biển số xe">
                    <template #noResult>Không tìm thấy biển số xe nào tương thích!</template>
                </multiselect>
            </div>
            <div>
                <label class="label mb-0 mt-4">Ngày thực hiện đăng kiểm</label><br>
                <input class="input" type="date" id="birthdate">
            </div>
            <div>
                <label class="label mt-4 mb-0">Ngày hết hạn đăng kiểm</label><br>
                <input class="input" type="date" id="birthdate">
            </div>
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
</template>


<script setup>
import CarInformation from '@/Components/CarInformation.vue';
import PersonInformation from '@/Components/PersonInformation.vue';
import CompanyInformation from '@/Components/CompanyInformation.vue';
import Box from '@/Components/UI/Box.vue';
import axios from 'axios';
import { ref, watch, shallowRef } from 'vue';
import Multiselect from 'vue-multiselect';

const selectedCar = ref(null);
const matchingCars = ref([]);
const isLoading = ref(false);
const carInfo = ref(null);
const ownerTypeComponent = shallowRef(null);

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

watch(selectedCar, async (newValue) => {
    if (newValue) {
        try {
            const response = await axios.get(`/listing/create/show/${newValue.registration_no}`);
            carInfo.value = response.data;
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
    }
});
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>




<!-- <script>
import Box from '@/Components/UI/Box.vue';
import axios from 'axios';
import { ref } from 'vue';
import Multiselect from 'vue-multiselect';

export default {
  components: {
    Multiselect,
    Box
},
  setup() {
    const selectedCar = ref(null);
    const matchingCars = ref([]);
    const isLoading = ref(false);

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

    return {
      selectedCar,
      matchingCars,
      isLoading,
      searchCars
    };
  },
};
</script> -->
