<template>
  <div>
    <label for="registration_no">Biển số xe:</label>
    <multiselect v-model="selectedCar" label="registration_no" id="registration_no"
    :options="matchingCars"
    :searchable="true"
    :loading="isLoading"
    :clear-on-select="true"
    :options-limit="20"
    @search-change="searchCars"
    placeholder="Tìm biển số xe">
      <template slot="noResult">No matching cars found</template>
    </multiselect>
  </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';
import Multiselect from 'vue-multiselect';

export default {
  components: {
    Multiselect
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
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
